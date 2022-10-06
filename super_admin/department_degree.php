<?php
include '../partials/connection.php';

$output='';
$department=$_POST['department'];

$sql= "SELECT * FROM degree WHERE `department_id` = '$department'";
$result=mysqli_query($conn,$sql);
$output .= '<option value="" disabled selected>Choose...</option>';
while($row=mysqli_fetch_array($result)){
    $output .='<option value="'.$row ["degree_id"].'">'.$row ["degree_name"].'</option>';

}

echo $output;
?>