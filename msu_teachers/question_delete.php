<?php 
include '../partials/connection.php';

$que_id= $_POST['id'];
 
$sql= "DELETE FROM question_list WHERE question_id = {$que_id}";
$result= mysqli_query($conn,$sql);
if($result){
    echo 1;

}else{
    echo 0;
}


?>
