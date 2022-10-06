<?php include '../partials/connection.php'; ?>

<html>

<head>
<link rel="stylesheet" href="../css/sidebar.css">
  <title>UNIT</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<style>
 .container {
            box-sizing: border-box;

            min-height: 448px;


        }
</style>
<script src="../js/sweetalert.js"></script>
</head>

<body>


<!--sidebar start-->

<?php include 'teacher_header.php'; ?>

<!--sidebar end-->
    
    
    
<div class="content-container">
<?php include 'top_navbar.php'; ?>
  <div class="container my-5">


  <?php
   

   if(isset($_GET['id'])) {
       $id = $_GET['id'];
   
   
   
       $sql1 = "SELECT * FROM subject_register WHERE subject_id=$id";
       $result1 = mysqli_query($conn, $sql1) or die("Query failed");
   
       if (mysqli_num_rows($result1)) {
   
           while ($row1 = mysqli_fetch_assoc($result1)) {
   ?>
    <div class="jumbotron">
    <h1 style="text-transform: uppercase;" name="id"><?php echo $row1 ['subject_name']; ?></h1>
      <hr class="my-4">
      <div class="form-group">
     
        <form method="post" name="add_unit" id="add_unit">
          <div class="table-responsive">
          <input type="hidden"  name="id" value="<?php echo $row1['subject_id']; ?>" />
            <table class="table table-bordered" id="dynamic_field">
              <tr>
                <td><input type="text" name="unit[]" placeholder="Enter Unit" class="form-control name_list" /></td>
                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
              </tr>
            </table>
            <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
          </div>
        </form>


      </div>

  

    </div>
    <?php
           }
          }
        }
?>
  </div>
  <?php include 'footer.php'; ?>
</div>
</body>
</html>
<!--sweetalert-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<script>
  $(document).ready(function() {
    var i = 1;
    $('#add').click(function() {
      i++;
      $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" name="unit[]" placeholder="Enter Unit" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
    });
    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
    });
    $('#submit').click(function() {
      $.ajax({
        url: "add_unit.php",
        method: "POST",
        data: $('#add_unit').serialize(),
        success: function(data) {
          $('#add_unit')[0].reset();
       if(data == 1){
          
       }
       if(data == 0){
         
        Swal.fire({
              icon: 'danger',
              title: 'Unit Already Exist',
              timer: 1500
            });
       }
       if(data == 2){
        Swal.fire({
              icon: 'warning',
              title: 'Unit Already Exist',
              timer: 1500
            });
       }
        }
      });
    });
  });
</script>
