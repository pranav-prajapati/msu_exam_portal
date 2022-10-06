<?php
include 'connection.php';

$prn=mysqli_real_escape_string($conn,$_POST['prn']);
$coreinsert=false;
$foundationinsert=false;
$electiveinsert=false;

//insert subject id and student id in student_subject_mapping table

if($_SERVER["REQUEST_METHOD"] == "POST"){

    foreach($_POST['core'] as $core){
    
        $sql="SELECT * FROM `subject_register` WHERE subject_name='$core'";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_assoc($result)){
            $id=$row['subject_id'];
            // echo $id;
        }

        $insertsql="INSERT INTO `subject_student_mapping` (`subject_id`, `student_id`) VALUES ('$id', '$prn')";
        $insertresult=mysqli_query($conn,$insertsql);

        if($insertresult){
            $coreinsert=true;
        }
        
    }


    foreach($_POST['foundation'] as $foundation){

        $sql="SELECT * FROM `subject_register` WHERE subject_name='$foundation'";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_assoc($result)){
            $id=$row['subject_id'];
            // echo $id;
        }

        $insertsql="INSERT INTO `subject_student_mapping` (`subject_id`, `student_id`) VALUES ('$id', '$prn')";
        $insertresult=mysqli_query($conn,$insertsql);

        if($insertresult){
            $foundationinsert=true;
        }
        
    }

    foreach($_POST['elective'] as $elective){
        $sql="SELECT * FROM `subject_register` WHERE subject_name='$elective'";
        $result=mysqli_query($conn,$sql);

        while($row=mysqli_fetch_assoc($result)){
            $id=$row['subject_id'];
            // echo $id;
        }

        $insertsql="INSERT INTO `subject_student_mapping` (`subject_id`, `student_id`) VALUES ('$id', '$prn')";
        $insertresult=mysqli_query($conn,$insertsql);

        if($insertresult){
            $electiveinsert=true;
        }
    }

    
    if($coreinsert&&$foundationinsert&&$electiveinsert){
        echo '<script> window.location.assign("/msu_exam_portal/index.php?signup=success") </script>';
    }
    else{
        echo '<script> window.location.assign("/msu_exam_portal/index.php?signup=failed") </script>';
    }
}

?>
