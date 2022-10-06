<?php

include '../partials/connection.php';

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- bootstrap 4 required -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <title>STUDENTS VERIFICATION</title>

  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

  <!-- datatable cdn -->
  <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css" />

  <style>
    .container {

      min-height: 433px;

    }




    .container thead {
      color: #263847;
      font-size: 13px;

    }
    td img{
      width:140px;
    }
  </style>
</head>

<body>

  <!--sidebar start-->



  <?php include 's_admin_header.php'; ?>
  <!--sidebar end-->
  <div class="content-container">
    <?php
    include 'top_navbar.php';
    ?>
    <h3 class="text-center my-4"> STUDENTS DETAILS DATA </h3>
    <div class="container my-5">

      <form action="" method="POST" enctype="multipart/form-data">


        <table class="data table-bordered table table-hover">
          <thead>
            <tr>
              <th scope="col">NO</th>
              <th scope="col">PRN</th>
              <th scope="col">NAME</th>
              <th scope="col">subject</th>
              <th scope="col">DEPARTMENT</th>
              <th scope="col">STUDENT IMAGE</th>
              <th scope="col">STUDENT ID CARD</th>
              <th scope="col">DATE</th>
            </tr>
          </thead>
          <?php
          $query = "SELECT * FROM student_images";
          $query_run = mysqli_query($conn, $query);

          $count = 1;
          while ($row = mysqli_fetch_assoc($query_run)) {

            $prn = $row['prn'];
            $name = $row['student_name'];
            $image = $row['images'];
            $idcard = $row['id_card'];
            $date = date_create($row['login_time']);
            $subject = $row['subject_id'];

            $subject_name_sql = "SELECT * FROM subject_register WHERE subject_id=$subject";
            $subject_name_result = mysqli_query($conn, $subject_name_sql);
            $subject_row = mysqli_fetch_assoc($subject_name_result);
            $subject_name = $subject_row['subject_name'];

            $department_sql = "SELECT * FROM user_register WHERE username=$prn";
            $department_result = mysqli_query($conn, $department_sql);
            $department_row = mysqli_fetch_assoc($department_result);
            $department_id = $department_row['department_id'];
           

            $department_name_sql = "SELECT * FROM department WHERE department_id=$department_id";
            $department_name_result = mysqli_query($conn, $department_name_sql);
            $department_name_row = mysqli_fetch_assoc($department_name_result);
            $department_name = $department_name_row['department_name'];

            echo '
      <tr>
      <td>' . htmlspecialchars($count) . '</td>
      <td >' . htmlspecialchars($prn) . '</td>
      <td style="text-transform:uppercase;">' . htmlspecialchars($name) . '</td>
      <td style="text-transform:uppercase;">' . htmlspecialchars($subject_name) . '</td>
      <td style="text-transform:uppercase;"><label style="font-size: 12px; ">' . htmlspecialchars($department_name) . ' </label></td>
      <td> <img src="' . $image . '"   ></td> 
      <td> <img src="' . $idcard . '"   ></td>      
      <td><label style="font-size: 12px; ">' . date_format($date,'d/m/Y H:i:s a'). '</label></td>
      
      </tr>';

            $count++;
          }

          ?>

        </table>




      </form>

    </div>
  </div>
</body>

</html>

<!--datatables -->
<script type="text/javascript" src="../DataTables/datatables.min.js"></script>
<script type="text/javascript" src="../DataTables/dataTables.bootstrap4.min.js"></script>
<script>
  $('.data').DataTable();
</script>