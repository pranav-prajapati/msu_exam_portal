<?php
include '../partials/connection.php';

if(!isset($_GET['subject_name'])){
    echo '<script> location.replace("index.php") </script>';
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/sidebar.css">
    <!-- <link rel="stylesheet" href="../css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <script type="text/javascript" src="1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOCK LIST</title>

    <style>
    /* status and edit link properties */
    .container {
        min-height: 433px;

    }

    .container thead {
        color: #263847;
        font-size: 13px;

    }
    </style>

</head>

<body>

    <?php
    include 'teacher_header.php';
    ?>
    <div class="content-container">
    <?php include 'top_navbar.php'; ?>

        <div class="container my-5">

            <!-- Table of student verification  -->
            <h3 class="text-center">BLOCKED STUDENTS LIST</h3>

            <table id="msg" class="data my-3 table-bordered table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">PRN</th>
                        <th scope="col">YEAR</th>
                        <th scope="col">SUBJECT</th>
                        <th scope="col">DELETE</th>


                    </tr>
                </thead>
                <tbody>
                    <?php

                            $subject=$_GET['subject_name'];

                            $sql="SELECT * FROM `subject_register` WHERE subject_name='$subject'";
                            $result=mysqli_query($conn,$sql);
                            $row=mysqli_fetch_assoc($result);
                            $subject_id=$row['subject_id'];
                            $year=$row['year'];


                            $blocked_sql="SELECT * FROM `block_list` WHERE subject_id=$subject_id";
                            $blocked_result=mysqli_query($conn,$blocked_sql);
                            $count=1;
                            while($blocked_row=mysqli_fetch_assoc($blocked_result)){

                                $prn=$blocked_row['student_id'];
                                

                                echo '<th scope="row">' . $count . '</th>
                                <td>' . $prn . '</td>
                                <td>' . $year . '</td>
                                <td>' . htmlspecialchars($subject) . '</td>    
                                <td><a href="#" class=" delete-btn  active" role="button" data-id="'.$prn.'" aria-pressed="true"><i class="fas fa-2x fa-trash" style="color: red;"></i></a></td>                          
                                </tr>';   

                                $count++;
                            }

                    
                    
                    ?>

                </tbody>
            </table>

        </div>
        <?php
        include 'footer.php';
        ?>
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
<script>
    //script to delete blocked student
    $(document).on('click', '.delete-btn', function() {



        var studentid = $(this).data('id');
        var element = this;
        // console.log(teacherid)
        $.ajax({
            url: 'blocked_student_delete.php',
            type: 'POST',
            data: {
                id: studentid
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