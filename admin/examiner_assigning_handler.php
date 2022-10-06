<?php
include "../partials/connection.php";

$sub_name=$_POST['sub_name'];
$subject_code=$_POST['subject_code'];
$examiner_name=$_POST['examiner_name'];
$examiner_code=$_POST['examiner_code'];
$faculty=$_POST['faculty_id'];
$department=$_POST['department_id'];
$role=$_POST['role'];
// echo $examiner_code;

//fetching subject_id
$id="SELECT * FROM subject_register WHERE subject_code= '$subject_code'";
$idresult=mysqli_query($conn,$id);
$row=mysqli_fetch_assoc($idresult);
$subject_id=$row['subject_id'];

$existsql="SELECT * FROM `subject_examiner_mapping` WHERE subject_id='$subject_id' AND examiner_code='$examiner_code' AND examiner_role='$role'";
$existresult=mysqli_query($conn,$existsql);

$num=mysqli_num_rows($existresult);

if($num==0){
    $sql="INSERT INTO `subject_examiner_mapping` (`subject_id`, `examiner_name`, `examiner_code`, `examiner_role`, `subject_name`,`faculty_id`,`department_id`)
    VALUES ('$subject_id', '$examiner_name', '$examiner_code', '$role', '$sub_name','$faculty','$department')";
    
    $result= mysqli_query($conn,$sql);
    if($result)
   {
    echo 1;
   }
}
else{
    echo 0;
}

?>