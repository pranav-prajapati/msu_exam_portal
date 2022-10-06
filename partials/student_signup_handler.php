<?php

include 'connection.php' ;

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $fullname=mysqli_real_escape_string($conn,$_GET['fullname']);
    $email=mysqli_real_escape_string($conn,$_GET['email']);
    $prn=mysqli_real_escape_string($conn,$_GET['prn']);
    $degree=mysqli_real_escape_string($conn,$_GET['degree']);
    $faculty=mysqli_real_escape_string($conn,$_GET['faculty']);
    $department=mysqli_real_escape_string($conn,$_GET['department']);
    $year=mysqli_real_escape_string($conn,$_GET['year']);
    $phone=mysqli_real_escape_string($conn,$_GET['phone']);

    // echo $fullname;
    // echo $email;
    // echo $prn;
    // echo $faculty;
    // echo $department;
    // echo $year;
    // echo $phone;
    $existsql="SELECT * FROM `student_register` WHERE prn_number='$prn'";
    $result=mysqli_query($conn,$existsql);

    $num=mysqli_num_rows($result);
    
    if($num > 0){
        // echo "user already registered";
        echo '<script> window.location.assign("student_signup.php?error=user_already_registered") </script>';
    }
    else{
        $sql="INSERT INTO `student_register` (`student_name`, `prn_number`, `email_id`, `contact_number`, `year`,`degree_id`, `faculty_id`, `department_id`,`verification_status`) 
        VALUES ('$fullname', '$prn', '$email', '$phone', '$year','$degree', '$faculty', '$department','0');";
        $result=mysqli_query($conn,$sql);
        
        if($result)
        {
            header("Location:subject_selection.php?name=$fullname&prn=$prn&year=$year&department=$department");  
            // echo mysqli_error($conn);  
        }
        else
        {
            echo '<script> window.location.assign("student_signup.php?error=some_error_occured...record not inserted") </script>';
        }
    }
    
}

?>