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



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <title>DASHBOARD</title>
    <style>
        .container {
            box-sizing: border-box;

            min-height: 458px;


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


    <!--sidebar start-->



    <?php include 'teacher_header.php'; ?>
    <!--sidebar end-->

    <div class="content-container">
    <?php include 'top_navbar.php'; ?>
        <div class="container my-3">


            <div class="my-3">

                <div class="card" style="background-color:lightgray; background-image: url('../image/t2.png');  -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;background-size: cover;">
                    <div class="card-body">
                        <div class="row justify-content-center no-gutters align-items-center">
                            <div>
                                <div class="font-weight-bold text-uppercase">
                                    <center>
                                        <ul style="padding:0; overflow:hidden;">
                                            <li class="c" style="font-size:12px; color:slategray">FACULTY OF SCIENCE</li>
                                            <li class="c" style="font-size:12px; padding-left:20px;color:slategray">DEPARTMENT OF COMPUTER APPLICATIONS</li>
                                        </ul>
                                    </center>

                                </div>

                            </div>

                        </div>


                        <div class="row  no-gutters align-items-center">


                            <!-- paper setter-->
                            <div class="my-5 col-md-4">
                                <div class=" text-center text-uppercase">
                                    <span style="font-size: 20px; " class="badge badge-primary">PAPER SETTER</span>
                                    <ul class="my-2">
                                        <?php
                                        $examiner_code = $_SESSION['code'];

                                        $query = "SELECT * FROM subject_examiner_mapping WHERE `examiner_role`='Paper Setter' AND examiner_code='$examiner_code'";
                                        $abc = mysqli_query($conn, $query);
                                        while ($rowx = mysqli_fetch_assoc($abc)) {
                                            $subject_id = $rowx['subject_id'];
                                            $s = mysqli_query($conn, "SELECT * FROM subject_register WHERE `subject_id`='$subject_id'");
                                            $row = mysqli_fetch_assoc($s);


                                            echo '  <a style="color: black;" href="create_question.php?subject_name=' . $rowx['subject_name'] . '"><li style="float:none"><h6 name="subject_id" value="' . $row['subject_code'] . '">' . $rowx['subject_name'] . ' [' . $row['subject_code'] . ']</h6></li></a>';
                                        }
                                        ?>
                                        <li style="font-size:12px; list-style-type:none">[ click on subject name to add questions ]</li>
                                    </ul>


                                </div>

                            </div>


                            <!--chair paper setter-->

                            <div class="mx-5 my-5" style="border-left:1px solid;">
                                <div class=" text-center text-uppercase">
                                    <span style="font-size: 20px;" class="badge badge-primary">CHAIR PAPER SETTER</span>
                                    <ul class="my-2">
                                        <?php
                                        $examiner_code = $_SESSION['code'];

                                        $query = "SELECT * FROM subject_examiner_mapping WHERE `examiner_role`='Chair Paper Setter' AND examiner_code='$examiner_code'";
                                        $abc = mysqli_query($conn, $query);
                                        while ($rowx = mysqli_fetch_assoc($abc)) {
                                            $subject_id = $rowx['subject_id'];
                                            $s = mysqli_query($conn, "SELECT * FROM subject_register WHERE `subject_id`='$subject_id'");
                                            $row = mysqli_fetch_assoc($s);
                                            echo '  <a style="color: black;" href="manage_questions_dashboard.php"><li style="float:none"><h6 name="subject_id" value="' . $row['subject_code'] . '">' . $rowx['subject_name'] . ' [' . $row['subject_code'] . ']</h6></li></a>';
                                        }
                                        ?>
                                        <li style="font-size:12px; list-style-type:none">[ click on subject name to check ]</li>
                                    </ul>


                                </div>

                            </div>


                        </div>

                    </div>
                </div>

            </div>


            <!-- <div class="row justify-content-center">


                <div class="col-xl-3  col-md-6 mb-4">
                    <a href="#">
                        <div class="card  py-3" style="background-color: #FFD700;">
                            <div class="card-body ">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-uppercase mb-1">
                                            MANAGE QUESTIONS</div>

                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-2x fa-tasks"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="create_question.php">
                        <div class="card  shadow  py-3" style="background-color:#A52A2A;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold  text-uppercase mb-1">
                                            ADD QUESTIONS</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-2x fa-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="unit_dashboard.php">
                        <div class="card  shadow  py-3" style="background-color:#87CEEB;">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-uppercase mb-1">ADD UNIT
                                        </div>
                                        <div class="row no-gutters align-items-center">


                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-2x fa-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div> -->
        </div>

        <?php include 'footer.php'  ?>
    </div>
</body>

</html>