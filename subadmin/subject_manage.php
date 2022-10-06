<?php
include '../partials/connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="stylesheet" href="../css/sidebar.css">

  <meta charset="UTF-8">
  <!-- bootstrap 4 required -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


     
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>STUDENT VERIFICATION</title>
  


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <style>
     .container {
            min-height: 448px;

        }

        .container thead {
            color: #263847;
            font-size: 13px;

        }
  </style>


</head>

<body>
  <?php
  include 'subadmin_header.php';
  ?>
  <div class="content-container">
    <?php
    include 'top_navbar.php';
    ?>
 

    <div class="container my-5">
      <!-- Table of student verification  -->
      <h3 class="text-center">SUBJECT MANAGEMENT</h3>
     
     
      <table id="export" class="data my-3 table-bordered table table-hover text-center">
        <thead>
          <tr>
            <th scope="col">No.</th>
            <th scope="col">SUBJECT NAME</th>
            <th scope="col">YEAR</th>
            <th scope="col">CATEGORY</th>
            <th scope="col">CODE</th>
            <th scope="col">CREDIT</th>
            <th scope="col">ACTION</th>

          </tr>
        </thead>
        <!-- fetch subject details -->
        <tbody id="msg">
        <?php
        $department=$_SESSION['department'];
        $subject = "SELECT * FROM subject_register WHERE department_id=$department";
        $query = mysqli_query($conn, $subject);
        $count = 1;
        while ($row = mysqli_fetch_assoc($query)) {

          echo '
 
    <tr id="' . $row['subject_id'] . '">
    <th scope="row">' . $count . '</th>
      <td style="text-transform: uppercase;" data-target="subject_name">' . htmlspecialchars($row['subject_name']) . '</td>
      <td><label style="font-size: 13px; ">' . htmlspecialchars($row['year']) . '</label></td>
      <td style="text-transform: uppercase;" data-target="subject_category">' . htmlspecialchars($row['subject_category']) . '</td>
      <td style="text-transform: uppercase;" data-target="subject_code">' . htmlspecialchars($row['subject_code']) . '</td>
      <td data-target="credit">' . htmlspecialchars($row['credit']) . '</td>
      <td><a   class="active" data-role="update" data-id="' . $row['subject_id'] . '" role="button"  aria-pressed="true"><i class="fas fa-2x fa-pen-square" style="color: green; cursor:pointer; text-decoration:none"></i></a>
      <a href="#" class="delete-btn  active" role="button" data-id="' . htmlspecialchars($row['subject_id']) . '" aria-pressed="true"><i class="fas fa-2x fa-trash" style="color: red;"></i></a></td>
    </tr>';
    $count++;
        }
        ?>

        </tbody>

      </table>

    </div>




    <!-- Modal -->
    <div id="update" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>

          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>SUBJECT_NAME</label>
              <input class="form-control" id="subject_name" type="text" placeholder="Default input">
            </div>
            <div class="form-group">
              <label>CATEGORY</label>
              <input class="form-control" id="subject_category" type="text" placeholder="Default input">
            </div>
            <div class="form-group">
              <label>SUBJECT_CODE</label>
              <input class="form-control" id="subject_code" type="text" placeholder="Default input">
            </div>
            <div class="form-group">
              <label>CREDIT</label>
              <input class="form-control" id="credit" type="text" placeholder="Default input">
            </div>
            <input type="hidden" id="subId" class="form-control">
          </div>
          <div class="modal-footer">
            <a type="submit" id="save" class="btn btn-primary" data-dismiss="modal">Update</a>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>

    </div>
    <?php include 'footer.php' ?>
  </div>

</body>



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




<!--year selection -->
<script>
  $(document).ready(function() {



    $('#year').on('change', function() {
      var value = $(this).val();
      $.ajax({
        url: 'subject_manage_fetch.php',
        type: 'POST',
        data: 'year=' + value,
        beforeSend: function() {
          $('#msg').html('Loading....');
        },
        success: function(data) {
          $('#msg').html(data);
        },


      });
    });
  });
</script>

<script>
  //append value in input field
  $(document).ready(function() {
    $(document).on('click', 'a[data-role=update]', function() {
      var id = $(this).data('id');
      var subject_name = $('#' + id).children('td[data-target=subject_name]').text();
      var subject_category = $('#' + id).children('td[data-target=subject_category]').text();
      var subject_code = $('#' + id).children('td[data-target=subject_code]').text();
      var credit = $('#' + id).children('td[data-target=credit]').text();

      $('#subject_name').val(subject_name);
      $('#subject_category').val(subject_category);
      $('#subject_code').val(subject_code);
      $('#credit').val(credit);
      $('#subId').val(id);
      $('#update').modal('toggle');


    });

    //update in database

    $('#save').click(function() {
      var id = $('#subId').val();
      var subject_name = $('#subject_name').val();
      var subject_category = $('#subject_category').val();
      var subject_code = $('#subject_code').val();
      var credit = $('#credit').val();

      $.ajax({

        url: 'subject_update.php',
        method: 'POST',
        data: {
          subject_name: subject_name,
          subject_category: subject_category,
          subject_code: subject_code,
          credit: credit,
          id: id
        },
        success: function(response) {
          //update table UI
          $('#' + id).children('td[data-target=subject_name]').text(subject_name);
          $('#' + id).children('td[data-target=subject_category]').text(subject_category);
          $('#' + id).children('td[data-target=subject_code]').text(subject_code);
          $('#' + id).children('td[data-target=credit]').text(credit);

        }

      });
    });


    //delete record

    $(document).on('click', '.delete-btn', function() {



      var subjectId = $(this).data('id');
      var element = this;
      $.ajax({
        url: 'subject_delete.php',
        type: 'POST',
        data: {
          id: subjectId
        },
        success: function(data) {
          if (data == 1) {
            $(element).closest('tr').fadeOut();
          } else {
            alert('Record Could not deleted');
          }
        }
      });

    });

  });
</script>

</html>

<!--EXPORT CDNS-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>




<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> 