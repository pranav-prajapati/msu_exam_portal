<?php
include '../partials/connection.php';

if (isset($_POST['id'])) {
     $unit = $_POST['unit'];
     $id =  $_POST['id'];
     $number = count($_POST["unit"]);




     if ($number > 0) {
          for ($i = 0; $i < $number; $i++) {
               if (trim($_POST["unit"][$i] != '')) {

                    $existsql = "SELECT * FROM `subject_topic_list` WHERE `topic_name`='$unit[$i]'";
                    $resultx = mysqli_query($conn, $existsql);
                    $num = mysqli_num_rows($resultx);


                    if ($num > 0) {
                         echo 2;
                    } else {
                         $sql = "INSERT INTO subject_topic_list(`subject_id`,`topic_name`) VALUES('$id', '$unit[$i]')";
                         $result = mysqli_query($conn, $sql);
                         
                         if($result){
                              echo 1;
                         }else{
                              echo 0;
                         }
                    }
               }
          }
          
     } else {
          echo 0;
     }
}
