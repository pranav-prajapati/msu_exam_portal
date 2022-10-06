<?php
include '../partials/connection.php';

if (isset($_POST['degree_id'])) {


    $py = mysqli_real_escape_string($conn, $_POST['py']);
    $ly = mysqli_real_escape_string($conn, $_POST['ly']);
    $degree_id = mysqli_real_escape_string($conn, $_POST['degree_id']);
    $sql3 = mysqli_query($conn, "SELECT * FROM degree WHERE `degree_id`='$degree_id'");
    $rse = mysqli_fetch_assoc($sql3);
    $degree_name = $rse['degree_name'];
    $department = mysqli_real_escape_string($conn, $_POST['department_id']);

    $existsql = "SELECT * FROM `year_degree_register` WHERE `year`='$py' OR `year`='$ly'";
    $resultx = mysqli_query($conn, $existsql);

    $num = mysqli_num_rows($resultx);




    if ($num > 0) {
        echo 2;
    } else {
        $sql = "INSERT INTO `year_degree_register` (`degree`,`degree_id`,`department_id`,`year_name`,`year`) VALUES('$degree_name','$degree_id','$department','Previous','$py')";
        $result = mysqli_query($conn, $sql);

        $sql2 = "INSERT INTO `year_degree_register` (`degree`,`degree_id`,`department_id`,`year_name`,`year`) VALUES('$degree_name','$degree_id','$department','Final','$ly')";
        $result2 = mysqli_query($conn, $sql2);


        if ($result && $result2) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
