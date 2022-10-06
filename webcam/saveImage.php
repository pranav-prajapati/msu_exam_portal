<?php
     include '../partials/connection.php';
     session_start();
    $_SESSION['exam_main']=false;
    if(ISSET($_POST['save'])&&$_POST['image']!=null&&$_POST['image2']!=null){
    $img = $_POST['image'];
    $img1 = $_POST['image2'];
    $name = $_POST['name'];
    $prn = $_POST['prn'];
    $subject_id=$_POST['subject'];

    $folderPath = "upload/";

    //fetching subject name

    $subjectsql="SELECT * FROM `subject_register` WHERE subject_id=$subject_id";
    $subjectresult=mysqli_query($conn,$subjectsql);

    $namerow=mysqli_fetch_assoc($subjectresult);

    $subjectname=$namerow['subject_name'];

    //first image
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = $subjectname.'_'.$name . '.jpeg';
    
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
  
 
    //second image
    $image_parts1 = explode(";base64,", $img1);
    $image_type_aux1 = explode("image/", $image_parts1[0]);
    $image_type1 = $image_type_aux1[1];
  
    $image_base641 = base64_decode($image_parts1[1]);
    
    $fileName2 = $subjectname.'_'.$name . '_id-card.jpeg';
  
    $file1 = $folderPath . $fileName2;

    file_put_contents($file1, $image_base641);

    $_SESSION['exam_main']=true;
 
      
      
      if($_SESSION['exam_main']){

          //if user logged out middle of exam then exam starts from where he left

          $exist="SELECT * FROM `answer_student_mapping` WHERE answer IS NULL AND subject_id=$subject_id AND student_id=$prn";
          $existresult=mysqli_query($conn,$exist);
          $existrow=mysqli_fetch_assoc($existresult);

          $existnum=mysqli_num_rows($existresult);
          
          $sql3="SELECT * FROM `answer_student_mapping` WHERE answer IS NOT NULL AND subject_id=$subject_id AND student_id=$prn";
          $result3=mysqli_query($conn,$sql3);
                    
          $num=mysqli_num_rows($result3);

          if($num>0 || $existnum>0){

              echo '<script> location.replace("/msu_exam_portal/student/exam_main.php"); </script>';
          }
          else{

            //inserts image path of webcam pictures 

            $sql="INSERT INTO `student_images` (`prn`,`subject_id`,`student_name`, `images`, `id_card`, `login_time`) VALUES ('$prn','$subject_id','$name', '../webcam/$file', '../webcam/$file1', NOW())";
            $result=mysqli_query($conn,$sql);

            // fetching number of easy,intermediate and hardquestion

            $difficulty="SELECT * FROM `marks_question` WHERE subject_id=$subject_id";
            $difficultyresult=mysqli_query($conn,$difficulty);
            $difficultyrow=mysqli_fetch_assoc($difficultyresult);
            $easy=$difficultyrow['easy'];
            $intermediate=$difficultyrow['intermediate'];
            $hard=$difficultyrow['hard'];

            //easy
            $easysql="SELECT * FROM question_list WHERE subject_id=$subject_id AND difficulty_level=1 ORDER BY rand() limit $easy";
            $easyresult=mysqli_query($conn,$easysql);
  
            while($easyrow=mysqli_fetch_assoc($easyresult)){
   
              $questionid=$easyrow['question_id'];

              $inserteasysql="INSERT INTO `answer_student_mapping` (`question_id`,`subject_id`,`student_id`) VALUES ('$questionid','$subject_id','$prn')";
  
              $inserteasyresult=mysqli_query($conn,$inserteasysql);

              // echo $questionid.' easy <br>';
            }

            //intermediate
            $intermediatesql="SELECT * FROM question_list WHERE subject_id=$subject_id AND difficulty_level=2 ORDER BY rand() limit $intermediate";
            $intermediateresult=mysqli_query($conn,$intermediatesql);
  
            while($intermediaterow=mysqli_fetch_assoc($intermediateresult)){
   
              $questionid=$intermediaterow['question_id'];

              $insertintermediatesql="INSERT INTO `answer_student_mapping` (`question_id`,`subject_id`,`student_id`) VALUES ('$questionid','$subject_id','$prn')";
  
              $insertintermediateresult=mysqli_query($conn,$insertintermediatesql);

              // echo $questionid.' intermediate <br>';
            }

            //hard
            $hardsql="SELECT * FROM question_list WHERE subject_id=$subject_id AND difficulty_level=3 ORDER BY rand() limit $hard";
            $hardresult=mysqli_query($conn,$hardsql);
  
            while($hardrow=mysqli_fetch_assoc($hardresult)){
   
              $questionid=$hardrow['question_id'];

              $inserthardsql="INSERT INTO `answer_student_mapping` (`question_id`,`subject_id`,`student_id`) VALUES ('$questionid','$subject_id','$prn')";
  
              $inserthardresult=mysqli_query($conn,$inserthardsql);

              // echo $questionid.' hard';
            }
          }

          
          
      }
          

        echo '
        <script type = "text/javascript">
            alert("Saved Image Successfully!");
            window.location = "../student/exam_main.php";
        </script>';

        
      }
  else{
    echo '
                <script type = "text/javascript">
                    alert("please capture both the photos");
                    window.location = "index.php";
                </script>
            ';
  }
?>