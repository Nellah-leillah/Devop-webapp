<?php
include 'db.php';
$name=$_POST['name'];
$email=$_POST['email'];
$sql="INSERT INTO nellah(name,email) VALUES('$name','$email')";
if($conn->query($sql)===TRUE){
header("Location:index.php");
}
else{
    echo"Error" .$conn->error;
}
?>
