<?php
/*
  Version: 2.0.2
http:// .com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");
if ($loggedInUser->checkPermission(array(2))){
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

<div id='content' class='container'>
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
<div class="container">
<form method = "POST" action = "admin_addQuestion.php" name= "AddQuestion">
<h3>Add Question</h3>
<p>Question Title : <input type = "text" name = "title">	</p>
<p>Question Description : <textarea name = "description">Add description here</textarea>	</p>
<p>Question Marks : <input type = "text" name = "marks">	</p>
<input type = "hidden" name = "whoAdded" value = " <?php echo $loggedInUser->user_id; ?> ">
<p>Question Type : <input type = "text" name = "type">	<input type = "submit" value = "Add Question">

</p>
</form>

<?php

}
else echo 'Sorry . You are not the administrator of the site.. Your IP is traced.</div>';
?>