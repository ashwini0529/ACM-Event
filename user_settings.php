<?php
/*
  Version: 2.0.2
http:// .com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

if(!empty($_POST))
{
	$errors = array();
	$successes = array();
	$password = $_POST["password"];
	$password_new = $_POST["passwordc"];
	$password_confirm = $_POST["passwordcheck"];
	
	$errors = array();
	$email = $_POST["email"];
	
	//Perform some validation
	//Feel free to edit / change as required
	
	//Confirm the hashes match before updating a users password
	$entered_pass = generateHash($password,$loggedInUser->hash_pw);
	
	if (trim($password) == ""){
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}
	else if($entered_pass != $loggedInUser->hash_pw)
	{
		//No match
		$errors[] = lang("ACCOUNT_PASSWORD_INVALID");
	}	
	if($email != $loggedInUser->email)
	{
		if(trim($email) == "")
		{
			$errors[] = lang("ACCOUNT_SPECIFY_EMAIL");
		}
		else if(!isValidEmail($email))
		{
			$errors[] = lang("ACCOUNT_INVALID_EMAIL");
		}
		else if(emailExists($email))
		{
			$errors[] = lang("ACCOUNT_EMAIL_IN_USE", array($email));	
		}
		
		//End data validation
		if(count($errors) == 0)
		{
			$loggedInUser->updateEmail($email);
			$successes[] = lang("ACCOUNT_EMAIL_UPDATED");
		}
	}
	
	if ($password_new != "" OR $password_confirm != "")
	{
		if(trim($password_new) == "")
		{
			$errors[] = lang("ACCOUNT_SPECIFY_NEW_PASSWORD");
		}
		else if(trim($password_confirm) == "")
		{
			$errors[] = lang("ACCOUNT_SPECIFY_CONFIRM_PASSWORD");
		}
		else if(minMaxRange(8,50,$password_new))
		{	
			$errors[] = lang("ACCOUNT_NEW_PASSWORD_LENGTH",array(8,50));
		}
		else if($password_new != $password_confirm)
		{
			$errors[] = lang("ACCOUNT_PASS_MISMATCH");
		}
		
		//End data validation
		if(count($errors) == 0)
		{
			//Also prevent updating if someone attempts to update with the same password
			$entered_pass_new = generateHash($password_new,$loggedInUser->hash_pw);
			
			if($entered_pass_new == $loggedInUser->hash_pw)
			{
				//Don't update, this fool is trying to update with the same password Â¬Â¬
				$errors[] = lang("ACCOUNT_PASSWORD_NOTHING_TO_UPDATE");
			}
			else
			{
				//This function will create the new hash and update the hash_pw property.
				$loggedInUser->updatePassword($password_new);
				$successes[] = lang("ACCOUNT_PASSWORD_UPDATED");
			}
		}
	}
	if(count($errors) == 0 AND count($successes) == 0){
		$errors[] = lang("NOTHING_TO_UPDATE");
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
<div class='container'>

<form class='form-horizontal' name='updateAccount' action='".$_SERVER['PHP_SELF']."' method='post'>
  <fieldset>
    <center><legend>User Settings</legend></center>
 
    <div class='form-group'>
      <label for='inputPassword' class='col-lg-3 col-md-3  control-label'>Password</label>
      <div class='col-lg-9 col-md-9'>
        <input type='password' class='form-control' name='password' placeholder='Password'>
        
      </div>
    </div>
    <div class='form-group'>
      <label for='inputPassword' class='col-lg-3 col-md-3  control-label'>Email</label>
      <div class='col-lg-9 col-md-9'>
        <input class='form-control' placeholder='Email' value='".$loggedInUser->email."'  type='text' name='email'>
        
      </div>
    </div>
    <div class='form-group'>
      <label for='inputPassword' class='col-lg-3 col-md-3  control-label'>New Password</label>
      <div class='col-lg-9 col-md-9'>
        <input type='password' class='form-control' name='passwordc' placeholder='New Password'>
        
      </div>
    </div>
    <div class='form-group'>
      <label for='inputPassword' class='col-lg-3 col-md-3  control-label'>Confirm Password</label>
      <div class='col-lg-9 col-md-9'>
        <input type='password' class='form-control'  name='passwordcheck' placeholder='Confirm Password'>
        
      </div>
    </div>
    <div class='form-group'>
      <div class='col-md-offset-3 col-lg-offset-3'>
        
        <button value='Update' type='submit' class='btn ='>Submit</button>
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

