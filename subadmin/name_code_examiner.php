<?php
include '../partials/connection.php';
session_start();

if(isset($_POST['examiner_name'])){
$examiner= $_POST['examiner_name'];
$output='';
$department=$_SESSION['department'];

$sql= "SELECT username FROM user_register WHERE name='$examiner' AND department_id=$department";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_assoc($result)){
    $output .='<option>'.$row ["username"].'</option>';

}
echo $output;
}
?>
