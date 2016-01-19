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
 
<h2>Register</h2>
<div id='regbox'  class='c-5'>
<form name='newUser' class='wpcf7-form' action='".$_SERVER['PHP_SELF']."' method='post'>

<span class='wpcf7-form-control-wrap text-412'><input placeholder='User Name'size='40' class='wpcf7-form-control wpcf7-text required' type='text' name='username' /></span>

<span class='wpcf7-form-control-wrap text-412'><input placeholder='Display Name' size='40' class='wpcf7-form-control wpcf7-text required' type='text' name='displayname' /></span>
<span class='wpcf7-form-control-wrap text-412'><input placeholder='Password' size='40' class='wpcf7-form-control wpcf7-text required' type='password' name='password' /></span>

<span class='wpcf7-form-control-wrap text-412'><input placeholder='Confirm Password' size='40' class='wpcf7-form-control wpcf7-text required' type='password' name='passwordc' /></span>


<span class='wpcf7-form-control-wrap text-412'><input placeholder='Email' size='40' class='wpcf7-form-control wpcf7-text required' type='text' name='email' /></span>

<label>Security Code:</label>
<img src='models/captcha.php'>


<span class='wpcf7-form-control-wrap text-412'><input placeholder='Enter Security Code' size='40' class='wpcf7-form-control wpcf7-text required' name='captcha' type='text'></span>

<label>&nbsp;<br>
<input type='submit' value='Register'/>

</form>
</div>
</div>
</div>


</div>
<div id='bottom'></div>
</div>
</body>
</html>";
?>
