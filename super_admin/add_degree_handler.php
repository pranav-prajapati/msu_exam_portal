<?php 
include '../partials/connection.php';

if(isset($_POST['degree_name'])){
    
    $degree_name=mysqli_real_escape_string($conn,$_POST['degree_name']);
    $department=mysqli_real_escape_string($conn,$_POST['department_id']);
    
    $existsql="SELECT * FROM `degree` WHERE `degree_name`='$degree_name'";
    $result=mysqli_query($conn,$existsql);

    $num=mysqli_num_rows($result);
    
    

    if($num > 0){
        echo 2;
    
    }else{
        $sql="INSERT INTO `degree` (`degree_name`,`department_id`) VALUES('$degree_name','$department')";
        $result=mysqli_query($conn,$sql);
        
        if($result){
           echo 1;
         

        }else{
            echo 0;
        }

    }







    

}



?>