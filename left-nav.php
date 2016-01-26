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
	<center>
	<ul class='nav nav-pills' style='text-align:center'>
	<li class='list-nav'><a href='account.php'>Account Home</a></li>
	<li class='list-nav'><a href='user_settings.php'>User Settings</a></li>
	<li class='list-nav'><a href='userDashboard.php'>Dashboard</a></li>
	<li class='list-nav'><a href='leaderboard.php'>Leaderboard</a></li>
	<li class='list-nav'><a href='logout.php'>Logout</a></li>
	</ul>
	</center></div>";
	
	//Links for permission level 2 (default admin)
	if ($loggedInUser->checkPermission(array(2))){
	echo "
	<div class='container' >
	<center>
	<ul class='nav nav-pills' style='text-align:center'>
	<li class='list-nav' ><i class='fa icon-caret-right'></i><a  href='admin_configuration.php'>Admin Configuration</a></li>
	<li  class='list-nav'><i class='fa icon-caret-right'></i><a  href='admin_users.php'>Admin Users</a></li>
	<li  class='list-nav'><i class='fa icon-caret-right'></i><a  href='admin_permissions.php'>Admin Permissions</a></li>
	<li  class='list-nav'><i class='fa icon-caret-right'></i><a  href='admin_pages.php'>Admin Pages</a></li>
	<li  class='list-nav'><i class='fa icon-caret-right'></i><a  href='admin_addQuestion.php'>Add Question</a></li>
	<li  class='list-nav'><i class='fa icon-caret-right'></i><a  href='admin_updateMarks.php'>Update marks</a></li>
	

	</ul></center></div>";
	}
} 
//Links for users not logged in
else {
	echo "
	<div class='container'  >
	<center>
	<ul class='nav nav-pills'  style='text-align:center'>
	<li  class='list-nav'  ><i class='fa icon-caret-right'></i><a  href='index.php'>Home</a></li>
	<li   class='list-nav' ><i class='fa icon-caret-right'></i><a  href='login.php'>Login</a></li>
	<li  class='list-nav'  ><i class='fa icon-caret-right'></i><a  href='register.php'>Register</a></li>";
	
	
	echo "</ul>
	</center></div>";
}

?>
