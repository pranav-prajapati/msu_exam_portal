<?php include '../partials/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXAM REPORT DASHBOARD</title>

    <link rel="stylesheet" href="../css/sidebar.css">
    <!-- <link rel="stylesheet" href="../css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script type="text/javascript" src="1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

    <style>
        /* status and edit link properties */
        .container {
            min-height: 433px;

        }

        .container thead {
            color: #263847;
            font-size: 13px;

        }
        tbody{
            text-transform: uppercase;
        }
    </style>
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
                        <th> SUBJECT NAME </th>
                        <th> SUBJECT CODE </th>
                        <th> DATE </th>


                        <th> ACTION </th>
                    </tr>
                </thead>
                <tbody>


                    <?php
                    $examiner_code = $_SESSION['code'];

                    $query = "SELECT * FROM subject_examiner_mapping WHERE `examiner_role`='Paper Setter' AND examiner_code='$examiner_code'";
                    $abc = mysqli_query($conn, $query);
                    $count = 1;
                    while ($rowx = mysqli_fetch_assoc($abc)) {
                        $subject_name = $rowx['subject_name'];

                        $sub = "SELECT * FROM subject_register WHERE `subject_name`='$subject_name'";
                        $re = mysqli_query($conn, $sub);
                        $ro = mysqli_fetch_assoc($re);
                        $subject_id = $ro['subject_id'];

                        $date_sql=mysqli_query($conn,"SELECT * FROM examination_schedule WHERE `subject_id`='$subject_id'");
                        $dr=mysqli_fetch_assoc($date_sql);
                        $date=date_create($dr['exam_date']);



                        echo '
                        <tr>
                                <th>' . $count . '</th>
                                <td>' . htmlspecialchars($rowx['subject_name']) . '</td>
                                <td>' . htmlspecialchars($ro['subject_code']) . '</td>
                                <td>' . htmlspecialchars(date_format($date,'d/m/Y')) . '</td>
                                <td><a href="exam_time_report.php?subject_id=' . htmlspecialchars($subject_id) . '"> <i class="far fa-2x fa-eye"></i></a></td>
                        </tr>';


                        $count++;
                    }



                    ?>

                </tbody>
            </table>

        </div>
        
    
    <?php include 'footer.php'; ?>
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