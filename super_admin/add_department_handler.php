<?php 
include '../partials/connection.php';

if(isset($_POST['department_name'])){
    $dep_name=$_POST['department_name'];
   
   $faculty=$_POST['faculty_id'];
    
    $existsql="SELECT * FROM `department` WHERE `department_name`='$dep_name'";
    $result=mysqli_query($conn,$existsql);

    $num=mysqli_num_rows($result);
    
    

    if($num > 0){
        echo 2;
    }else{
        $sql="INSERT INTO `department` (`department_name`,`faculty_id`) VALUES('$dep_name','$faculty')";
        $result=mysqli_query($conn,$sql);
        
        if($result){
           echo 1;
         

        }else{
            echo 0;
        }

    }







    

}



?>