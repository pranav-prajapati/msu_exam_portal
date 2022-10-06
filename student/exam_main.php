<?php
include '../partials/connection.php';

error_reporting(0);
session_start();
$exam_main = $_SESSION['exam_main'];


if ($exam_main != true) {
    echo '<script> location.replace("/msu_exam_portal/index.php"); </script>';
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap 4 required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="../css/exam_main.css">




    <title>START EXAM</title>
    <style>

    </style>

</head>

<body>
    <?php include 'student_header.php'; ?>
    <div id="result">

    </div>



    <div class="container-fluid  my-3">

        <div class="row">

            <div class="col-md-8" id="child">
                <div class="onehead">


                    <?php
                    $prn = $_SESSION['uname'];
                    $subject_id = $_SESSION['subject'];




                    //query to know where answer is blank
                    $sql = "SELECT * FROM `answer_student_mapping` WHERE answer IS NULL AND subject_id=$subject_id AND student_id=$prn";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    $num = mysqli_num_rows($result);

                    if ($num == 0) {

                        $logouttime = "UPDATE `student_images` SET `logout_time` = NOW() WHERE `student_images`.`prn` = $prn AND `student_images`.`subject_id`=$subject_id";
                        $updatelogouttime = mysqli_query($conn, $logouttime);

                        if ($logouttime) {
                            $_SESSION['examover'] = true;
                        }
                        echo '<script> location.replace("/msu_exam_portal/student/exam_over.php"); </script>';
                    }

                    //total questions
                    $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `answer_student_mapping` WHERE subject_id=$subject_id AND student_id=$prn"));



                    //current question number
                    $current = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `answer_student_mapping` WHERE answer IS NOT NULL AND subject_id=$subject_id AND student_id=$prn")) + 1;



                    //query to fetch question
                    $questionid = $row['question_id'];
                    $descsql = "SELECT * FROM `question_list` WHERE question_id=$questionid";
                    $descresult = mysqli_query($conn, $descsql);

                    $row2 = mysqli_fetch_assoc($descresult);

                    $description = htmlspecialchars($row2['question_description']);
                    $option1 = htmlspecialchars($row2['option_1']);
                    $option2 = htmlspecialchars($row2['option_2']);
                    $option3 = htmlspecialchars($row2['option_3']);
                    $option4 = htmlspecialchars($row2['option_4']);

                    $count = 1;


                    echo '<label>Question: ' . $current . '/' . $total . '(' . $_SESSION['uname'] . ')</label>
                            <hr>
                            </div>
                            
                            
                            <form action="answer_insert.php" method="POST">';

                    if ($row2['image/text'] == 'image') {
                        echo '' . $current . ')<img src="' . $description . ' " class="img-fluid qimg">';
                    } else {
                        echo '<h6> ' . $current . ')' . $description . ' </h6>';
                    }



                    echo '<br>

                                <!-- OPTIONS  -->
                                <div class="option">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="options" id="exampleRadios2" value="' . $option1 . '" required>
                                    <label class="form-check-label" for="exampleRadios2">
                                    ' . $option1 . ' 
                                    </label>
                                </div>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="options" id="exampleRadios2" value="' . $option2 . '" required>
                                    <label class="form-check-label" for="exampleRadios2">
                                    ' . $option2 . ' 
                                    </label>
                                </div>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="options" id="exampleRadios2" value="' . $option3 . '" required>
                                    <label class="form-check-label" for="exampleRadios2">
                                    ' . $option3 . ' 
                                    </label>
                                </div>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="options" id="exampleRadios2" value="' . $option4 . '" required>
                                    <label class="form-check-label" for="exampleRadios2">
                                    ' . $option4 . ' 
                                    </label>
                                </div>
                                </div>
                                <br>


                                <input type="hidden" name="question_id" value="' . $questionid . '">
                                <input type="hidden" name="count" id="count" value="' . $count . '">

                                <!--SUBMIT BUTTON-->
                                <input type="submit" class="btn btn-primary" id="submit" disabled>
                            </form>';



                    ?>

                </div>
                <div class="col-md-4">

                    <div class="secondhead">
                        <center> <label>TIMER</label></center>
                        <hr>
                        <center><label>Current Time</label></center>

                        <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                        <input id="countdown" type="hidden" value="<?php echo $endTime; ?>" class="text-center my-3">


                        <?php
                        $startTime = $_SESSION['starttime'];
                        $duration = $_SESSION['exam_duration'];
                        $time = strtotime($startTime);
                        $endTime = date("h:i a", strtotime('+' . $duration . ' minutes', $time));

                        ?>

                        <br>
                        <br>
                        <center><label>End Time</label></center>
                        <h6  class="text-center"><?php echo $endTime; ?></h6>
                        
                    </div>

                </div>
            </div>

        </div>
        <?php include 'footer.php'; ?>
</body>

<script>
    //script to enable submit button 
    let submit = document.getElementById('submit')

    let radio = document.getElementsByName('options')

    radio.forEach(element => {
        element.addEventListener('click', function() {
            submit.removeAttribute('disabled')
        })
    });

  //  script to disable right click and keyboardkeys

    document.onkeydown = function(e) {
        return false;
    }

    $(document).on("contextmenu", function (e) {
        alert('Right Click Not Allowed')
        e.preventDefault();
    });
    
</script>

<script>
    function showTime() {
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59
        var session = "AM";

        if (h == 0) {
            h = 12;
        }

        if (h > 12) {
            h = h - 12;
            session = "PM";
        }

        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s + " " + session;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;

        setTimeout(showTime, 1000);

    }

    showTime();
</script>









<!-- script to logout when time is over -->

<script>
    setInterval(function() {
        logout()
    }, 1000)



    function logout() {
        jQuery.ajax({
            url: 'auto_logout_handler.php',
            type: 'post',
            data: 'logout',
            success: function(result) {
                //    console.log(result)
                if (result == 'logout') {
                    window.location.assign('exam_over.php')
                    sessionStorage.clear();

                }
            }
        })
    }
</script>




<!-- script to logout when user moves mouse pointer 5 times out of the frame -->

<script>
function clickCounter() {
    if (typeof(Storage) !== "undefined") {
        if (sessionStorage.outofframe) {
            sessionStorage.outofframe = Number(sessionStorage.outofframe) + 1;
        } else {
            sessionStorage.outofframe = 1;
        }
        let result = document.getElementById('result')

        result.innerHTML = `<div class="alert alert-danger" role="alert">
            You have moved mouse pointer outside the box <b> ${sessionStorage.outofframe} times </b> in this exam.
            </div>`;


        if (sessionStorage.outofframe == 5) {
            jQuery.ajax({
                url: 'mouseout_logout_handler.php',
                type: 'post',
                data: 'mouseout',
                success: function(result) {
                    //    console.log(result)
                    if (result == 'logout') {
                        window.location.assign('exam_over.php')
                        sessionStorage.clear();

                    }
                }
            })
        }
    }
}

document.getElementById('child').addEventListener('mouseleave', clickCounter)

//function to avoid back button in browser
function preventBack() {
        window.history.forward();
    }

    setTimeout("preventBack()", 0);

    window.onunload = function() {
        null
    };
</script> 

</html>