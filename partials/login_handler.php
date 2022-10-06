<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    session_start();
    include 'connection.php';
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $role=mysqli_real_escape_string($conn,$_POST['role']);
    $captcha=mysqli_real_escape_string($conn,$_POST['captcha']);
    $sessioncaptcha=$_SESSION['captcha'];


    $sql="SELECT * FROM user_register WHERE BINARY username='$username' AND role='$role'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $num=mysqli_num_rows($result);

    if($num == 1 && $sessioncaptcha == $captcha && password_verify($password,$row['password'])){

        
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$row['name'];
            $_SESSION['uname']=$row['username'];
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['code']=$row['username'];
            $_SESSION['department']=$row['department_id'];
            $_SESSION['role']=$row['role'];
            $_SESSION['faculty']=$row['faculty_id'];

            



        if($role=='admin'){
            $_SESSION['admin']=true;
            header('location:/msu_exam_portal/admin/index.php');
            // echo $_SESSION['role'];
            
        }

        if($role=='student'){
            $_SESSION['student']=true;
            header('location:/msu_exam_portal/student/index.php');
        }

        if($role=='examiner'){
            $_SESSION['examiner']=true;
            header('location:/msu_exam_portal/msu_teachers/index.php');
            // echo "this is teacher";
        }

        if($role=='super_admin'){
            $_SESSION['super_admin']=true;
            header('location:/msu_exam_portal/super_admin/index.php');
          
        }
        
        if($role=='subadmin'){
            $_SESSION['subadmin']=true;
            header('location:/msu_exam_portal/subadmin/index.php');

            // $activitynamesql1="SELECT * FROM `admin_activitity_mapping` WHERE activity_id='$username'";
            // $activitynameresult1=mysqli_query($conn,$activitynamesql1);

            // while($activityrow1=mysqli_fetch_assoc($activitynameresult1)){
            //     $activityname=$activityrow1['activity_id'];
            //     $url=$activityrow1['url'];

            //     $_SESSION[''.$activityname.'']=true;

              
            // }

        }
        
        
        
       
    }
    else{
        // echo 2;
        
        header('location:/msu_exam_portal/index.php?error=invalidcredentials');
    }
    
}



?>