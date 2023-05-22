<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $exp=explode('.',$_FILES['image']['name']);
      $file_ext=strtolower(end($exp));
      $location = $_COOKIE["location_folder"];
      $location='image/'.$location;
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="Only images accepted ie. PNG and JPG.";
      }
      
      if($file_size > 4194304){
         $errors[]='File size must be less than or equal to 4 MB';
      }
 
      if (!file_exists($location)) {
        mkdir($location, 0777, true);
    }

      if(empty($errors)==true){
         move_uploaded_file($file_tmp, $location.'/'.$file_name);
         echo "Successfully Uploaded in the Folder:",$location;
         sleep(2);
         ob_end_clean();
         header("Location: http://localhost/iot/gohome.php");
      }
      else{
         print_r($errors);
      }
   
   sleep(2);
        

   }

?>