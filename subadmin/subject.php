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
            background-color: #ffffff00;
        }

        .jumbotron tr {
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    <?php
    include 'subadmin_header.php';
    ?>
    <div class="content-container">

        <?php include 'top_navbar.php'; ?>

        <div class="container my-5">



            <div class="jumbotron">
                <center>
                    <h3 class="text-center">ADD SUBJECTS</h3>
                </center>
                <hr class="my-4">

                <!--Form add subjects-->
                <form id="register">


                    <div class="row">
                        <div class="form-group col-md-6">
                            <select id="degree" class="form-control" name="degree" required>
                                <option disabled selected hidden>CHOOSE DEGREE</option>

                                <?php
                                $department = $_SESSION['department'];
                                $result = mysqli_query($conn, "SELECT * FROM degree WHERE `department_id`='$department'");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['degree_id'] . '">' . $row['degree_name'] . '</option>';
                                }

                                ?>



                            </select>
                        </div>



                        <div class="form-group col-md-6">

                            <select id="year" class="form-control" name="year" required>
                                <option value="" disabled selected>Select Year</option>
                            </select>
                        </div>
                    </div>


                    <div class="row my-3">
                        <div class="col-md-6"> <input type="text" name="sub_name" id="sub_name" placeholder="SUBJECT NAME" class="form-control name_list" required></div>
                        <div class="col-md-6"> <input type="text" name="sub_code" id="sub_code" placeholder="SUBJECT CODE" class="form-control name_list" required></div>
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
                    <center><input type="submit" name="submit" id="submit" class="btn btn-outline-info" value="SUBMIT" onclick="formregistration()" /></center>
                    <span id="message"></span>

                </form>
            </div>
        </div>
    </div>

    </div>
    </div>


    <?php
    include 'footer.php';
    ?>
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



            let success = "subject Succesfully inserted"
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