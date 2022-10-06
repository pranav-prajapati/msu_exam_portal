<?php
include '../partials/connection.php';

$output='';
$year=$_POST['id'];
$department=$_POST['department_id'];

$sql= "SELECT * FROM subject_register WHERE `year` = '$year' AND `department_id`=$department";
$result=mysqli_query($conn,$sql);
$output .= '<option value="" disabled selected>Choose...</option>';
while($row=mysqli_fetch_array($result)){
    $output .='<option value="'.$row ["subject_id"].'">'.$row ["subject_name"].'</option>';

}

echo $output;
?>