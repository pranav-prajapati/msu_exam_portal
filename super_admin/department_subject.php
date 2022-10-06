<?php
include '../partials/connection.php';

$output='';
$department=$_POST['department'];

$sql= "SELECT * FROM subject_register WHERE `department_id` = '$department'";
$result=mysqli_query($conn,$sql);
$output .= '<option value="" disabled selected>Choose...</option>';
while($row=mysqli_fetch_array($result)){
    $output .='<option value="'.$row ["subject_name"].'">'.$row ["subject_name"].'</option>';

}

echo $output;
?>