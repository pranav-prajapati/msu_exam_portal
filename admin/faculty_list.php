<?php
include '../partials/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACULTY LIST</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

</head>

<body>
    <?php
    include 'admin_header.php';
    ?>
    <div class="content-container">
        <?php
        include 'top_navbar.php';
        ?>
        <div class="container">
            <h3 class="text-center my-4">FACULTY DETAILS</h3>
            <table class="data my-3 table-bordered table table-hover text-center">
                <thead>
                    <th>NO.</th>
                    <th>NAME</th>
                    <th>USERNAME</th>
                    <th>EMAIL-ID</th>
                    <th>ROLE</th>
                    <th>PHONE NO.</th>
                    <th>DELETE</th>

                </thead>
                <tbody>

                    <?php
                    $count = 1;
                    $department = $_SESSION['department'];
                    $faculty = $_SESSION['faculty'];
                    $sql1 = mysqli_query($conn, "SELECT * FROM user_register WHERE `role`='examiner' AND `department_id`='$department' AND `faculty_id`='$faculty'");
                    while($result1=mysqli_fetch_assoc($sql1)) {
                    

               echo'

                    <tr>
                        <td >'. $count .'</td>
                        <td style="text-transform:uppercase;">'. htmlspecialchars($result1['name']) .'</td>
                        <td style="text-transform:uppercase;">'. htmlspecialchars($result1['username']) .'</td>
                        <td>'. $result1['email_id'] .'</td>
                        <td style="text-transform:uppercase;">'.$result1['role'].'</td>
                        <td>'. $result1['contact_number'].'</td> 
                        <td><a href="#" class=" delete-btn  active" role="button" data-id="'. $result1['username'].'" aria-pressed="true"><i class="fas fa-2x fa-trash" style="color: red;"></i></a></td>

                    </tr>

               
                    ';
       
                        $count++;
                    }
            ?>
                </tbody>
            </table>
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

<script>

$(document).on('click', '.delete-btn', function() {



    var teacherid = $(this).data('id');
    var element = this;
    console.log(teacherid)
    $.ajax({
        url: 'teacher_delete.php',
        type: 'POST',
        data: {
            id : teacherid
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
</script>


<!--EXPORT CDNS-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>




<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script> 