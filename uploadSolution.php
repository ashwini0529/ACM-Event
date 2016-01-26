<?php


    require_once("models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Prevent the user visiting the logged in page if he is not logged in
if(!isUserLoggedIn()) { header("Location: login.php"); die(); }

    require_once("models/header.php");
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
         move_uploaded_file($file_tmp,"uploads/".$fileNewName);
         echo "Success";
         addUploadDetails($loggedInUser->user_id,$_GET['id']);
         updateTotalQuestionsAttempted($loggedInUser->user_id);
         echo '<br>Total Questions attempted increased in users table..</div>';
      }else{
         print_r($errors);
      }
   }
?>
<html>
   <body >
      <div class="container"> 
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12" style='text-align:center;'>
        
      <form class='form-horizontal' action="" method="POST" enctype="multipart/form-data">
      <fieldset>
          <center><legend>Upload Question</legend></center>
         <div class='form-group' >
         <input class="form-control"type="file" name="image" />
         </div>
         <div class='form-group'>
      <div class='col-lg-9 col-lg-offset-1'>
       
        <button type='submit' value='Login'  class='btn '>Submit</button>
      </div>
    </div>
         
      </form>
        </div>
      </fieldset>
      
   </body>
</html>
