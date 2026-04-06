<?php
include'db.php';
$id=$_POST['id'];
$name=$_POST['name'];
$email=$_POST['email'];
$sql="UPDATE nellah SET name='$name'
email='$email'WHERE id=$id";
$conn->query($sql);
header("Location:index.php");
?>
