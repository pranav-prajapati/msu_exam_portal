<?php
include 'connection.php';

$output='';
$degree=$_POST['degree'];

$sql= "SELECT * FROM year_degree_register WHERE `degree_id` = '$degree'";
$result=mysqli_query($conn,$sql);
$output .= '<option value="" disabled selected>Choose...</option>';
while($row=mysqli_fetch_array($result)){
    $output .='<option value="'.$row ["year"].'">'.$row ["year_name"].'</option>';

}
echo $output;
?>