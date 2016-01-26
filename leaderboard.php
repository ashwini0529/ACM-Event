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
<center>
<h2>Account</h2></center>
</div>
<div id='bottom'></div>
</div>
<div class='ccontainer'>
	<table class='table table-striped table-hover table-responsive table-condensed '>
  <thead>
    <tr>
      
      <th>Rank</th>
      <th>Username</th>
      <th>Full Name</th>
      <th>Total Marks</th>
      <th>Questions Attempted</th>
      <th>User Profile</th>
    </tr>
  </thead>
  <tbody>";
letsBuildLeaderBoard();
echo "
    
  </tbody>
</table> 
</div>
</div>
<br>
</body>
</html>";
	


?>