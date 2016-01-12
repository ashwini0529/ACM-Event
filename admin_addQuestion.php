<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");

if (isset($_POST['title'])&&isset($_POST['description'])) {

	$questionTitle = $_POST['title'];
	$questionDescription = $_POST['description'];
	$questionMarks = $_POST['marks'];
	$questionType = $_POST['type'];
	$whoAdded = $_POST['whoAdded'];
	addNewQuestion($questionTitle, $questionDescription, $questionMarks, $questionType,$whoAdded);
	echo "Question Added Successfully..";
	# code...
}



echo "

<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<h1>UserCake</h1>
<h2>Account</h2>
<div id='left-nav'>";

include("left-nav.php");
echo "
</div>
<div id='main'>

<h3>
Hey, $loggedInUser->displayname. This is an example secure page designed to demonstrate some of the basic features of UserCake. Just so you know, your title at the moment is $loggedInUser->title, and that can be changed in the admin panel. You registered this account on " . date("M d, Y", $loggedInUser->signupTimeStamp()) . ".
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
<form method = "POST" action = "admin_addQuestion.php" name= "AddQuestion">
<h3>Add Question</h3>
<p>Question Title : <input type = "text" name = "title">	</p>
<p>Question Description : <textarea name = "description">Add description here</textarea>	</p>
<p>Question Marks : <input type = "text" name = "marks">	</p>
<input type = "hidden" name = "whoAdded" value = " <?php echo $loggedInUser->user_id; ?> ">
<p>Question Type : <input type = "text" name = "type">	<input type = "submit" value = "Add Question">

</p>
</form>