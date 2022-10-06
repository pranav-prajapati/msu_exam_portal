<?php
include 'connection.php';
$output='';
$sql= "SELECT * FROM department WHERE faculty_id = '".$_POST['Faculty']."' ORDER BY department_name";
$result=mysqli_query($conn,$sql);
$output .= '<option value="" disabled selected>Choose...</option>';
while($row=mysqli_fetch_array($result)){
    $output .='<option value="'.$row ["department_id"].'">'.$row ["department_name"].'</option>';

}
echo $output;
?>