<?php
include '../partials/connection.php';
session_start();

if(isset($_POST['examiner_name'])){
$examiner= $_POST['examiner_name'];
$output='';
$faculty=$_SESSION['faculty'];

$sql= "SELECT username FROM user_register WHERE name='$examiner' AND faculty_id=$faculty";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result)){
    $output .='<option>'.$row ["username"].'</option>';

}
echo $output;
}
?>
