<?php 
$input_err=$success='';
if($_SERVER['REQUEST_METHOD'] == "POST"){

    //get image details
    $name = $_FILES['image']['name'];
    $tmpname = $_FILES['image']['tmp_name'];
    $type = $_FILES['image']['type'];
    $dir ='compress/';

    //check if proper extension file is selected.
    if(($type == 'image/gif') || ($type == 'image/jpeg') || ($type == 'image/png')){
     
      //call function to compress image.
     compressimage($tmpname,"compress/" . $name,50);
     $success= "Image uploaded";
    }else{ $input_err ="Upload an jpeg/png/gif image.";}
    
}
function compressimage($source,$destination,$quality){
    
  //get image details such as width,height, mime-type etc. 
    $attr = getimagesize($source);
   
    if($attr['mime']== 'image/jpeg')   $nimage = imagecreatefromjpeg($source); 
    else if($attr['mime'] == 'image/png')   $nimage = imagecreatefrompng($source);
    elseif($attr['mime'] == 'image/gif') $nimage = imagecreatefromgif($source);

    //create jpeg image.
    imagejpeg($nimage,$destination,$quality);
  
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
  </div>
  
  </body>
</html>