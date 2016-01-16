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

<div id='content'>
<h1>ACM EVENT</h1>
<h2>Account</h2>
<div id='left-nav'>";

include("left-nav.php");
echo "
</div>
<div id='bottom'></div>
</div>


";

letsBuildLeaderBoard();

echo "
</body>
</html>";



?>