<?php
include '../partials/connection.php';

if (isset($_POST['subject_code'])) {
    $sub_name = mysqli_real_escape_string($conn, $_POST['subject_name']);
    $sub_cat = mysqli_real_escape_string($conn, $_POST['subject_category']);
    $sub_code = mysqli_real_escape_string($conn, $_POST['subject_code']);
    $credit = mysqli_real_escape_string($conn, $_POST['credit']);
    $id = $_POST['id'];



    $result = mysqli_query($conn, "UPDATE subject_register SET subject_name='$sub_name', subject_category='$sub_cat', subject_code='$sub_code', credit='$credit' WHERE subject_id = $id");
    $result = mysqli_query($conn, "UPDATE subject_examiner_mapping SET subject_name='$sub_name' WHERE subject_code='$sub_code' ");

    if ($result) {
        echo 'data updated';
    }
}
