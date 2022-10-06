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
    <title>STUDENT VERIFICATION</title>

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
            <h3 class="text-center">STUDENT MARKS</h3>
            <h6 style="text-transform: uppercase; color:darkslategray" class="text-center">[<?php echo $_GET['subject_name'];?>]</h6>

            <table id="msg" class="data my-3 table-bordered table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">PRN</th>
                        <th scope="col">YEAR</th>
                        <th scope="col">SUBJECT</th>
                        <th scope="col">OBTAINED MARKS</th>
                        <th scope="col">TOTAL MARKS</th>

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
                        $each_marks_sql="SELECT * FROM `marks_question` WHERE subject_id=$subject_id";
                        $each_marks_result=mysqli_query($conn,$each_marks_sql);
                        $each_mark_row=mysqli_fetch_assoc($each_marks_result);
                        $each_mark=$each_mark_row['each_marks'];
                        $totalmarks=$each_mark_row['total_marks'];

                        
                        
                        
                        $ans = "SELECT * FROM `answer_student_mapping` WHERE subject_id=$subject_id AND student_id=$prn";
                        $ans_result=mysqli_query($conn,$ans);
                        while($ans_row=mysqli_fetch_assoc($ans_result)){

                            $question_id=$ans_row['question_id'];
                            $student_answer=$ans_row['answer'];

                            $question="SELECT * FROM `question_list` WHERE question_id=$question_id AND subject_id=$subject_id";
                            $question_result=mysqli_query($conn,$question);
                            $question_row=mysqli_fetch_assoc($question_result);
                            $correct_answer=$question_row['correct_option'];

                                if ($student_answer == $correct_answer) {
                                    $marks_update = "UPDATE `answer_student_mapping` SET `marks`='$each_mark' WHERE subject_id=$subject_id AND question_id=$question_id AND student_id=$prn";
                                    $marks_result = mysqli_query($conn, $marks_update);
                                    // echo $student_id." ".$subject_id." ".$question_id." ".$student_answer." ".$correct_answer." correct <br>";
                                } else {
                                    $marks_update = "UPDATE `answer_student_mapping` SET `marks`='0' WHERE subject_id=$subject_id AND question_id=$question_id AND student_id=$prn";
                                    $marks_result = mysqli_query($conn, $marks_update);
                                    // echo $student_id." ".$subject_id." ".$question_id." ".$student_answer." ".$correct_answer." wrong <br>";
                                }
                            
                            
                                
                        }       
                        
                        $sql1="SELECT sum( marks ) FROM `answer_student_mapping` where student_id=$prn AND subject_id=$subject_id";

                    $result1=mysqli_query($conn,$sql1);
                    while($row=mysqli_fetch_assoc($result1)){
                        $obtainedmarks=$row['sum( marks )'];

                        if($obtainedmarks!=""){
                            echo '<th scope="row">' . $count . '</th>
                            <td>' . $prn . '</td>
                            <td>' . $year . '</td>
                            <td>' . $subject . '</td>
                            <td>'.$obtainedmarks.'</td>
                            <td>'.$totalmarks.'</td>
                            </tr>';   
                        }
                        else{
                            echo '<th scope="row">' . $count . '</th>
                            <td>' . $prn . '</td>
                            <td>' . $year . '</td>
                            <td>' . $subject . '</td>
                            <td>N/A</td>
                            <td>'.$totalmarks.'</td>
                            </tr>';   
                        }
                        
                    }
                        
                                               
                    
                            

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








    <!-- while ($row1 = mysqli_fetch_assoc($abc)) {

//         $subject_name = $row1['subject_name'];

//         $sub = "SELECT * FROM subject_register WHERE `subject_name`='$subject_name'";
//         $re = mysqli_query($conn, $sub);
//         $ro = mysqli_fetch_assoc($re);
//         $subject_id = $ro['subject_id'];
//         $prn_sql="SELECT * FROM subject_student_mapping WHERE subject_id=$subject_id";
//         $prn_result=mysqli_query($conn,$prn_sql);
        
//         while($prn_row=mysqli_fetch_assoc($prn_result)){
//         $ans = "SELECT * FROM `answer_student_mapping` WHERE subject_id=$subject_id";
//         $ans_result=mysqli_query($conn,$ans);
//         while($ans_row=mysqli_fetch_assoc($ans_result)){

//               $question_id=$ans_row['question_id'];
//               $student_answer=$ans_row['answer'];

//               $question="SELECT * FROM `question_list` WHERE question_id=$question_id";
//               $question_result=mysqli_query($conn,$question);
//               $question_row=mysqli_fetch_assoc($question_result);

//               $correct_answer=$question_row['correct_option'];

//               $each_marks_sql="SELECT * FROM `marks_question` WHERE subject_id=$subject_id";
//               $each_marks_result=mysqli_query($conn,$each_marks_sql);
//               $each_mark_row=mysqli_fetch_assoc($each_marks_result);
//               $each_mark=$each_mark_row['each_marks'];
//               $totalmarks=$each_mark_row['total_marks'];

//                 if($student_answer==$correct_answer){
//                     $marks_insert="UPDATE `answer_student_mapping` SET `marks`='$each_mark' WHERE question_id=$question_id AND subject_id=$subject_id";
//                     $marks_result=mysqli_query($conn,$marks_insert);
//                 }
//                 else{
//                     $marks_insert="UPDATE `answer_student_mapping` SET `marks`='0' WHERE question_id=$question_id AND subject_id=$subject_id";
//                     $marks_result=mysqli_query($conn,$marks_insert);
//                 }
                    
                    
//         }

//                 $ans = "SELECT * FROM `answer_student_mapping` WHERE subject_id=$subject_id";
//                 $ans_result=mysqli_query($conn,$ans);

//                 while($ans_row=mysqli_fetch_assoc($ans_result)){

                    
//                         $student_id=$prn_row['student_id'];
//                         $sql="SELECT sum( marks ) FROM `answer_student_mapping` where student_id=$student_id AND subject_id=$subject_id";

//                         $result=mysqli_query($conn,$sql);
//                         $row=mysqli_fetch_assoc($result);
//                         $obtainedmarks=$row['sum( marks )'];


//                         // echo '<th scope="row">' . $count . '</th>
//                         //     <td>' . $student_id . '</td>
//                         //     <td>' . $subject_name . '</td>
//                         //     <td>' . $obtainedmarks . '</td>
//                         //     <td>' . $totalmarks . '</td>

//                         //     </tr>';

                        
//                     }
//                 }
//                 $count++;

//     } -->


<!-- 22222222222 -->

<!-- $examiner_code = $_SESSION['code'];
                    $count = 1;

                    $query = "SELECT DISTINCT subject_id,subject_name FROM subject_examiner_mapping WHERE `examiner_role`='Paper Setter' AND `examiner_code`='$examiner_code'";
                    $abc = mysqli_query($conn, $query);
                    while ($subject_row = mysqli_fetch_assoc($abc)) {
                        $subject_id = $subject_row['subject_id'];
                        $subject_name = $subject_row['subject_name'];
                        // echo $subject_id;
                        // echo $subject_name;
                        $year = "SELECT * FROM subject_register WHERE `subject_id`='$subject_id'";
                        $year_result = mysqli_query($conn, $year);
                        $year_row = mysqli_fetch_assoc($year_result);

                        $year = $year_row['year'];

                        $prn_sql = "SELECT * FROM subject_student_mapping WHERE `subject_id`='$subject_id'";
                        $prn_result = mysqli_query($conn, $prn_sql);
                        $prn_row = mysqli_fetch_assoc($prn_result);
                            $student_id = $prn_row['student_id'];
                            $ans = "SELECT * FROM `answer_student_mapping` WHERE `subject_id`='$subject_id' AND `student_id`='$student_id'";
                            $ans_result = mysqli_query($conn, $ans);
                            $ans_row = mysqli_fetch_assoc($ans_result);
                            $question_id = $ans_row['question_id'];
                            $student_answer = htmlspecialchars($ans_row['answer']);

                            $question = "SELECT * FROM `question_list` WHERE `question_id`='$question_id' AND `subject_id`='$subject_id'";
                            $question_result = mysqli_query($conn, $question);
                            $question_row = mysqli_fetch_assoc($question_result);

                            $correct_answer = htmlspecialchars($question_row['correct_option']);

                            $each_marks_sql = "SELECT * FROM `marks_question` WHERE subject_id=$subject_id";

                            $each_marks_result = mysqli_query($conn, $each_marks_sql);
                            while($each_mark_row = mysqli_fetch_assoc($each_marks_result)){
                            $each_mark = $each_mark_row['each_marks'];
                            $totalmarks = $each_mark_row['total_marks'];

                            if ($student_answer == $correct_answer) {
                                $marks_update = "UPDATE `answer_student_mapping` SET `marks`='$each_mark' WHERE subject_id=$subject_id AND question_id=$question_id AND student_id=$student_id";
                                $marks_result = mysqli_query($conn, $marks_update);
                                // echo $student_id." ".$subject_id." ".$question_id." ".$student_answer." ".$correct_answer." correct <br>";
                            } else {
                                $marks_update = "UPDATE `answer_student_mapping` SET `marks`='0' WHERE subject_id=$subject_id AND question_id=$question_id AND student_id=$student_id";
                                $marks_result = mysqli_query($conn, $marks_update);
                                // echo $student_id." ".$subject_id." ".$question_id." ".$student_answer." ".$correct_answer." wrong <br>";
                            }
                        
                        }

                        $sql = "SELECT sum( marks ) FROM `answer_student_mapping` where `student_id`='$student_id' AND `subject_id`='$subject_id'";

                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $obtainedmarks = $row['sum( marks )'];

                        if ($obtainedmarks == "") {
                            echo '<th scope="row">' . $count . '</th>
                            <td>' . $student_id . '</td>
                            <td>' . $year . '</td>
                            <td>' . $subject_name . '</td>
                            <td>N/A</td>
                            <td>' . $totalmarks . '</td>

                            </tr>';
                        } else {
                            echo '<th scope="row">' . $count . '</th>
                            <td>' . $student_id . '</td>
                            <td>' . $year . '</td>
                            <td>' . $subject_name . '</td>
                            <td>' . $obtainedmarks . '</td>
                            <td>' . $totalmarks . '</td>

                            </tr>';
                        }


                        $count++;
                    } -->