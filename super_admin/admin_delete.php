<?php 
include '../partials/connection.php';
session_start();

if(isset($_POST['id'])){
    $username= $_POST['id'];

    $sql= "DELETE FROM `user_register` WHERE `username` = '$username'";
    $result= mysqli_query($conn,$sql);
        
        
    if($result){
        echo 1;
    
    }else{
        echo 0;
    }
}

?>