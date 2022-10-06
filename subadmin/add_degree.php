<?php include '../partials/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD DEGREE AND YEAR</title>



    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- bootstrap 4 required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        .container {



            min-height: 433px;
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








            <!-- add degree -->


            <div class="jumbotron">

                <center>
                    <h3 class="text-center">ADD DEGREE DETAILS</h3>
                </center>
                <hr class="my-4">
                <center>  <label>[ eg: " Bachelor of Computer Applications " ]</label></center>
                <form id="register2">

                    <div class="row my-3">
                        <div class="col-md">
                            <input type="hidden" name="department_id" value="<?php echo $_SESSION['department']; ?>">
                            <input type="text" name="degree_name" id="degree_name" class="form-control" placeholder="BACHELORS/MASTERS DEGREE NAME" required>
                        </div>


                    </div>
                    <center><input type="submit" name="sub2" id="submit2" class="my-3 btn btn-outline-info" value="SUBMIT" onclick="formregistration2()" />
                        <span id="message2"></span>
                    </center>
                </form>
            </div>

            <br>


            <!-- add degree -->
            <div class="row">
                <div class="col-md-6">
                    <div class="jumbotron">
                        <center>
                            <h4 class="text-center">ADD <span style="color:darkblue;">UNDERGRADUATE</span> DETAILS</h4>
                        </center>
                        <hr class="my-4">
                        <form id="register3">
                            <div>
                                <label for="inputState">SELECT DEGREE</label>
                                <select id="degree" name="degree_id" class="form-control">
                                    <option selected hidden disabled>CHOOSE...</option>

                                    <?php
                                    $departmet_id = $_SESSION['department'];
                                    $sql = mysqli_query($conn, "SELECT * FROM degree WHERE `department_id`='$departmet_id'");
                                    while ($ro = mysqli_fetch_assoc($sql)) {
                                        echo '<option value="' . $ro['degree_id'] . '">' . $ro['degree_name'] . '</option>';
                                    }

                                    ?>

                                </select>



                                <input type="hidden" name="department_id" value="<?php echo $departmet_id; ?>" />







                                <label class="my-2">ENTER YEAR CODE :</label>
                                <span class="mx-3" style="color:darkblue; font-size: 12px;"> eg: <b>" PYFY "</b> PY="Physics" FY="First Year" </span>
                                <br>
                                <input type="text" id="fy" name="fy" class="my-1 form-control" placeholder="FOR FIRST YEAR">

                                <input type="text" id="sy" name="sy" class="my-1 form-control" placeholder="FOR SECOND YEAR">


                                <input type="text" id="ty" name="ty" class="my-1 form-control" placeholder="FOR THIRD YEAR">














                                <center><input type="submit" class="my-3 btn btn-outline-info" id="submit3" value="SUBMIT" onclick="formregistration3()" />
                                    <span id="message3"></span>
                                </center>

                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="jumbotron">
                        <center>
                            <h3 class="text-center">ADD <span style="color:darkred;">POSTGRADUATE</span> DETAILS</h3>
                        </center>
                        <hr class="my-4">
                        <form id="register4">
                            <div>
                                <label for="inputState">DEGREE</label>
                                <select id="degree" name="degree_id" class="form-control">
                                    <option selected hidden disabled>CHOOSE...</option>

                                    <?php
                                    $departmet_id = $_SESSION['department'];
                                    $sql = mysqli_query($conn, "SELECT * FROM degree WHERE `department_id`='$departmet_id'");
                                    while ($ro = mysqli_fetch_assoc($sql)) {
                                        echo '<option value="' . $ro['degree_id'] . '">' . $ro['degree_name'] . '</option>';
                                    }

                                    ?>

                                </select>




                                <input type="hidden" name="department_id" value="<?php echo $departmet_id; ?>">

                                <!-- add Year -->





                                <label class="my-2">ENTER YEAR CODE :</label>
                                <span class="mx-2" style="color:darkred; font-size: 12px;">eg: <b>" CHPY "</b> CH="Chemistry", PY="Previous Year" </span>
                                <input type="text" name="py" class="my-1 form-control" placeholder="FOR PREVIOUS YEAR">
                                <input type="text" name="ly" class="my-1 form-control" placeholder="FOR FINAL YEAR">





                                <center><input type="submit"  id="submit4" class="my-3 btn btn-outline-info" value="SUBMIT" onclick="formregistration4()" />
                                <span id="message4"></span>
                                </center>
                               

                            </div>
                        </form>
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
    function formregistration2() {

        let registrationform2 = document.querySelector('#register2');
        let message2 = document.querySelector('#message2')
        let submit2 = document.querySelector('#submit2')




        registrationform2.addEventListener('submit', function() {
            submit2.setAttribute("disabled", true)
            submit2.innerHTML = "Please Wait"
        })

        let html = ""
        registrationform2.onsubmit = async (e) => {
            e.preventDefault();

            let response = await fetch('add_degree_handler.php', {
                method: 'POST',
                body: new FormData(registrationform2)
            });

            res = await response.text();



            let success2 = "Degree Succesfully Inserted"
            let fail2 = "failed to insert Degree"
            let exist2 = "Degree already exist"

            if (res == 1) {
                html += `${success2}`
                message2.innerHTML = html
                message2.style.color = "green"
                submit2.removeAttribute("disabled")
                submit2.innerHTML = "submit"
                document.getElementById("register2").reset();

            }

            if (res == 0) {
                html += `${fail2}`
                message2.innerHTML = html
                message2.style.color = "red"
                submit2.removeAttribute("disabled")
                submit2.innerHTML = "Try again"

            }

            if (res == 2) {
                html += `${exist2}`
                message2.innerHTML = html
                message2.style.color = "red"
                submit2.removeAttribute("disabled")
                submit2.innerHTML = "submit"

            }

        }

    }



    //undergraduate form



    function formregistration3() {

        let registrationform3 = document.querySelector('#register3');
        let message3 = document.querySelector('#message3')
        let submit3 = document.querySelector('#submit3')




        registrationform3.addEventListener('submit', function() {
            submit3.setAttribute("disabled", true)
            submit3.innerHTML = "Please Wait"
        })

        let html = ""
        registrationform3.onsubmit = async (e) => {
            e.preventDefault();

            let response = await fetch('add_degree_bachelors_year_handler.php', {
                method: 'POST',
                body: new FormData(registrationform3)
            });

            res = await response.text();



            let success3 = "Data Succesfully Inserted"
            let fail3 = "Some Problem occured Try Again"
            let exist3 = "Data already exist"

            if (res == 1) {
                html += `${success3}`
                message3.innerHTML = html
                message3.style.color = "green"
                submit3.removeAttribute("disabled")
                submit3.innerHTML = "submit"
                document.getElementById("register3").reset();

            }

            if (res == 0) {
                html += `${fail3}`
                message3.innerHTML = html
                message3.style.color = "red"
                submit3.removeAttribute("disabled")
                submit3.innerHTML = "Try again"

            }

            if (res == 2) {
                html += `${exist3}`
                message3.innerHTML = html
                message3.style.color = "red"
                submit3.removeAttribute("disabled")
                submit3.innerHTML = "submit"

            }

        }

    }




    function formregistration4() {

let registrationform4 = document.querySelector('#register4');
let message4 = document.querySelector('#message4')
let submit4 = document.querySelector('#submit4')




registrationform4.addEventListener('submit', function() {
    submit4.setAttribute("disabled", true)
    submit4.innerHTML = "Please Wait"
})

let html = ""
registrationform4.onsubmit = async (e) => {
    e.preventDefault();

    let response = await fetch('add_degree_masters_year_handler.php', {
        method: 'POST',
        body: new FormData(registrationform4)
    });

    res = await response.text();



    let success4 = "Data Succesfully Inserted"
    let fail4 = "Some Problem occured Try Again"
    let exist4 = "Data already exist"

    if (res == 1) {
        html += `${success4}`
        message4.innerHTML = html
        message4.style.color = "green"
        submit4.removeAttribute("disabled")
        submit4.innerHTML = "submit"
        document.getElementById("register4").reset();

    }

    if (res == 0) {
        html += `${fail4}`
        message4.innerHTML = html
        message4.style.color = "red"
        submit4.removeAttribute("disabled")
        submit4.innerHTML = "Try again"

    }

    if (res == 2) {
        html += `${exist4}`
        message4.innerHTML = html
        message4.style.color = "red"
        submit4.removeAttribute("disabled")
        submit4.innerHTML = "submit"

    }

}

}
</script>