<?php
include 'connection.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Student Login</title>

    <link rel="stylesheet" type="text/css" href="../css/signup.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript">
    $(document).ready(function() {
        $("#faculty").change(function() {
            var faculty_id = $(this).val();
            $.ajax({
                url: "student_department_selection.php",
                method: "POST",
                data: {
                    Faculty: faculty_id
                },
                success: function(data) {
                    $("#department").html(data);
                }
            });
        });
    });
    </script>
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
    <style>
    /* alert css */

    .dangeralert {
        padding: 20px;
        background-color: #ff4d4d;
        color: white;
    }

    .successalert {
        padding: 20px;
        background-color: #009900;
        color: white;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
    </style>

</head>
<br>
<body>
    <?php
if(isset($_GET['error'])&&$_GET['error']=='user_already_registered'){
  echo"
  <div class='dangeralert'>
  <span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span> 
  <strong>Error!</strong> User Already registered!!!.
</div>";
}

if(isset($_GET['error'])&&$_GET['error']=='some_error_occured...record not inserted'){
    echo"
    <div class='dangeralert'>
    <span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span> 
    <strong>Failed!</strong> Some Error occured!!!.
  </div>";
  }
?>
<br>

    <div class="wrapper">
        <div class="title-text">
            <div class="title login">
                STUDENT SIGNUP</div>
        </div>
        <div class="form-container">
            <div class="form-inner">

                <!-- student login -->

                <form action="student_signup_handler.php" class="login">
                    <!--fullname-->
                    <div class="field">
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Full Name">
                        <div id="validate" class="invalid-feedback my-0">
                            Please Enter Fullname. ex : 'pranav prajapati'
                        </div>
                    </div>
                    <!--email-->
                    <div class="field">
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email"
                            placeholder="Email-Address">
                        <div id="validate" class="invalid-feedback my-0">
                            Please Enter Correct form of Email Address.
                        </div>
                    </div>
                    <!--prn-->
                    <div class="field">
                        <input type="text" class="form-control" id="prn" name="prn" placeholder="Enter your PRN">
                        <div id="validate" class="invalid-feedback my-0">
                            Please Enter PRN. 'It contains 16 Digits' ex : '2018033800xxxxx4'.
                        </div>
                    </div>

                    <!--phone no.-->
                    <div class="field">
                        <input type="text" class="form-control" id="phno" name="phone" placeholder="Phone No.">
                        <div id="validate" class="invalid-feedback my-0">
                            Please Enter valid Phone Number. ex : '9054546362'
                        </div>
                    </div>



                    <!--faculty / department / year-->
                    <div class="row my-2">
                        <div class="form-group col-md-6 my-2">
                            <label for="inputState">Faculty</label>
                            <select id="faculty" class="form-control" name="faculty" required>
                                <option style="color:blue" selected value=''>Select Faculty</option>
                                <?php

                                $abc = "SELECT * FROM faculty_register ORDER BY faculty_id";
                                $result = mysqli_query($conn, $abc);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value=' . $row['faculty_id'] . '>' . $row['faculty_name'] . '</option>';
                                }

                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 my-2">
                            <label for="inputState">Department</label>
                            <select id="department" class="form-control" name="department" required>
                                <option value="" disabled selected>Select Department</option>

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="inputState">Degree</label>
                            <select id="degree" class="form-control" name="degree" required>
                                <option value="" disabled selected>Select Degree</option>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">Year </label>
                            <select id="year" class="form-control" name="year" required>
                                <option value="" disabled selected>Select Year</option>
                            </select>
                        </div>
                    </div>






                    <!--button-->
                    <button type="submit" id="submit" class="btn text-center my-3" disabled>SIGN-UP</button>

                    <div class="signup-link">
                        Already registered? <a href="http://localhost/msu_exam_portal/">Login here</a></div>
                </form>
            </div>
        </div>
    </div>










    <script>
    const fullname = document.getElementById('fullname');
    const email = document.getElementById('email');
    const prn = document.getElementById('prn');
    const phno = document.getElementById('phno');
    const submit = document.getElementById('submit');

    let validFullname = false;
    let validEmail = false;
    let validPrn = false;
    let validPhno = false;

    console.log(fullname)
    console.log(email)
    console.log(prn)
    console.log(phno)
    //Full name
    fullname.addEventListener("input", () => {
        let regex = /^[a-zA-Z]+ [a-zA-Z]+$/;
        let str = fullname.value;
        if (regex.test(str)) {
            fullname.classList.remove('is-invalid');
            validFullname = true;
            console.log('valid')
        } else {
            fullname.classList.add('is-invalid');
            validFullname = false;
            console.log('invalid')
        }
    });

    //Email address

    email.addEventListener('input', () => {
        let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        let str = email.value;
        if (regex.test(str)) {
            email.classList.remove('is-invalid');
            console.log('valid')
            validEmail = true;
        } else {
            email.classList.add('is-invalid');
            validEmail = false;
            console.log('invalid')
        }
    });

    //Prn

    prn.addEventListener('input', () => {
        let regex = /[0-9]{16}/;
        let str = prn.value;
        if (regex.test(str)) {
            prn.classList.remove('is-invalid');
            validPrn = true;
            console.log('valid')
        } else {
            prn.classList.add('is-invalid');
            validPrn = false;
            console.log('invalid')
        }
    });





    //phone number
    phno.addEventListener('input', () => {
        let regex = /^([0-9]){10}$/;
        let str = phno.value;

        if (regex.test(str)) {
            phno.classList.remove('is-invalid');
            validPhno = true;
            console.log('valid')
        } else {
            phno.classList.add('is-invalid');
            validPhno = false;
            console.log('invalid')
        }


    });

    let input = document.getElementsByTagName('input')

    for (let index = 0; index < input.length; index++) {
        // console.log(input[index])
        input[index].addEventListener('input', function() {
            if (validFullname && validEmail && validPrn && validPhno) {
                console.log('validated')
                submit.removeAttribute("disabled")
            } else {
                console.log("not validated")
                submit.setAttribute("disabled", true)
            }
        })

    }


    window.history.forward();

    function noBack() {
        window.history.forward();
    }
    </script>

</body>

</html>