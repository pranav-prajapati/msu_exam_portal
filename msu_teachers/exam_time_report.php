<?php
include '../partials/connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXAM REPORT</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <!-- <link rel="stylesheet" href="../css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script type="text/javascript" src="1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

</head>

<body>

    <?php include 'teacher_header.php'; ?>
    <div class="content-container">
        <?php include 'top_navbar.php'; ?>
        <div class="container my-5 ">
        <table class="data my-3 table-bordered table table-hover text-center">
                <thead>
                    <tr>
                        <th> NO. </th>
                        <th> PRN </th>
                        <th> STUDENT NAME </th>
                        <th> SUBJECT </th>
                        <th> EXAM LOGIN  </th>
                        <th> EXAM LOGOUT </th>
                        
                    </tr>
                </thead>
                <tbody>
            <?php

            $subject_id = $_GET['subject_id'];



            $subject_name = mysqli_query($conn, "SELECT * FROM subject_register WHERE `subject_id`='$subject_id'");
            $result = mysqli_fetch_assoc($subject_name);
            $subName = $result['subject_name'];

            $count = 1;
            $report = mysqli_query($conn, "SELECT * FROM student_images WHERE `subject_id`='$subject_id' ");
            while ($row = mysqli_fetch_assoc($report)) {
                $login=date_create($row['login_time']);
                $logout=date_create($row['logout_time']);

                echo '
                        <tr>
                                <th>' . $count . '</th>
                                <td>' . htmlspecialchars($row['prn']) . '</td>
                                <td>' . htmlspecialchars($row['student_name']) . '</td>
                                <td>' . htmlspecialchars($subName) . '</td>
                                <td>' . date_format($login,'d/m/Y H:i:s a') . '</td>  
                                <td>' . date_format($logout,'d/m/Y H:i:s a') . '</td>      
                                
                        </tr>';


                $count++;
            }


            ?>
                </tbody>
        </table>

        </div>
        <?php include '../partials/connection.php'; ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>