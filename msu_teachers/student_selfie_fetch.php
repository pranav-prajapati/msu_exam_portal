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


  <title>STUDENT DATA</title>

  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">


  <style>
    .container {
      padding: 20px;
      width: 90%;

    }

    #dropdown {
      width: 20%;
      margin-left: 100px;
      border: 1px solid #ddd;
    }

    td img {
      width: 140px;
    }
    .container thead {
            color: #263847;
            font-size: 13px;

        }

    #myInput {
      background-position: 10px 12px;
      background-repeat: no-repeat;
      width: 20%;
      margin-left: 600px;
      font-size: 16px;
      height: 50px;
      border: 1px solid #ddd;
    }
  </style>
</head>

<body>

  <!--sidebar start-->



  <?php include 'teacher_header.php'; ?>
  <!--sidebar end-->
  <div class="content-container">
    <?php include 'top_navbar.php'; ?>
    <h3 class="text-center my-3"> STUDENTS DETAILS DATA </h3>
    <div class="container my-5">

      <form action="" method="POST" enctype="multipart/form-data">


        <table class="data table-bordered table table-hover">
          <thead>
            <tr>
              <th scope="col">NO</th>
              <th scope="col">PRN</th>
              <th scope="col">NAME</th>
              <th scope="col">SUBJECT</th>
              <th scope="col">STUDENT IMAGE</th>
              <th scope="col">STUDENT ID CARD</th>
              <th scope="col">DATE</th>
            </tr>
          </thead>
          <?php
          $code = $_SESSION['uname'];

          $sql = mysqli_query($conn, "SELECT * FROM subject_examiner_mapping WHERE `examiner_role`='Paper Setter' AND `examiner_code`='$code'");
          while ($re = mysqli_fetch_assoc($sql)) {
            $sub_id = $re['subject_id'];


            $query = "SELECT * FROM student_images WHERE `subject_id`='$sub_id'";
            $query_run = mysqli_query($conn, $query);

            $count = 1;
            while ($row = mysqli_fetch_assoc($query_run)) {
              $subject_id = $row['subject_id'];

              $subject_name= "SELECT * FROM subject_register WHERE subject_id=$subject_id";
              $subject_result = mysqli_query($conn, $subject_name);
              $subject_row = mysqli_fetch_assoc($subject_result);
              $subname = $subject_row['subject_name'];

              $prn = $row['prn'];
              $name = $row['student_name'];
              $image = $row['images'];
              $idcard = $row['id_card'];
              $date = date_create($row['login_time']);

              echo '
      <tr>
      <td>' . $count . '</td>
      <td>' . $prn . '</td>
      <td>' . $name . '</td>
      <td>' . $subname . '</td>
      <td> <img src="' . $image . '"   ></td> 
      <td> <img src="' . $idcard . '"   ></td>      
      <td>' . date_format($date, 'd/m/Y H:i:s a') . '</td>
      
      </tr>';

              $count++;
            }
          }

          ?>

        </table>




      </form>

    </div>
  </div>
</body>

</html>


<script>
  $(document).ready(function() {
    $('.data').DataTable({
      "lengthMenu": [10, 25, 50, 75, 100],
      dom: 'Blfrtip',
      buttons: [

        {
          extend: 'excelHtml5',
          text: '',
          className: 'exc',
          titleAttr: 'Excel'

        },
        {
          extend: 'csvHtml5',
          text: '',
          className: 'cv',
          titleAttr: 'CSV'
        },
        {
          extend: 'pdfHtml5',
          text: '',
          className: 'pf',
          titleAttr: 'PDF'
        }
      ]
    });
    $('.exc').attr("class", "fas p-2 fa-file-excel mx-2 btn-success");
    $('.pf').attr("class", "fas p-2 fa-file-pdf mx-2 btn-danger");
    $('.cv').attr("class", "fas p-2 fa-file-csv mx-2 btn-warning ");
  });
</script>
<!--EXPORT CDNS-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>




<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>