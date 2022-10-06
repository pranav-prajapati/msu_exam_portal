<?php
session_start();
error_reporting(0);

$loggedin = $_SESSION['loggedin'];
$student = $_SESSION['student'];
$webcam=$_POST['webcam'];

if ($loggedin != true || $student != true || $webcam !=true) {
    echo '<script> location.replace("/msu_exam_portal/index.php"); </script>';
}


?>



<!DOCTYPE html>
<html>

<head>
    <title>CAPTURE DETAILS </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>


    <style>
        body {
            background-color: #F5F5F5;

        }

        .container {
            background-color: #F5F5F5;
            margin-top: 20px;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 100px;
        }



        .row {
            background-color: #F5F5F5;

        }

        .container span {
            font-size: 15px;
        }

        .container label {
            font-size: 12px;
            margin-top: 5px;
            color: gray;
        }

        @media screen and (max-width: 984px) {

            .col-sm-8 {
                margin-left: 50px;
            }

        }

      
    </style>

</head>

<body>
    <div class="container my-5">

        <center> <span class="label label-primary"><?php echo $_SESSION['uname'] ?></span>
            <span class="label label-primary"><?php echo ucwords($_SESSION['username']) ?></span>
        </center>
        <form method="POST" action="saveImage.php">
            <h3 class="text-center">YOUR PROFILE</h3>



            <div class="row">
                <center>
                    <!-- CAMERA1 HERE -->
                    <div class="col-sm-3 col-md-offset-1">
                        <div id="my_camera"></div>


                        <input type=button id="firstbutton" value="SNAPSHOT" class="btn btn-info" onClick="take_snapshot()">
                        <label class="label">[ CLICK HERE TO CAPTURE YOUR PROFILE ]</label>
                    </div>

                    <!-- Save Image Box1 -->
                    <div class="col-sm-8">
                        <div id="results" style="margin-top:15px; margin-left:50px; border: 1px solid gray; height: 250px; width: 250px; background-color:lightblue"></div>
                        <input type="hidden" name="image" class="image-tag" required>
                    </div>
                </center>
            </div>






            <input type="hidden" name="prn" value="<?php echo $_SESSION['uname'] ?>">
            <input type="hidden" name="name" value="<?php echo $_SESSION['username'] ?>">
            <input type="hidden" name="subject" value="<?php echo $_POST['subject'] ?>">

            <?php
            $_SESSION['subject'] = $_POST['subject'];
            $_SESSION['starttime'] = $_POST['starttime'];
            $_SESSION['exam_duration'] = $_POST['exam_duration'];
            ?>

            <div class="row" id="seconddiv" type="hidden" hidden>
                <h3 class="text-center">ID PROOF</h1>
                    <center>
                        <!-- CAMERA2 HERE -->
                        <div class="col-sm-3 col-md-offset-1">
                            <div id="my_camera2"></div>

                            <input type=button value="SNAPSHOT" class="btn btn-info"  onClick="take_snapshot2()">
                            <span class="label notice" style="font-size:12px; color: gray; margin-top:5px;">[ CLICK HERE TO CAPTURE YOUR ID PROOF ]</span>
                        </div>


                        <!-- BOX 2 HERE -->

                        <div class="col-sm-8">
                            <div id="results2" style="margin-top:15px; margin-left:50px; border: 1px solid gray; height: 250px; width: 250px; background-color:lightblue">
                            </div>
                            <input type="hidden" name="image2" id="secondbutton" class="image-tag2" required>
                        </div>
                    </center>

                    <br>




            </div>
            <br>
            <br>
            <center> <button class="btn btn-success" style="margin-top: 20px;" name="save">SAVE IMAGES</button>
            </center>











        </form>



    </div>



    <!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
        Webcam.set({
            width: 300,
            height: 300,
            border: 2,
            image_format: 'jpeg',
            jpeg_quality: 720
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img style="width:250px" src="' + data_uri + '"/>';
            });
        }
    </script>


    <!-- Camera 2 -->

    <script language="JavaScript">
        Webcam.set({
            width: 300,
            height: 300,
            border: 2,
            image_format: 'jpeg',
            jpeg_quality: 720
        });

        Webcam.attach('#my_camera2');

        function take_snapshot2() {
            Webcam.snap(function(data_uri) {
                $(".image-tag2").val(data_uri);
                document.getElementById('results2').innerHTML = '<img style="width:250px" src="' + data_uri + '"/>';
            });
        }
    </script>

    <script>
        let firstbutton = document.getElementById('firstbutton')
        let seconddiv = document.getElementById('seconddiv')

        firstbutton.addEventListener('click', function() {
            seconddiv.removeAttribute('hidden');
        })

        //function to avoid back button in browser
        function preventBack() {
            window.history.forward();
        }

        setTimeout("preventBack()", 0);

        window.onunload = function() {
            null
        };
    </script>



</body>

</html>