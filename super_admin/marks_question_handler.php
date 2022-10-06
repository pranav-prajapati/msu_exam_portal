<?php
include '../partials/connection.php';


if (isset($_POST['subject_name'])) {
    $subject_name = $_POST['subject_name'];
    $sub = "SELECT * FROM subject_register WHERE `subject_name`='$subject_name'";
    $re = mysqli_query($conn, $sub);
    $ro = mysqli_fetch_assoc($re);
    $subject_id = $ro['subject_id'];
    $department_id=$ro['department_id'];

    $total_question = $_POST['total_question'];
    $easy = $_POST['easy'];
    $intermediate = $_POST['intermediate'];
    $hard = $_POST['hard'];
    $each_marks=$_POST['each_marks'];
    $total_marks = $_POST['total_marks'];


    $existsql="SELECT * FROM `marks_question` WHERE subject_id='$subject_id'";
    $existresult=mysqli_query($conn,$existsql);

    $num=mysqli_num_rows($existresult);

    if($num==0){

        $query = "INSERT INTO `marks_question` (`subject_id`,`department_id`,`total_question`, `easy`, `intermediate`, `hard`,`each_marks`,`total_marks`) VALUES ('$subject_id','$department_id','$total_question', '$easy', '$intermediate', '$hard','$each_marks','$total_marks')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo 1;
        } 
    }
    else{
        echo 0;
    }
}

if(isset($_POST['start'])){

    $subject_id=$_POST['subject'];

    $updatesql="UPDATE `examination_schedule` SET `exam_status` = '1' WHERE `examination_schedule`.`subject_id` = $subject_id";

    $updateresult=mysqli_query($conn,$updatesql);

    if($updateresult){
        header('location:../super_admin/marks_question.php');
    }
}

if(isset($_POST['cancel'])){

    $subject_id=$_POST['subject'];

    $updatesql="UPDATE `examination_schedule` SET `exam_status` = '0' WHERE `examination_schedule`.`subject_id` = $subject_id";

    $updateresult=mysqli_query($conn,$updatesql);

    if($updateresult){
        header('location:../super_admin/marks_question.php');
    }
}