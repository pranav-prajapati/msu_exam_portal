<?php
include '../partials/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../css/sidebar.css">


  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


 
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">


  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UNIT </title>

  <style>
    .container {
      min-height: 448px;

    }

    /* status and edit link properties */
    .container a {
      padding: 5px;
      width: 100px;
      text-align: center;
      font-size: 15px;

    }

  

    /* heading properties */
    .container thead {
      color: #263847;
      font-size: 13px;

    }

    .container span {
      color: gray;
      font-size: 12px;
    }

    @media screen and (max-width: 550px) {
      .container a {
        padding: 5px;
        width: 70px;
        text-align: center;
        font-size: 12px;
      }


      .container thead {
        color: #263847;
        font-size: 15px;
      }


    }

    @media screen and (max-width: 452px) {


      .container thead {
        color: #263847;
        font-size: 12px;
      }


    }


    @media screen and (max-width: 400px) {
      .container a {
        padding: 5px;
        width: 50px;
        text-align: center;
        font-size: 10px;
      }

      .container thead {
        color: #263847;
        font-size: 15px;
      }
    }
  </style>


</head>

<body>


  <!--sidebar start-->
  <?php include 'teacher_header.php'; ?>


  <!--sidebar end-->


  <div class="content-container">
  <?php include 'top_navbar.php'; ?>
    <div class="container my-5">
      <!-- Table of unit  -->

      <h3 class="text-center">ADD UNIT</h3>

    
      <table class="data my-3 table-bordered table table-hover text-center">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">SUBJECT NAME</th>
            <th scope="col">CATEGORY</th>
            <th scope="col">CODE</th>
            <th scope="col">CREDIT</th>
            <th scope="col">ADD UNIT</th>
          </tr>
        </thead>
        <!-- fetch subject details -->
        <tbody>

          <?php
          $examiner_code = $_SESSION['code'];

          $query = "SELECT * FROM subject_examiner_mapping WHERE `examiner_role`='Paper Setter' AND examiner_code='$examiner_code'";
          $abc = mysqli_query($conn, $query);
          $count = 1;
          while ($rowx = mysqli_fetch_assoc($abc)) {

            $subname = $rowx['subject_name'];
            $subid = $rowx['subject_id'];



            $subject = "SELECT * FROM subject_register WHERE `subject_id`='$subid'";
            $query = mysqli_query($conn, $subject);
            $row = mysqli_fetch_assoc($query);

            echo '
 
            <tr id="' . $row['subject_id'] . '">
              <th scope="row">' . $count . '</th>
              <td style="text-transform: uppercase;" data-target="subject_name">' . htmlspecialchars($rowx['subject_name']) . '</td>
              <td style="text-transform: uppercase;"  data-target="subject_category">' . htmlspecialchars($row['subject_category']) . '</td>
              <td style="text-transform: uppercase;"  data-target="subject_code">' . htmlspecialchars($row['subject_code']) . '</td>
              <td style="text-transform: uppercase;"  data-target="credit">' . htmlspecialchars($row['credit']) . '</td>
              <td><a href="unit.php?id=' . $row['subject_id'] . '" class="btn btn-success active" data-role="update" data-id="' . $row['subject_id'] . '" role="button"  aria-pressed="true">ADD UNIT</a></td>
              
            </tr>';

            $count++;
          }
          ?>

        </tbody>

      </table>

    </div>
  
    
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


    <?php include '../partials/script.php'; ?>
    <?php include 'footer.php'; ?>
  </div>
</body>




</html>

<!--EXPORT CDNS-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>