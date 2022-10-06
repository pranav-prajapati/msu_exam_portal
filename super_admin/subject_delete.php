<?php 
include '../partials/connection.php';

$subject_id= $_POST['id'];
 
$sql= "DELETE FROM subject_register WHERE subject_id = {$subject_id}";
$result= mysqli_query($conn,$sql);
if($result){
    echo 1;

}else{
    echo 0;
}


?>



