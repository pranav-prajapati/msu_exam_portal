<?php
include '../partials/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENTS-SUBJECTS</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- bootstrap 4 required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
    

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
    include 's_admin_header.php';
    ?>
    <div class="content-container">
        <?php
        include 'top_navbar.php';
        ?>


        <div class="container my-5">
            <!-- Table of student verification  -->
            <h3 class="text-center">STUDENT-SUBJECT-DETAILS</h3>
        
      
            <table id="export" class="data my-3 table-bordered table table-hover text-center">
                <thead>

                    <th>PRN</th>
                    <th>STUDENT NAME</th>
                    <th>SUBJECTS</th>
                    <th>DEPARTMENT</th>

                </thead>

                <tbody>

                    <?php
                    $faculty = $_SESSION['faculty'];
                    $student = mysqli_query($conn, "SELECT * FROM user_register WHERE `role`='student' AND `faculty_id`='$faculty' ORDER BY department_id ");
                    while ($row = mysqli_fetch_assoc($student)) {
                        $department_id = $row['department_id'];
                        $username = $row['username'];



                        $department = mysqli_query($conn, "SELECT * FROM department WHERE `department_id`='$department_id'");
                        $row3 = mysqli_fetch_assoc($department);
                    ?>
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['name']; ?> </td>
                            <td>

                                <ul style=" text-align: left; font-size:12px;">
                                    <?php

                                    $subject = mysqli_query($conn, "SELECT * FROM subject_student_mapping WHERE `student_id`='$username'");

                                    while ($row1 = mysqli_fetch_assoc($subject)) {
                                        $sub = $row1['subject_id'];

                                        $subj = mysqli_query($conn, "SELECT * FROM subject_register WHERE `subject_id`='$sub'");
                                        $row2 = mysqli_fetch_assoc($subj);
                                        echo '
                                           
                                           <li> ' . $row2['subject_name'] . ' </li>
                                         ';
                                    }
                                    ?>
                                </ul>
                            </td>
                            <td><?php echo $row3['department_name'] ?></td>
                        </tr>
                    <?php
                    }


                    ?>

                </tbody>

            </table>
        </div>
        <?php include 'footer.php'; ?>
    </div>
</body>

</html>



<!--datatable-->
<!-- <script type="text/javascript" src="../DataTables/datatables.min.js"></script>
<script type="text/javascript" src="../DataTables/dataTables.bootstrap4.min.js"></script> -->


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
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">


