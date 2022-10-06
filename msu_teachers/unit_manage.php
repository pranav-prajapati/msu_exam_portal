<?php include '../partials/connection.php'; 

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/sidebar.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="../js/sweetalert.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

    <title>UNIT MANAGE</title>
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
      font-size: 15px;

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
        font-size: 12px;
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
    <!-- Table of student verification  -->
    <h3 class="text-center" style="text-transform:uppercase;"><?php echo $_GET['subject_name']; ?> </h3>
    <table  class="data my-3 table-bordered table table-hover text-center">
      <thead>
        <tr>
        <th scope="col">NO.</th>
          <th scope="col">UNIT NAME</th>
         
          <th scope="col">ACTION</th>
        
        </tr>
      </thead>
      <!-- fetch subject details -->
      <tbody>
        <?php
        $subject_name=$_GET['subject_name'];
        $sub="SELECT * FROM subject_register WHERE `subject_name`='$subject_name'";
        $re=mysqli_query($conn,$sub);
        $ro=mysqli_fetch_assoc($re);
        $id=$ro['subject_id'];
        

        $unit = "SELECT * FROM subject_topic_list WHERE `subject_id`='$id'";
        $query = mysqli_query($conn, $unit);
        $count = 1;
        while ($row = mysqli_fetch_assoc($query)) {

          echo '
 
          <tr id="' . $row['topic_id'] . '">
          <th scope="row">' . $count . '</th>
            <td style="text-transform: uppercase;" data-target="topic_name">' . htmlspecialchars($row['topic_name']) . '</td>
            <td><a  data-role="update" data-id="' . htmlspecialchars($row['topic_id']) . '" role="button"  aria-pressed="true"><i class="fas fa-2x fa-pen-square"
            style="color: green; cursor:pointer; text-decoration:none"></i></a>
            <a href="#" class="delete-btn" role="button" data-id="' . $row['topic_id'] . '" aria-pressed="true"><i class="fas fa-2x fa-trash" style="color: red; cursor:pointer;"></i></a></td>
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
            <label>UNIT</label>
            <input class="form-control" id="topic_name" type="text" placeholder="Default input">
          </div>
       
        
          <input type="hidden" id="topicId" class="form-control">
        </div>
        <div class="modal-footer">
          <a type="submit" id="save" class="btn btn-primary" data-dismiss="modal">Update</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

 
<?php include 'footer.php'; ?>
</div>
</body>



<!--sweetalert-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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



<script>
  //append value in input field
  $(document).ready(function() {
    $(document).on('click', 'a[data-role=update]', function() {
      var id = $(this).data('id');
      var topic_name = $('#' + id).children('td[data-target=topic_name]').text();

     
      $('#topic_name').val(topic_name);
      $('#topicId').val(id);
      $('#update').modal('toggle');


    });

    //update in database

    $('#save').click(function() {
      var id = $('#topicId').val();
      var topic_name = $('#topic_name').val();
 

      $.ajax({

        url: 'unit_update.php',
        method: 'POST',
        data: {
          topic_name: topic_name,    
          id: id
        },
        success: function(response) {
         
          if (response == 1) {

          Swal.fire({
              icon: 'success',
              title: 'Unit updated successfully',
              timer: 1500
            });
       //update table UI
          $('#' + id).children('td[data-target=topic_name]').text(topic_name);
          }
          if(response == 2){
            Swal.fire({
              icon: 'warning',
              title: 'Unit Already Exist',
              timer: 1500
            });
          }

          
          if(response == 0){
            Swal.fire({
              icon: 'error',
              title: 'Unit Not updated',
              timer: 1500
            });
          }
         
        }

      });
    });


    //delete record

    $(document).on('click', '.delete-btn', function() {
  


        var topicId = $(this).data('id');
        var element = this;
        $.ajax({
          url: 'unit_delete.php',
          type: 'POST',
          data: {
            id: topicId
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