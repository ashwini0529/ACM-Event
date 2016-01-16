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
<h2>2.00</h2>
<div id='left-nav'>";
include("left-nav.php");

echo "
</div>
<div id='main'>
<p>
Welcome to <b> CodeBurst </b> . 

<b>Ready, Steady, Code.! </b>
</p>
</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
