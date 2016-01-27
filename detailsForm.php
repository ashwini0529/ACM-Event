<?php
/*
  Version: 2.0.2
http:// .com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

if (isset($_POST['contact']) && isset($_POST['regno'])) {

	$contact = $_POST['contact'];
	$regNo = $_POST['regno'];
	updateUserProfileDetails($regNo,$contact,$loggedInUser->user_id);
	echo '<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"> Congratulations, your details have been successfully updated.</h3>
  </div>
</div>';
	# code...
}

echo "
<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<h1> </h1>
<h2>Account</h2>
<div id='left-nav'>";

include("left-nav.php");

echo "
<div class='container' >


<form class='form-horizontal' name='login'  action='".$_SERVER['PHP_SELF']."' method='post'>
  <fieldset>
    <legend>User Details</legend>
   	

      <div class='form-group' >
      <label for='inputEmail' class='col-lg-2 control-label'>Registration Number</label>
      <div class='col-lg-10'>
        <input type='text' class='form-control' 
  placeholder='Registration Number' aria-required='true' name='regno'>
      </div>
    </div>
   
    <div class='form-group' >
      <label for='inputEmail' class='col-lg-2 control-label'>Contact Number</label>
      <div class='col-lg-10'>
        <input type='text' class='form-control' type='text' 
  placeholder='Contact Number' aria-required='true' name='contact'>
      </div>
    </div>
   
     
   
    <div class='form-group'>
      <div class='col-lg-10 col-lg-offset-2'>
       
        <button type='submit' value='Login'  class='btn btn-primary'>Submit</button>
      </div>
    </div>
  </fieldset>
</form>

</div>
</div>
<div id='bottom'></div>
</div>
</body>
</html>
";


?>
