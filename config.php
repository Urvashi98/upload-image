<?php 

$conn = mysqli_connect('localhost','root','','users');
if(!$conn){
    echo 'connection failed  ' . mysqli_connect_error();
}else{
 
  //  echo 'Connection OK';
}
?>