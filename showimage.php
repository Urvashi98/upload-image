<?php 

	require_once 'config.php';
	
	$input_err='';
	
	if(isset($_POST['submit'])){
		if(isset($_POST['showimage']) && !empty($_POST['showimage'])){
				$name= $_POST['showimage'];
				$sql = "SELECT name FROM images WHERE name = '$name'";
				$result = mysqli_query($conn,$sql);
			
			if(mysqli_num_rows($result)>0){
				$row = mysqli_fetch_array($result);

				$image = $row['name'];
				
				//image source will be given to as SRC for <img> tag.
				$image_src = "upload/".$name;
				
				
			}
		}
		else{
			
			$input_err = "Please enter an image name!";
			
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
    </style>
  </head>
  <body>
 <div class="container">
    <div class="row">
  <div class="col-md-6 ">
                      
                 <h2 style="margin-left:40px;">Choose an Image</h2><hr>
                <!--Form -->
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                        
                        <div class="form-group w-60 style" >
                         <input type="text" name="showimage" class="form-control" value="" placeholder="Enter image name" />
                        </div> 
						
						<div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Show" name="submit"  style="margin-left:40px;">      
                        </div>
						
						<span class="error"><?php  echo $input_err; ?></span>
						
                        </form>
						
						
      </div>
	   <div class="col-md-6 ">
	   
						<img class="img-responsive" src="<?php echo $image_src;  ?>" alt="My Image" width="600px" height="500px">
	   </div>
	  
  </div>
</div>


  </body>
</html>