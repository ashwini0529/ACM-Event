<?php
/*
  Version: 2.0.2
http:// .com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");

   

echo "
<body>
<div id='wrapper'>
<div id='top'><div id='logo'></div></div>
<div id='content'>
<center>
<h2 class='uppercase'>Account</h2></center>
<div id='left-nav'>";

include("left-nav.php");
//echo fetchTotalMarks($loggedInUser->user_id);
echo "
</div>

<div class='container'>
<div class='well well-lg'>Please update your details  <a href = 'detailsForm.php'> here</a> . Updating your information is very important.<br>The contest is over. Thank you for participating.</div>

<div id='bottom'></div>
</div>


</body>
</html>";


//echo '<div class="container"><h3>Questions : </h3></div>';
//fetchQuestions();

?>
