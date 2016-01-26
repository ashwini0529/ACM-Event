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
<h1> </h1>
<h2>Account</h2>
<div id='left-nav'>";

include("left-nav.php");
//echo fetchTotalMarks($loggedInUser->user_id);
echo "
</div>

<div class='container'>
Hey, $loggedInUser->displayname. </div>

<div id='bottom'></div>
</div>


</body class='home page page-id-755 page-template page-template-unlimited-page page-template-unlimited-page-php wpb-js-composer js-comp-ver-4.8.1 vc_responsive'>
</html>";


//echo '<h3>Questions : </h3>';
fetchQuestions();

?>
