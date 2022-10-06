<?php
include "../partials/connection.php";
$output='';
$degree=$_POST['Degree'];
echo $degree;
$sql= "SELECT * FROM year_degree_register WHERE `degree` = '$degree' ORDER BY id";
$result=mysqli_query($conn,$sql);
$output .= '<option hidden disabled selected>Choose...</option>';
while($row=mysqli_fetch_array($result)){
    $output .='<option value="'.$row ["year_name"].'">'.$row ["year_name"].'</option>';

}

echo $output;
?>