<?php
/*
  Version: 2.0.2
http:// .com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
if ($loggedInUser->checkPermission(array(2))){
if (isset($_POST['userId'])&&isset($_POST['marks'])) {

	$userId = $_POST['userId'];
	$questionId = $_POST['question_id'];
	$marksAwarded = $_POST['marks'];
	$marksAwardedBy = $_POST['whoAdded'];
	updateUserMarks($userId, $questionId,$marksAwarded,$marksAwardedBy);
	$totalMarksOfUser = fetchTotalMarks($userId);
	updateUserProfileMarks($totalMarksOfUser, $userId );
	echo "Marks updated Successfully..";
	# code...
}



echo "

<body>
<div id='wrapper'>

<div id='content'>
<h1>ACM EVENT</h1>
<h2>Account</h2>
<div id='left-nav'>";

include("left-nav.php");
echo "
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
<form method = "POST" action = "admin_updateMarks.php" name= "updateMarks">
<h3>Update Marks</h3>
<p>User ID : <input type = "text" name = "userId">	</p>
<p>Question ID : <input type= "text" name = "question_id" ></p>
<p>Marks Awarded : <input type = "text" name = "marks">	</p>

<input type = "hidden" name = "whoAdded" value = " <?php echo $loggedInUser->user_id; ?> ">
<p><input type = "submit" value = "Update Marks">

</p>
</form>
<?php

}
else echo 'Sorry . You are not the administrator of the site.. Your IP is traced.';
?>