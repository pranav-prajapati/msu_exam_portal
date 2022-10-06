<?php 
include '../partials/connection.php';

if(isset($_POST['date'])){
       $id=$_POST['id'];
       $date=mysqli_real_escape_string($conn,$_POST['date']);
       $time=mysqli_real_escape_string($conn,$_POST['time']);
       $minute=mysqli_real_escape_string($conn,$_POST['minute']);
       $slot=mysqli_real_escape_string($conn,$_POST['slot']);


       $result = mysqli_query($conn, "UPDATE examination_schedule SET `exam_date`='$date', `exam_time`='$time', `exam_duration`='$minute', `slot_id`='$slot' WHERE examination_id = $id");
       if($result){
        echo 1;
    
    }else{
        echo 0;
    }


}
?>



