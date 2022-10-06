<?php 
include '../partials/connection.php';

$id= $_POST['id'];
 
$sql= "DELETE FROM marks_question WHERE id = {$id}";
$result= mysqli_query($conn,$sql);
if($result){
    echo 1;

}else{
    echo 0;
}


?>