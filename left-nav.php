<?php
/*
  Version: 2.0.2
http:// .com
*/

if (!securePage($_SERVER['PHP_SELF'])){die();}

//Links for logged in user
if(isUserLoggedIn()) {
	echo "
	<div class='container' >
	<ul class='nav nav-pills' style='text-align:center'>
	<li><a href='account.php'>Account Home</a></li>
	<li><a href='user_settings.php'>User Settings</a></li>
	<li><a href='leaderboard.php'>Leaderboard</a></li>
	<li><a href='userDashboard.php'>Dashboard</a></li>
	
	<li><a href='logout.php'>Logout</a></li>
	</ul></div>";
	
	//Links for permission level 2 (default admin)
	if ($loggedInUser->checkPermission(array(2))){
	echo "
	<div class='container' >
	<ul class='nav nav-pills' style='text-align:center'>
	<li ><i class='fa icon-caret-right'></i><a  href='admin_configuration.php'>Admin Configuration</a></li>
	<li ><i class='fa icon-caret-right'></i><a  href='admin_users.php'>Admin Users</a></li>
	<li ><i class='fa icon-caret-right'></i><a  href='admin_permissions.php'>Admin Permissions</a></li>
	<li ><i class='fa icon-caret-right'></i><a  href='admin_pages.php'>Admin Pages</a></li>
	<li ><i class='fa icon-caret-right'></i><a  href='admin_addQuestion.php'>Add Question</a></li>
	<li ><i class='fa icon-caret-right'></i><a  href='admin_updateMarks.php'>Update marks</a></li>
	

	</ul></div>";
	}
} 
//Links for users not logged in
else {
	echo "
	<div class='container'  >
	<ul class='nav nav-pills'  style='text-align:center'>
	</ul>";
	
	
}

?>