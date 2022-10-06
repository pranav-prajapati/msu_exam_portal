<?php
include '../partials/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANSWERSHEET DASHBOARD</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <!-- bootstrap 4 required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <style>
        .container {
            box-sizing: border-box;

            min-height: 448px;


        }

        /* .card-body {

            color: black;
            box-sizing: border-box;
            font-size: 18px;
            cursor: pointer;
            height: 30%;
            width: auto;
        } */

        td {
            text-transform: uppercase;
        }

        thead {
            color: #263847;
            font-size: 13px;

        }

        .container a:link {
            text-decoration: none;

        }
    </style>
</head>

<body>


    <!--sidebar start-->



    <?php include 'teacher_header.php'; ?>
    <!--sidebar end-->
    <div class="content-container">
    <?php include 'top_navbar.php'; ?>
        <div class="container my-5 ">
            <h2 class="text-center" style="text-transform:uppercase;"> ANSWERSHEET </h2>

            <table class="data my-3 table-bordered table table-hover text-center">
                <thead>
                    <tr>
                        <th> NO. </th>
                        <th> SUBJECT NAME </th>
                        <th> SUBJECT NAME </th>
                        <th> DATE </th>
                        <th> PRESENT IN EXAM / TOTAL STUDENTS </th>
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
                        $year = $ro['year'];

                        $date_sql=mysqli_query($conn,"SELECT * FROM examination_schedule WHERE `subject_id`='$subject_id'");
                        $dr=mysqli_fetch_assoc($date_sql);
                        $date=date_create($dr['exam_date']);

                        $s = "SELECT * FROM subject_topic_list WHERE `subject_id`='$subject_id'";
                        $result = mysqli_query($conn, $s);
                        $total = mysqli_num_rows($result);


                        $sql = mysqli_query($conn, "SELECT DISTINCT student_id FROM subject_student_mapping  WHERE `subject_id`='$subject_id'");
                        $s=mysqli_num_rows($sql);
                        //echo $s;
                        
                      
                       
                        $sql3 = mysqli_query($conn, "SELECT DISTINCT student_id FROM answer_student_mapping  WHERE `subject_id`='$subject_id'");
                        $res3=mysqli_num_rows($sql3);
                        //  echo $res3;







                        echo '
                                <tr>
                                        <th>' . $count . '</th>
                                        <td>' . htmlspecialchars($rowx['subject_name']) . '</td>
                                        <td>' . htmlspecialchars($ro['subject_code']) . '</td>
                                        <td>' . htmlspecialchars(date_format($date,'d/m/Y')) . '</td>
                                        <td style="font-weight:600; font-size:18px;">'.$res3.'/'.$s.'</td>
                                        <td><a href="answersheet.php?subject_name=' . htmlspecialchars($rowx['subject_name']) . '"> <i class="far fa-2x fa-eye"></i></a></td>
                                </tr>';


                        $count++;
                    }

                    ?>


                </tbody>
            </table>
        </div>


        <?php include 'footer.php'  ?>
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