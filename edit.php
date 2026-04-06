<?php
include'db.php';
$id=$_GET['id'];
$result=$conn->query("SELECT*FORM users WHERE id=$id");
$row=$result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user Form</title>
</head>
<body>
   <form action="update.php"method="POST">
    <input type="hidden"name="id"value="<?"=$row['id']?>">
    <input type="text"name="name"value="<?=$row['name']?>">
    <input type="email"name="email"value="<?=$row['email']?>">
    <button type="email"name="email"value="<?=$row['email']?>">
    <button type="submit">Update</button>
</form>
</body>
</html>
