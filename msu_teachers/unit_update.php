<?php
include '../partials/connection.php';

if (isset($_POST['topic_name'])) {
    $topic_name = mysqli_real_escape_string($conn, $_POST['topic_name']);
    $id = $_POST['id'];

    $existsql = "SELECT * FROM `subject_topic_list` WHERE `topic_name`='$topic_name'";
    $resultx = mysqli_query($conn, $existsql);
    $num = mysqli_num_rows($resultx);


    if ($num > 0) {
        echo 2;
    } else {

        $result = mysqli_query($conn, "UPDATE subject_topic_list SET topic_name='$topic_name' WHERE topic_id = $id");
        if ($result) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
