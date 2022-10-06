<?php
include '../partials/connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/sidebar.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- bootstrap 4 required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>DASHBOARD</title>
    <style>
        .container {
            box-sizing: border-box;
            min-height: 449px;

        }

        .card-body {

            color: black;
            box-sizing: border-box;
            font-size: 18px;
            cursor: pointer;
            height: 30%;
            width: auto;
        }

        .container a:link {
            text-decoration: none;

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


            <div class="card" style="background-color:lightgray; background-color:#9CC3D5FF;">
                <div class="card-body">
                    <div class="row justify-content-center no-gutters align-items-center">
                        <div>
                            <div class="font-weight-bold text-uppercase">
                                <center>
                                    <ul style="padding:0; overflow:hidden;">
                                        <li class="c" style="font-size:12px; color:slategray">FACULTY OF SCIENCE</li>

                                    </ul>
                                </center>

                            </div>

                        </div>

                    </div>


                    <div class="row  no-gutters align-items-center">






                        <!--total department-->
                        <div class="col-md-4">
                            <?php
                            $faculty = $_SESSION['faculty'];

                            $q = "SELECT * FROM department WHERE `faculty_id`='$faculty'";
                            $re0 = mysqli_query($conn, $q);
                            $count0 = mysqli_num_rows($re0);

                            ?>
                            <center><b class="" style="font-size: 50px;"><?php echo $count0; ?><i class="far  fa-building"></i></b>
                                <h6> TOTAL DEPARTMENT : </h6>

                            </center>




                        </div>

                        <!--total students-->
                        <div class="col-md-4">
                            <?php
                            $faculty = $_SESSION['faculty'];

                            $q1 = "SELECT * FROM user_register WHERE `role`='student' AND `faculty_id`='$faculty'";
                            $re1 = mysqli_query($conn, $q1);
                            $count1 = mysqli_num_rows($re1);

                            ?>

                            <center><b class=""  style="font-size: 50px;"><?php echo $count1; ?> <i class="fas fa-users"></i></b>
                                <h6> TOTAL STUDENTS : </h6>
                        </div>

                        <div class="col-md-4">
                            <canvas id="canvas" width="200" height="200">
                            </canvas>
                        </div>
                    </div>


                </div>

            </div>
        </div>


    </div>

    <?php
    include 'footer.php';
    ?>
    </div>


</body>

</html>

<script>
    var canvas = document.getElementById("canvas");
    var ctx = canvas.getContext("2d");
    var radius = canvas.height / 2;
    ctx.translate(radius, radius);
    radius = radius * 0.90
    setInterval(drawClock, 1000);

    function drawClock() {
        drawFace(ctx, radius);
        drawNumbers(ctx, radius);
        drawTime(ctx, radius);
    }

    function drawFace(ctx, radius) {
        var grad;
        ctx.beginPath();
        ctx.arc(0, 0, radius, 0, 2 * Math.PI);
        ctx.fillStyle = 'white';
        ctx.fill();
        grad = ctx.createRadialGradient(0, 0, radius * 0.95, 0, 0, radius * 1.05);
        grad.addColorStop(0, '#3333');
        grad.addColorStop(0.5, 'white');
        grad.addColorStop(1, '#3333');
        ctx.strokeStyle = grad;
        ctx.lineWidth = radius * 0.1;
        ctx.stroke();
        ctx.beginPath();
        ctx.arc(0, 0, radius * 0.1, 0, 2 * Math.PI);
        ctx.fillStyle = '#333';
        ctx.fill();
    }

    function drawNumbers(ctx, radius) {
        var ang;
        var num;
        ctx.font = radius * 0.15 + "px arial";
        ctx.textBaseline = "middle";
        ctx.textAlign = "center";
        for (num = 1; num < 13; num++) {
            ang = num * Math.PI / 6;
            ctx.rotate(ang);
            ctx.translate(0, -radius * 0.85);
            ctx.rotate(-ang);
            ctx.fillText(num.toString(), 0, 0);
            ctx.rotate(ang);
            ctx.translate(0, radius * 0.85);
            ctx.rotate(-ang);
        }
    }

    function drawTime(ctx, radius) {
        var now = new Date();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();
        //hour
        hour = hour % 12;
        hour = (hour * Math.PI / 6) +
            (minute * Math.PI / (6 * 60)) +
            (second * Math.PI / (360 * 60));
        drawHand(ctx, hour, radius * 0.5, radius * 0.07);
        //minute
        minute = (minute * Math.PI / 30) + (second * Math.PI / (30 * 60));
        drawHand(ctx, minute, radius * 0.8, radius * 0.07);
        // second
        second = (second * Math.PI / 30);
        drawHand(ctx, second, radius * 0.9, radius * 0.02);
    }

    function drawHand(ctx, pos, length, width) {
        ctx.beginPath();
        ctx.lineWidth = width;
        ctx.lineCap = "round";
        ctx.moveTo(0, 0);
        ctx.rotate(pos);
        ctx.lineTo(0, -length);
        ctx.stroke();
        ctx.rotate(-pos);
    }
</script>