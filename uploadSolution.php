<?php


    require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

    require_once("models/header.php");
    echo '<h3>Hey, '.$loggedInUser->username.'</h3>';
    $questionId = $_GET['id'];
    fetchQuestionDetails($_GET['id']);
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("c","cpp","java", "py");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a .CPP, .C, .JAVA, .PY file extension.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      $fileNewName = $loggedInUser->user_id.'_'.$_GET['id'].'.'.$file_ext;
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"uploadsJordie/".$fileNewName);
         echo "Congratulations!!! Solution Successfully Uploaded.";
         addUploadDetails($loggedInUser->user_id,$_GET['id']);
         updateTotalQuestionsAttempted($loggedInUser->user_id);
      }else{
         print_r($errors);
      }
   }
?>
<html>
   <body class="col-lg-5 col-md-5 col-sm-5 col-xs-12" style='text-align:center;'">
      
      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" />
         <input type="submit"/>
      </form>
      
   </body>
</html>
