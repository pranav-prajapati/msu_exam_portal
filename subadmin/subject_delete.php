<?php 
include '../partials/connection.php';
if(isset($_POST['id'])){
$subject_id= $_POST['id'];
 
$sql= "DELETE FROM subject_register WHERE subject_id = {$subject_id}";
$res=mysqli_query($conn,$sql);

$sql2= "DELETE FROM subject_examiner_mapping WHERE subject_id = {$subject_id}";
$result= mysqli_query($conn,$sql2);

$sql3= "DELETE FROM subject_topic_list WHERE subject_id = {$subject_id}";
$result2= mysqli_query($conn,$sql3);

$sql4= "DELETE FROM examination_schedule WHERE subject_id = {$subject_id}";
$result3= mysqli_query($conn,$sql4);

if($res && $result && $result2 && $result3){
    echo 1;

}else{
    echo 0;
}
}

?>



