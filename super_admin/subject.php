<?php

include '../partials/connection.php';
?>

<html>

<head>
    <title>SUBJECTS</title>

    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- bootstrap 4 required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



    <style>
        .jumbotron {
            background-color: #E6E6FA;
        }

        .jumbotron tr {
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    <?php
    include 's_admin_header.php';
    ?>
    <div class="content-container">

        <?php include 'top_navbar.php'; ?>

        <div class="container my-5">


            <div class="row">
                <div class="col-md-8">
                    <div class="jumbotron">
                        <center>
                            <h2>ADD SUBJECTS</h2>
                        </center>
                        <hr class="my-4">
                        <div class="form-group">
                            <!--Form add subjects-->
                            <form id="register">




                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <select id="department" class="form-control" name="department" required>
                                            <option disabled selected hidden>CHOOSE DEPARTMENT</option>

                                            <?php
                                            $faculty = $_SESSION['faculty'];
                                            $result = mysqli_query($conn, "SELECT * FROM department WHERE `faculty_id`='$faculty'");
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $row['department_id'] . '">' . $row['department_name'] . '</option>';
                                            }

                                            ?>



                                        </select>
                                    </div>

                                    <div class="col-md-4">

                                        <select id="degree" class="form-control" name="degree" required>
                                            <option value="" disabled selected>Select Degree</option>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        
                                        <select id="year" class="form-control" name="year" required>
                                            <option value="" disabled selected>Select Year</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="sub_name" id="sub_name" placeholder="SUBJECT NAME" class="form-control name_list" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" name="sub_code" id="sub_code" placeholder="SUBJECT CODE" class="form-control name_list" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <!--category_core_foundation_elective-->
                                            <input class="form-check-input" type="radio" name="sub_category" id="sub_category" value="core" required>
                                            <label class="form-check-label" for="exampleRadios1">
                                                CORE
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sub_category" value="foundation">
                                            <label class="form-check-label" for="exampleRadios2">
                                                FOUNDATION
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="sub_category" value="elective">
                                            <label class="form-check-label" for="exampleRadios2">
                                                ELECTIVE
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" name="sub_credit" id="sub_credit" placeholder="ENTER CREDITS" class="form-control name_list" required>
                                    </div>
                                </div>
                                <center><input type="submit" name="submit" id="submit" class="my-4 btn btn-outline-info" value="SUBMIT" onclick="formregistration()" />
                                    <span id="message"></span>
                                </center>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="background-color:lightgray;  background-color: #E6E6FA;">
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

                            <div class="row no-gutters align-items-center">

                                <?php
                                $faculty_id = $_SESSION['faculty'];

                                $ab = mysqli_query($conn, "SELECT * FROM subject_register  WHERE  `faculty_id`='$faculty_id'");
                                $re = mysqli_num_rows($ab);

                                echo '<h5 > TOTAL SUBJECTS : ' . $re . '</h5>';
                                ?>
                            </div>
                            <div class="row no-gutters align-items-center">

                                <?php
                                $ab2 = mysqli_query($conn, "SELECT * FROM subject_register  WHERE `subject_category`='core' AND `faculty_id`='$faculty_id'");
                                $re2 = mysqli_num_rows($ab2);
                                echo '<h6> TOTAL CORE : ' . $re2 . '</h6>';
                                ?>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <?php

                                $ab3 = mysqli_query($conn, "SELECT * FROM subject_register  WHERE `subject_category`='foundation' AND `faculty_id`='$faculty_id'");
                                $re3 = mysqli_num_rows($ab3);
                                echo '<h6> TOTAL FOUNDATION : ' . $re3 . '</h6>';
                                ?>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <?php
                                $ab4 = mysqli_query($conn, "SELECT * FROM subject_register  WHERE `subject_category`='elective' AND `faculty_id`='$faculty_id'");
                                $re4 = mysqli_num_rows($ab4);
                                echo '<h6> TOTAL ELECTIVE : ' . $re4 . '</h6>';



                                ?>
                            </div>
                            <div class="row no-gutters align-items-center">
                                <?php
                                $faculty_id = $_SESSION['faculty'];

                                $ab = mysqli_query($conn, "SELECT * FROM subject_examiner_mapping  WHERE `examiner_role`='Chair Paper Setter' AND  `faculty_id`='$faculty_id'");
                                $re = mysqli_num_rows($ab);

                                echo '<a class="my-3" style="color:black; text-decoration: none;"  href="student_subject_list.php" ><h6><i class="fas fa-clipboard-list"></i> STUDENTS SUBJECT-LIST</h6></a>';

                                ?>
                            </div>





                        </div>
                        <div class="row my-3 no-gutters align-items-center">







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

<script>
    function formregistration() {

        let registrationform = document.querySelector('#register');
        let message = document.querySelector('#message')
        let submit = document.querySelector('#submit')



        registrationform.addEventListener('submit', function() {
            submit.setAttribute("disabled", true)
            submit.innerHTML = "Please Wait"
        })

        let html = ""
        registrationform.onsubmit = async (e) => {
            e.preventDefault();

            let response = await fetch('add_subject_handler.php', {
                method: 'POST',
                body: new FormData(registrationform)
            });

            res = await response.text();



            let success = "Subject Succesfully Inserted"
            let fail = "failed to insert subject"
            let exist = "Subject already exist"

            if (res == 1) {
                html += `${success}`
                message.innerHTML = html
                message.style.color = "green"
                submit.removeAttribute("disabled")
                submit.innerHTML = "submit"
                document.getElementById("register").reset();
            }

            if (res == 0) {
                html += `${fail}`
                message.innerHTML = html
                message.style.color = "red"
                submit.removeAttribute("disabled")
                submit.innerHTML = "Try again"

            }

            if (res == 2) {
                html += `${exist}`
                message.innerHTML = html
                message.style.color = "red"
                submit.removeAttribute("disabled")
                submit.innerHTML = "submit"

            }

        }

    }
</script>


</html>


<script type="text/javascript">
    $(document).ready(function() {
        $("#department").change(function() {
            var department_id = $(this).val();
            $.ajax({
                url: "department_degree.php",
                method: "POST",
                data: {
                    department: department_id
                },
                success: function(data) {
                    $("#degree").html(data);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#degree").change(function() {
            var degree_name = $(this).val();
            $.ajax({
                url: "year_degree.php",
                method: "POST",
                data: {
                    degree: degree_name
                },
                success: function(data) {
                    $("#year").html(data);
                }
            });
        });
    });
</script>