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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script type="text/javascript" src="1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT ANSWERSHEET</title>

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
            <h3 class="text-center">STUDENT ANSWERS</h3>
            <h6 style="text-transform: uppercase; color:darkslategray" class="text-center">[<?php echo $_GET['subject_name'];?>]</h6>
            <table id="msg" class="data my-3 table-bordered table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">PRN</th>
                        <th scope="col">YEAR</th>
                        <th scope="col">SUBJECT</th>
                        <th scope="col">QUESTION</th>
                        <th scope="col">ANSWER BY STUDENT</th>
                        <th scope="col">CORRECT ANSWER</th>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    $subject=$_GET['subject_name'];

                    $subject_id_sql="SELECT * FROM `subject_register` WHERE subject_name='$subject'";
                    $subject_id_result=mysqli_query($conn,$subject_id_sql);
                    $subject_row=mysqli_fetch_assoc($subject_id_result);

                    $subject_id=$subject_row['subject_id'];
                    $year=$subject_row['year'];
                    $count=1;

                   
                    $sql = mysqli_query($conn, "SELECT student_id FROM subject_student_mapping  WHERE `subject_id`='$subject_id'");
                    while($prn_row=mysqli_fetch_assoc($sql)){
                        $prn=$prn_row['student_id'];
                        // echo $prn."<br>";
                        // echo $subject_id."<br>";
                        // echo $year."<br>";


                        
                        
                        
                        $ans = "SELECT * FROM `answer_student_mapping` WHERE subject_id=$subject_id AND student_id=$prn";
                        $ans_result=mysqli_query($conn,$ans);
                        while($ans_row=mysqli_fetch_assoc($ans_result)){

                            $question_id=$ans_row['question_id'];
                            $student_answer=$ans_row['answer'];

                            $question="SELECT * FROM `question_list` WHERE question_id=$question_id AND subject_id=$subject_id";
                            $question_result=mysqli_query($conn,$question);
                            $question_row=mysqli_fetch_assoc($question_result);
                            $type=$question_row['image/text'];
                            $question=$question_row['question_description'];
                            $correct_answer=$question_row['correct_option'];

                                
                            if($type=='text'){
                                echo '<th scope="row">' . $count . '</th>
                                <td>' . $prn . '</td>
                                <td>' . $year . '</td>
                                <td>' . $subject . '</td>
                                <td><label style="font-size: 12px; ">' . htmlspecialchars($question). '</td>
                                <td><label style="font-size: 12px; ">'.htmlspecialchars($student_answer).'</td>
                                <td><label style="font-size: 12px; ">'.htmlspecialchars($correct_answer).'</td>
                                </tr>';   
                            }
                            else{
                                echo '<th scope="row">' . $count . '</th>
                                <td>' . $prn . '</td>
                                <td>' . $year . '</td>
                                <td>' . $subject . '</td>
                                <td><img style="width: 150px;" src="' . htmlspecialchars($question) . '"></td>
                                <td><label style="font-size: 12px; ">'.htmlspecialchars($student_answer).'</td>
                                <td><label style="font-size: 12px; ">'.htmlspecialchars($correct_answer).'</td>
                                </tr>';
                            }
                       
                            $count++;

                                
                        }                                                  
                    }
                    
                    
                    ?>

                </tbody>
            </table>

        </div>
        <?php
        include 'footer.php';
        ?>
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
