<?php 
include '../partials/connection.php';

$exam_id= $_POST['id'];
 
$sql= "DELETE FROM examination_schedule WHERE examination_id = {$exam_id}";
$result= mysqli_query($conn,$sql);
if($result){
    echo 1;

}else{
    echo 0;
}


?>
