
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
	$username = sanitize(trim($_POST["username"]));
	$password = trim($_POST["password"]);
	
	//Perform some validation
	//Feel free to edit / change as required
	if($username == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_USERNAME");
	}
	if($password == "")
	{
		$errors[] = lang("ACCOUNT_SPECIFY_PASSWORD");
	}

	if(count($errors) == 0)
	{
		//A security note here, never tell the user which credential was incorrect
		if(!usernameExists($username))
		{
			$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
		}
		else
		{
			$userdetails = fetchUserDetails($username);
			//See if the user's account is activated
			if($userdetails["active"]==0)
			{
				$errors[] = lang("ACCOUNT_INACTIVE");
			}
			else
			{
				//Hash the password and use the salt from the database to compare the password.
				$entered_pass = generateHash($password,$userdetails["password"]);
				
				if($entered_pass != $userdetails["password"])
				{
					//Again, we know the password is at fault here, but lets not give away the combination incase of someone bruteforcing
					$errors[] = lang("ACCOUNT_USER_OR_PASS_INVALID");
				}
				else
				{
					//Passwords match! we're good to go'
					
					//Construct a new logged in user object
					//Transfer some db data to the session object
					$loggedInUser = new loggedInUser();
					$loggedInUser->email = $userdetails["email"];
					$loggedInUser->user_id = $userdetails["id"];
					$loggedInUser->hash_pw = $userdetails["password"];
					$loggedInUser->title = $userdetails["title"];
					$loggedInUser->displayname = $userdetails["display_name"];
					$loggedInUser->username = $userdetails["user_name"];
					
					//Update last sign in
					$loggedInUser->updateLastSignIn();
					$_SESSION[" User"] = $loggedInUser;
					
					//Redirect to user account page
					header("Location: account.php");
					die();
				}
			}
		}
	}
}

require_once("models/header.php");

echo "

<div id='left-nav'>";

include("left-nav.php");

echo "
</div>
<div id='main'>
<h2>Login</h2>";

echo resultBlock($errors,$successes);

echo "

<div class='container' >

<div id='regbox'  class='c-5'>
<form name='login' class='wpcf7-form' action='".$_SERVER['PHP_SELF']."' method='post'>
<p>

<span class='wpcf7-form-control-wrap text'>	
<label>User Name:</label><input type='text' 
size='40' class='wpcf7-form-control wpcf7-text  c-12' aria-invalid='false' placeholder='Username' aria-required='true' name='username' /></span>
</p>
<p>
<label>Password:</label>
<input type='password' name='password' />
</p>
<p>
<label>&nbsp;</label>
<input  type='submit' value='Login' class='submit' />
</p>
</form>
</div>
</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
