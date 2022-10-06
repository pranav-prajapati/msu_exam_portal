<?php
include '../partials/connection.php';
session_start();

if(isset($_POST['sub_name'])){
$subject=$_POST['sub_name'];
$output='';
$faculty=$_SESSION['faculty'];

$sql= "SELECT subject_code FROM subject_register WHERE subject_name= '$subject' AND faculty_id=$faculty";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result)){
    $output .='<option>'.$row ["subject_code"].'</option>';

}
echo $output;
}
?>
