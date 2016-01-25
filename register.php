<?php
/*
  Version: 2.0.2
http:// .com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he/she is already logged in
if(isUserLoggedIn()) { header("Location: account.php"); die(); }

//Forms posted
if(!empty($_POST))
{
	$errors = array();
	$email = trim($_POST["email"]);
	$username = trim($_POST["username"]);
	$displayname = trim($_POST["displayname"]);
	$password = trim($_POST["password"]);
	$confirm_pass = trim($_POST["passwordc"]);
	$captcha = md5($_POST["captcha"]);
	
	
	if ($captcha != $_SESSION['captcha'])
	{
		$errors[] = lang("CAPTCHA_FAIL");
	}
	if(minMaxRange(5,25,$username))
	{
		$errors[] = lang("ACCOUNT_USER_CHAR_LIMIT",array(5,25));
	}
	if(!ctype_alnum($username)){
		$errors[] = lang("ACCOUNT_USER_INVALID_CHARACTERS");
	}
	if(minMaxRange(5,25,$displayname))
	{
		$errors[] = lang("ACCOUNT_DISPLAY_CHAR_LIMIT",array(5,25));
	}
	if(!ctype_alnum($displayname)){
		$errors[] = lang("ACCOUNT_DISPLAY_INVALID_CHARACTERS");
	}
	if(minMaxRange(8,50,$password) && minMaxRange(8,50,$confirm_pass))
	{
		$errors[] = lang("ACCOUNT_PASS_CHAR_LIMIT",array(8,50));
	}
	else if($password != $confirm_pass)
	{
		$errors[] = lang("ACCOUNT_PASS_MISMATCH");
	}
	if(!isValidEmail($email))
	{
		$errors[] = lang("ACCOUNT_INVALID_EMAIL");
	}
	//End data validation
	if(count($errors) == 0)
	{	
		//Construct a user object
		$user = new User($username,$displayname,$password,$email);
		
		//Checking this flag tells us whether there were any errors such as possible data duplication occured
		if(!$user->status)
		{
			if($user->username_taken) $errors[] = lang("ACCOUNT_USERNAME_IN_USE",array($username));
			if($user->displayname_taken) $errors[] = lang("ACCOUNT_DISPLAYNAME_IN_USE",array($displayname));
			if($user->email_taken) 	  $errors[] = lang("ACCOUNT_EMAIL_IN_USE",array($email));		
		}
		else
		{
			//Attempt to add the user to the database, carry out finishing  tasks like emailing the user (if required)
			if(!$user-> AddUser())
			{
				if($user->mail_failure) $errors[] = lang("MAIL_ERROR");
				if($user->sql_failure)  $errors[] = lang("SQL_ERROR");
			}
		}
	}
	if(count($errors) == 0) {
		$successes[] = $user->success;
	}
}

require_once("models/header.php");
echo "


<div id='left-nav'>";
include("left-nav.php");
echo "
</div>

<div id='main'>";

echo resultBlock($errors,$successes);

echo "
<div class='container' >
 


<form class='form-horizontal' name='newUser'  action='".$_SERVER['PHP_SELF']."' method='post'>
  <fieldset>
    <legend style='text-align:center'>Register</legend>
    <div class='form-group'>
      <label for='inputEmail' class='col-lg-2 control-label'>Team Name</label>
      <div class='col-lg-10'>
        <input type='text' class='form-control' type='text' 
  placeholder='Please enter your team name(max 2 people in a team)' aria-required='true' name='username'>
      </div>
    </div>
    <div class='form-group'>
      <label for='displayName' class='col-lg-2 control-label'>Display Name</label>
      <div class='col-lg-10'>
        <input  class='form-control' placeholder='Display Name'   type='text' name='displayname'>
        
      </div>
    </div>
    <div class='form-group'>
      <label for='inputPassword' class='col-lg-2 control-label'>Password</label>
      <div class='col-lg-10'>
        <input type='password' class='form-control' name='password' placeholder='Password'>
        
      </div>
    </div>
    <div class='form-group'>
      <label for='inputPassword' class='col-lg-2 control-label'>Confirm Password</label>
      <div class='col-lg-10'>
        <input type='password' class='form-control' name='passwordc' placeholder='Confirm Password'>
        
      </div>
    </div>
    <div class='form-group'>
      <label for='inputPassword' class='col-lg-2 control-label'>Email</label>
      <div class='col-lg-10'>
        <input class='form-control' placeholder='Email'   type='text' name='email'>
        
      </div>
    </div>
    <div class='form-group'>
      <label for='inputPassword' class='col-lg-2 control-label'>Security Code <img src='models/captcha.php'></label>
      
      <div class='col-lg-10'>
        <input class='form-control' placeholder='Enter Security Code'   name='captcha' type='text'>
        
      </div>
    </div>
    
    <div class='form-group'>
      <div class='col-lg-10 col-lg-offset-2'>
        
        <button value='Register' type='submit' class='btn btn-primary'>Submit</button>
      </div>
    </div>
  </fieldset>
</form>

</div>


</div>
<div id='bottom'></div>
</div>
</body>
</html>";
?>
