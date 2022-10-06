<?php 
include '../partials/connection.php';

$topic_id= $_POST['id'];
 
$sql= "DELETE FROM subject_topic_list WHERE topic_id = {$topic_id}";
$result= mysqli_query($conn,$sql);
if($result){
    echo 1;

}else{
    echo 0;
}


?>
