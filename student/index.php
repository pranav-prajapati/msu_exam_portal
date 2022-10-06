<?php
include '../partials/connection.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
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
        .ab {
            background-color: #34495E;
            color: white;
        }


        .container {
            box-sizing: border-box;
            min-height: 449px;

        }

        thead {
            font-size: 13px;
            text-transform: uppercase;
            text-align: center;

        }

        tbody {
            text-transform: uppercase;
            text-align: center;
            font-size: 15px;
            font-weight: 600;
        }

        @media screen and (max-width: 768px) {
            .container {
                box-sizing: border-box;
                min-height: 442px;

            }

            thead {
                font-size: 13px;
                text-transform: uppercase;
                text-align: center;

            }

            tbody {
                text-transform: uppercase;
                text-align: center;
                font-size: 15px;
                font-weight: 600;
            }

            .btn {
                font-size: 10px;
            }

        }

        @media screen and (max-width: 548px) {

            .container {
                box-sizing: border-box;
                min-height: 439px;

            }

            thead {
                font-size: 13px;
                text-transform: uppercase;
                text-align: center;

            }

            tbody {
                text-transform: uppercase;
                text-align: center;
                font-size: 11px;
                font-weight: 600;
            }

            .btn {
                font-size: 10px;
            }

        }

        @media screen and (max-width: 375px) {

            .container {
                box-sizing: border-box;
                min-height: 435px;

            }

            thead {
                font-size: 13px;
                text-transform: uppercase;
                text-align: center;

            }

            tbody {
                text-transform: uppercase;
                text-align: center;
                font-size: 10px;
                font-weight: 600;
            }

            .btn {
                font-size: 8px;
            }

        }
    </style>
</head>

<body>
    <?php include 'student_header.php'; ?>


    <div class="jumbotron" style="padding-bottom: 5px; padding-top:5px;">

     <h4 class="my-2" style="margin-left: 10px; margin:0px;"><i class="fas fa-exclamation-triangle"></i> Disclaimer</h4> <label style="color: #B22222;">[ Please read the instructions carefully: ] </label>
        <ul>
            <li>The Keyboard is disabled.</li>
            <li>Be careful to keep the cursour inside the Browser Window.After 5 times of going out of the Question box, you will be logged out automatically and will not be allowed to attempt the rest questions.</li>
            <li>Right click on the mouse is disabled.</li>
        </ul>
    </div>



    <div class="container my-5">

        <table class="data my-3 table-bordered table table-hover text-center">
            <thead>
                <tr class="table-bordered">
                    <th scope="col">No.</th>
                    <th scope="col">Exam Name</th>
                    <th scope="col">Date/Time</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <?php
            $prn = $_SESSION['uname'];
            $sql = "SELECT * FROM `subject_student_mapping` WHERE student_id=$prn";
            $result = mysqli_query($conn, $sql);
            $count = 1;
            while ($row = mysqli_fetch_assoc($result)) {

                $subject_id = $row['subject_id'];

                $datetime = "SELECT * FROM `examination_schedule` WHERE subject_id=$subject_id";
                $datetimeresult = mysqli_query($conn, $datetime);

                while ($datetimerow = mysqli_fetch_assoc($datetimeresult)) {

                    $status = $datetimerow['exam_status'];
                    $date = date_create($datetimerow['exam_date']);
                    $time = date_create($datetimerow['exam_time']);
                    $duration = $datetimerow['exam_duration'];

                    $getsubjectname = "SELECT * FROM `subject_register` WHERE subject_id=$subject_id";
                    $result2 = mysqli_query($conn, $getsubjectname);

                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        $subjectname = $row2['subject_name'];
                        $subjectcode = $row2['subject_code'];

                        echo '<form action="../webcam/index.php" method="POST">
                                <tbody>
                                        <tr>
                                            <th scope="row">' . $count . '</th>
                                            <td>' . $subjectname . ' [' . $subjectcode . ']</td>

                                        

                                            <td>' . date_format($date, "d/m/Y") . ' | ' . date_format($time, "h:i a") . '</td>

                                            
                                            <td>
                                            <input type="hidden" name="subject" value="' . $subject_id . '">
                                            <input type="hidden" name="starttime" value="' . date_format($time, "h:i a") . '">
                                            <input type="hidden" name="exam_duration" value="' . $duration . '">
                                            <input type="hidden" name="webcam" value="' . true . '">';

                        $blockeduser = "SELECT * FROM `block_list` WHERE student_id=$prn AND subject_id=$subject_id";
                        $blockedresult = mysqli_query($conn, $blockeduser);

                        $blockednum = mysqli_num_rows($blockedresult);

                        if ($status == 1 && $blockednum < 1) {
                            echo '<input type="submit" class="btn btn-success" value="START">
                                                </td>
                                            </tr>
                                            </tbody>
                                            </form>';
                        } elseif ($blockednum == 1) {
                            echo '<input type="submit" class="btn btn-outline-success" value="START" disabled>
                                                </td>
                                            </tr>
                                            </tbody>
                                            </form>';
                        } else {
                            echo '<input type="submit" class="btn btn-outline-success" value="START" disabled>
                                                </td>
                                            </tr>
                                            </tbody>
                                            </form>';
                        }
                    }
                    $count++;
                }
            }

            ?>
        </table>

    </div>

    <?php include 'footer.php'; ?>

</body>
<script>
    //script to disable right click and keyboardkeys

    document.onkeydown = function(e) {
        return false;
    }
    $(document).on("contextmenu", function(e) {
        alert('Right Click Not Allowed')
        e.preventDefault();
    });

    //toreload pageevery 5 minute

    setInterval(() => {
        location.reload();

    }, 10000);
</script>


</html>