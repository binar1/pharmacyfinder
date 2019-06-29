<?php
require_once '../init.php'; 
 $con=mysqli_connect ("localhost", 'root', '12345','pharmacy');
 $user=new User();
  $id=$user->data()->id;
 // Check connection
 if ($con->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 } 
   if (isset($_GET['lat']) && isset($_GET['lng'])) {
    $lat=$_GET['lat'];
    $lng=$_GET['lng'];

      $sql = "UPDATE user SET  log='".$lng."',lat='".$lat."' WHERE id='".$id."';";
      
      if ($con->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $con->error;
    }
             
                 


                }
?>