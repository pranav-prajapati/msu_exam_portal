<?php
include 'connection.php';

$output='';
$username=$_POST['username'];

$sql= "SELECT `role` FROM `user_register` WHERE `username` = '$username'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

$output .= $row['role'];


echo $output;
?>