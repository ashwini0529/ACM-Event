<?php
/*
  Version: 2.0.2
http:// .com
*/

require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
require_once("models/header.php");

echo "

<div id='left-nav'>";
include("left-nav.php");

echo "
</div>
<div id='main'>

</div>
<div id='bottom'></div>
</div>
</body>
</html>";

?>
