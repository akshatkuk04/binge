<?php
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $exp=explode('.',$_FILES['image']['name']);
      $file_ext=strtolower(end($exp));  
      $extensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 4194304){
         $errors[]='File size must be less than 4 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"image/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }


?>

</div>
</html>

<html lang="en">
<div class="container">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Location based smart drive</title>
</head>

<body>
        <div class="header">
           
            <nav>
                <ul>
                    <li class="content"><a href="customupload.html">Other location and custom upload</a></li>
                    
                </ul>
            </nav>
        </div>
            <div class="text">
            <h1> Upload your files below <br> </h1>
            
            <div class="btn" id="print">
            
            </div>
            <button class="btn3">
                <form action="action.php" method="POST" enctype="multipart/form-data" class="btn" id="btn2">
                <input type="file" name="image" />
                <input type="submit"/>
            </form>

            </button>
           </div>
       </div>
   </div>
</body>
</html>

<html>
   <body>
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Location based smart drive</title>
</head>
<body>

<script src="https://maps.google.com/maps/api/js?key="ADD YOUR API KEY"></script>
<script src="script.js"></script>
    
</div>
<nav class="btn3">
    Directory of Files
</nav>
<div class="container">
<?php    
//Scanning Directory
function getFileList($dir)
{
  // array to hold return value
  $retval = array();

  if(substr($dir, -1) != "/") $dir .= "/";

  // open pointer to directory and read list of files
  $d = @dir($dir) or die("getFileList: Failed opening directory $dir for reading");
  while(false !== ($entry = $d->read())) {
    // skipping any hidden files
    if($entry[0] == ".") continue;
    if(is_dir("$dir$entry")) {
      $retval[] = array(
        "name" => "$dir$entry/",
        "type" => filetype("$dir$entry"),
        "size" => 0,
        "lastmod" => filemtime("$dir$entry")
      );
    } elseif(is_readable("$dir$entry")) {
      $retval[] = array(
        "name" => "$dir$entry",
        "type" => mime_content_type("$dir$entry"),
        "size" => filesize("$dir$entry"),
        "lastmod" => filemtime("$dir$entry")
      );
    }
  }
  $d->close();

  return $retval;
}


$gfg_folderpath = "image/";

if (is_dir($gfg_folderpath)) {
	
	$files = opendir($gfg_folderpath); {
		
		if ($files) {
			while (($gfg_subfolder = readdir($files)) !== FALSE) {
				
			if ($gfg_subfolder != '.' && $gfg_subfolder != '..') {


                    
					echo "SUBFOLDER--" .$gfg_subfolder . "<br>
					"."Files in ".$gfg_subfolder."--<br>";
					
				$dirpath = "image/" . $gfg_subfolder . "/";
					
					if (is_dir($dirpath)) {
						$file = opendir($dirpath); {
							if ($file) {
				
			while (($gfg_filename = readdir($file)) !== FALSE) {
				if ($gfg_filename != '.' && $gfg_filename != '..') {
						echo $gfg_filename . "<br>";
						}
						}
					}
				}
			}
					echo "<br> <hr>";
				}
			}
		}
	}
}

?>

</div>
</body>
</html>