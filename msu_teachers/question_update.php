<?php
include '../partials/connection.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $level = $_POST['level'];

    $dif = "SELECT * FROM difficulty_level WHERE `level_name`='$level'";
    $q = mysqli_query($conn, $dif);
    $row = mysqli_fetch_assoc($q);
    $dif_id = $row['difficulty_id'];

    $question = $_POST['question'];
    $op1 = $_POST['op1'];
    $op2 = $_POST['op2'];
    $op3 = $_POST['op3'];
    $op4 = $_POST['op4'];
    $cop = $_POST['cop'];



    $sql = "UPDATE `question_list` SET question_description ='$question', difficulty_level='$dif_id', option_1='$op1', option_2='$op2', option_3='$op3',option_4='$op4', correct_option='$cop' WHERE question_id = '$id'";

    $result = mysqli_query($conn, $sql) or die("query failed");
    if ($result) {
        echo 1;
    } else {
        echo 'wrong';
    }
}
