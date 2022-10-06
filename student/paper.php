<?php
include '../partials/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXAM PAPER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- bootstrap 4 required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: lightslategray;
        }

        .container {
            background-color: white;
            padding-top: 20px;
            padding-left: 40px;
            padding-right: 40px;
            padding-bottom: 20px;

        }
    </style>
</head>

<body>
    <div class="data container my-5" id="container">
        <span style="float: right;">PDF</span><i style="float : right; color: #B22222; cursor:pointer;" onclick="printPage()" class="fas fa-2x fa-file-pdf"></i>
        <h4 class="text-center">QUESTION PAPER</h4>

        <?php
        $prn = $_GET['prn'];
        $subject_id = $_GET['subject'];


        //subject name
        $sub = mysqli_query($conn, "SELECT * FROM subject_register WHERE `subject_id`='$subject_id'");
        $r = mysqli_fetch_assoc($sub);
        $subject_name = $r['subject_name'];

        //time
        $time = mysqli_query($conn, "SELECT * FROM examination_schedule WHERE `subject_id`='$subject_id'");
        $tr = mysqli_fetch_assoc($time);
        $date = date_create($tr['exam_date']);

        //marks

        $marks = mysqli_query($conn, "SELECT * FROM marks_question WHERE `subject_id`='$subject_id'");
        $mk = mysqli_fetch_assoc($marks);
        $total_marks = $mk['total_marks'];

        echo '<div class="row"><h6 >PRN : ' . $prn . '</h6></div>';
        echo '<div class="row"><h6>Subject : ' . $subject_name . '</h6></div>';
        echo '<div class="row"><h6>Date : ' . date_format($date, "d/m/Y") . '</h6></div>';
        echo '<div class="row"><h6>Total Marks : ' . $total_marks . '</h6></div>';
        echo '<div class="row"><h6>EACH QUESTION MARKS : ' . $mk['each_marks'] . '</h6></div>';
        echo'<hr>';

        $count = 1;
        $sql = mysqli_query($conn, "SELECT * FROM answer_student_mapping WHERE `student_id`='$prn' AND `subject_id`='$subject_id'");
        while ($result = mysqli_fetch_assoc($sql)) {
            $question = $result['question_id'];
            $question_data = mysqli_query($conn, "SELECT * FROM question_list WHERE `question_id`='$question'");
            $row = mysqli_fetch_assoc($question_data);
            $type=$row['image/text'];
            echo '
            <div class="row my-3">';
            if($type == 'text'){
                echo' <h6 class="form-control">Q.' . $count . '' . htmlspecialchars($row['question_description']) . '</h6><br> ';
            }else{
                echo'Q.' . $count . '<img class="form-control" style="width: 400px;" src="' . $row['question_description'] . '" /><br>';
            }
                   

                echo' <ul>
                  <li><h6 style="font-size:13px;">' . htmlspecialchars($row['option_1']) . '</h6></li>
                  <li><h6 style="font-size:13px;">' . htmlspecialchars($row['option_2']) . '</h6></li>
                  <li><h6 style="font-size:13px;">' . htmlspecialchars($row['option_3']) . '</h6></li>
                   <li><h6 style="font-size:13px;">' . htmlspecialchars($row['option_4']) . '</h6></li>
                 </ul>

            </div>';
            $count++;
        }

        ?>


    </div>
</body>
<script>
    function printPage() {
        let container = document.getElementById('container');
        window.print();
    }
</script>

</html>