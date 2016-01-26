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
<h2>Home</h2>
<div id='left-nav'>";

include("left-nav.php");
//echo fetchTotalMarks($loggedInUser->user_id);
if ($loggedInUser->checkPermission(array(1))){
echo '
</div>

<br><div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title"> Hey '.$loggedInUser->displayname.'</h3>
  </div>
  <div class="panel-body">
    <p>Codart will start on 26th January, 9AM. </p>
    <p>Questions will be uploaded here.</p>
    <p>Meanwhile you can tweet with our hashtag <b><i>#notJustCoding</i></b> and <b><i>#ACMVIT</i></b></p>
  </div>
</div>
<br>


</body class="home page page-id-755 page-template page-template-unlimited-page page-template-unlimited-page-php wpb-js-composer js-comp-ver-4.8.1 vc_responsive">
</html>';
}

//echo '<h3>Questions : </h3>';
//fetchQuestions();

?>
