<?php

 require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

    require_once("models/header.php");


    // Build User Dashboard...
    letsBuildUserDashboard($loggedInUser->user_id);