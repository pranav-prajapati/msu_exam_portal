<?php
include '../partials/connection.php';
session_start();

if(isset($_POST['sub_name'])){
$subject=$_POST['sub_name'];
$output='';
$department=$_SESSION['department'];

$sql= "SELECT subject_code FROM subject_register WHERE subject_name= '$subject' AND department_id=$department";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result)){
    $output .='<option>'.$row ["subject_code"].'</option>';

}
echo $output;
}
?>
