<?php
include "../partials/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $subject_id=$_POST['subject_id'];


  $topic_name = $_POST['topic_name'];
  $question_desc = mysqli_real_escape_string($conn,$_POST['question_desc']);
  $diff_level = $_POST['diff_level'];
  $bloom_tex = $_POST['bloom_tex'];
  $op_1 = mysqli_real_escape_string($conn,$_POST['op_1']);
  $op_2 = mysqli_real_escape_string($conn,$_POST['op_2']);
  $op_3 = mysqli_real_escape_string($conn,$_POST['op_3']);
  $op_4 = mysqli_real_escape_string($conn,$_POST['op_4']);
  $correct_option = mysqli_real_escape_string($conn,$_POST['correct_option']);
  $filename=$_FILES['image']['name'];
  $tempname=$_FILES['image']['tmp_name'];
  $folder="../msu_teachers/images/".$filename;
  move_uploaded_file($tempname,$folder);

  if($filename){
        $sql = "INSERT INTO `question_list` (`question_description`,`image/text`,`option_1`, `option_2`, `option_3`, `option_4`, `correct_option`, `topic_id`,`subject_id`, `difficulty_level`, `blooms_texonomy_level`) 
        VALUES ('$folder','image','$op_1', '$op_2', '$op_3', '$op_4', '$correct_option', '$topic_name','$subject_id', '$diff_level', '$bloom_tex');";

      $result = mysqli_query($conn, $sql);

      if ($result)
      {
        echo 1;
      }
      else
        {
        echo 0;
      
        }

  }
  else{

        $sql = "INSERT INTO `question_list` (`question_description`,`image/text`,`option_1`, `option_2`, `option_3`, `option_4`, `correct_option`, `topic_id`,`subject_id`, `difficulty_level`, `blooms_texonomy_level`) 
          VALUES ('$question_desc','text','$op_1', '$op_2', '$op_3', '$op_4', '$correct_option', '$topic_name','$subject_id', '$diff_level', '$bloom_tex');";

        $result = mysqli_query($conn, $sql);

        if ($result)
        {
          echo 1;
        }
        else
          {
          echo 0;
        
          }

  }
  
    

    
}
?>