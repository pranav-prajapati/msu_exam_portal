<?php
include '../partials/connection.php';
session_start();
if(isset($_POST['faculty_id'])){
$faculty=$_POST['faculty_id'];
$department=$_SESSION['department'];
$output='';
$sql= "SELECT * FROM department WHERE faculty_id = '$faculty' AND department_id='$department' ORDER BY department_name";
$result=mysqli_query($conn,$sql);
$output .= '<option value="" disabled selected>SELECT DEPARTMENT</option>';
while($row=mysqli_fetch_array($result)){
    $output .='<option value="'.$row ["department_id"].'">'.$row ["department_name"].'</option>';

}
echo $output;

}