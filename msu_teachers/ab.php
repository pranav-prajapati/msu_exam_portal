<?php
include '../partials/connection.php';
if(isset($_REQUEST['update'])){
    $level = $_POST['level'];

    // $dif = "SELECT * FROM difficulty_level WHERE `level_name`='$level'";
    // $q = mysqli_query($conn, $dif);
    // $row = mysqli_fetch_assoc($q);
    // $dif_id = $row['difficulty_id'];



    $question = $_POST['question'];
    $op1 = $_POST['op1'];
    $op2 = $_POST['op2'];
    $op3 = $_POST['op3'];
    $op4 = $_POST['op4'];
    $cop = $_POST['cop'];
    $id = $_POST['queId'];
    
    $image=$_POST['image'];
    echo $image;
    echo $id;
    echo $question;

}