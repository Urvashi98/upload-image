<?php 

$input_err=$success='';


if(isset($_POST['submit'])){

  if(isset($_FILES)){
    
        $file = $_FILES['image']['tmp_name'];
        $filename=$_FILES['image']['name'];
        $file_type= $_FILES['image']['type'];
        $targedtdir = 'upload/';
        $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

        
         
        list($width,$height) = getimagesize($file);
       // $nw = $width/3; $nh = $height/3;
       
        if($file_type == 'image/jpg' || $file_type == 'image/jpeg' ){

          $source = imagecreatefromjpeg($file);
          $newimg = resize($source,$width,$height);
          imagejpeg($newimg,'upload/'."thump_".$filename);
        
        }
       else if($file_type == 'image/png')
       {
          $source = imagecreatefrompng($file);
          $newimg = resize($source,$width,$height);
          imagepng($newimg,'upload/'."thump_".$filename);

       }elseif ($file_type == 'image/gif'){

        $source = imagecreatefromgif($file);
        $newimg = resize($source,$width,$height);
        imagegif($newimg,'upload/'."thump_".$filename);
        
       }else{

        $input_err= "Please select an image";
       }

       if(move_uploaded_file($file,$targedtdir.$filename)){
           $success="file uploaded and resized successfully."; 
       }else{
           $input_err = "data not inserted";
      }  

  }

}
function resize($src,$width,$height){
  $nw = $width/3; $nh = $height/3;
  $newimg= imagecreatetruecolor($nw,$nh); 
  imagecopyresampled($newimg,$src,0,0,0,0,$nw,$nh,$width,$height);

  return $newimg; 
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
					
						 
						 <!-- error display -->
						 <span class="error"><b><?php echo $input_err; ?><b></span>
						  <span class="success"><b><?php echo $success; ?></b></span>	<br/><br/>
                        
                        </form>
                       
      
      </div>
  </div>

  <div class="row">
	
	<div class="col-md-4">
		<img class="img-rounded img-responsive" src="<?php echo $targedtdir."thump_".$filename; ?>" width="<?php echo $new_width; ?>" height="<?php echo $new_height; ?>" >
 
		<h4><b>Thump Image</b></h4>
 
		<a href="<?php echo $targedtdir."thump_".$filename; ?>" download class="btn btn-danger"><i class="fa fa-download"></i> Download </a href="">
	</div>
	<div class="col-md-8">
		<img class="img-rounded img-responsive" src="<?php echo $targedtdir.$filename; ?>" >
 
		<h4><b>Original Image</b></h4>
	</div>
</div>
</div>

  </body>
</html>