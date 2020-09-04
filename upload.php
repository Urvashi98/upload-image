<?php 
require_once 'config.php';
$input_err=$success='';


if(isset($_POST['submit'])){
 
  $name = $_FILES['image']['name'];
  $error = $_FILES['image']['error'];
  $target_dir = "upload/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
 
     // Insert record
     $query = "insert into images(name) values('".$name."')";
     mysqli_query($conn,$query);
  
     // Upload file
     move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$name);
	 
	if($_FILES['image']['error'] == 0){
		
		$success = "File Uploaded.";
	}else{
		$error = "Upload Fail.";
	}

  }else{
	  $error = "Please upload an image.";
	  
  }
 
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Image</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
      .style{
        margin-left:5ex; margin-right:5ex;
      }
      .error { color: red; }
	  .success{color:green;}
    </style>
  </head>
  <body>

  <div class="container">
    <div class="row">
      <div class="col-md-6 ">
                      
                    <h2>Choose an Image</h2><hr>
    
                <!--Form -->

                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                        <!-- file input-->
                        <div class="form-group w-60 style" >
                            <input type="file" name="image" /> 
                           
                        </div> 
						  <!-- Submit -->
                        <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Upload" name="submit">      
                        </div>
						 <!-- Show image -->
						 <div class="form-group">
                               <p>Want to see the image? Visit <a href="showimage.php">Show Image</a>.</p>    
                        </div>
						 <!-- error display -->
						 <span class="error"><b><?php echo $input_err; ?><b></span>
						  <span class="success"><b><?php echo $success; ?></b></span>	
                        
                        </form>
                       
      
      </div>
  </div>
</div>

  </body>
</html>