<?php

include "../partials/connection.php";
$name=mysqli_real_escape_string($conn,$_POST['name']);
if(isset($_POST['year'])){
$year=mysqli_real_escape_string($conn,$_POST['year']);

$degree=mysqli_real_escape_string($conn,$_POST['degree']);

$core=mysqli_real_escape_string($conn,$_POST['core']);

$foundation=mysqli_real_escape_string($conn,$_POST['foundation']);

$elective=mysqli_real_escape_string($conn,$_POST['elective']);

$sql="UPDATE `year_degree_register` SET core ='$core', foundation='$foundation', elective='$elective' WHERE year_name='$year' AND degree='$degree' ";


 $result=mysqli_query($conn,$sql);
 if ($result)
 {
     header('location:subject_selection.php');
 }
 else
 {
    header('location:subject_selection.php');
 }

}
?>