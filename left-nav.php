<?php
/*
  Version: 2.0.2
http:// .com
*/

if (!securePage($_SERVER['PHP_SELF'])){die();}

//Links for logged in user
if(isUserLoggedIn()) {
	echo "
	<ul>
	<li><a href='account.php'>Account Home</a></li>
	<li><a href='user_settings.php'>User Settings</a></li>
	<li><a href='leaderboard.php'>Leaderboard</a></li>
	<li><a href='userDashboard.php'>Dashboard</a></li>
	
	<li><a href='logout.php'>Logout</a></li>
	</ul>";
	
	//Links for permission level 2 (default admin)
	if ($loggedInUser->checkPermission(array(2))){
	echo "
	<ul>
	<li class='btn small load-speaker-list'><i class='fa icon-caret-right'></i><a style='color:white' href='admin_configuration.php'>Admin Configuration</a></li>
	<li class='btn small load-speaker-list'><i class='fa icon-caret-right'></i><a style='color:white' href='admin_users.php'>Admin Users</a></li>
	<li class='btn small load-speaker-list'><i class='fa icon-caret-right'></i><a style='color:white' href='admin_permissions.php'>Admin Permissions</a></li>
	<li class='btn small load-speaker-list'><i class='fa icon-caret-right'></i><a style='color:white' href='admin_pages.php'>Admin Pages</a></li>
	<li class='btn small load-speaker-list'><i class='fa icon-caret-right'></i><a style='color:white' href='admin_addQuestion.php'>Add Question</a></li>
	<li class='btn small load-speaker-list'><i class='fa icon-caret-right'></i><a style='color:white' href='admin_updateMarks.php'>Update marks</a></li>
	

	</ul>";
	}
} 
//Links for users not logged in
else {
	echo "
	<ul class='nav nav-pills'>
	<li  class='btn small load-speaker-list' ><i class='fa icon-caret-right'></i><a style='color:white' href='index.php'>Home</a></li>
	<li  class='btn small load-speaker-list' ><i class='fa icon-caret-right'></i><a style='color:white' href='login.php'>Login</a></li>
	<li  class='btn small load-speaker-list' ><i class='fa icon-caret-right'></i><a style='color:white' href='register.php'>Register</a></li>
	<li  class='btn small load-speaker-list' ><i class='fa icon-caret-right'></i><a style='color:white' href='forgot-password.php'>Forgot Password</a></li>";
	
	if ($emailActivation)
	{
	echo "<li  class='btn small load-speaker-list'><i class='fa icon-caret-right'></i><a style='color:white' href='resend-activation.php'>Resend Activation Email</a></li>";
	}
	echo "</ul>";
}

?>
