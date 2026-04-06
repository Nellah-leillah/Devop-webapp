<?php
$conn=new mysqli("localhost","root","","lifa");
if ($conn->connect_error){
    die("connection failed" .$conn->connect_error);
}
?>