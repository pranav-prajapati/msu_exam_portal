<?php include '../partials/connection.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD DEPARTMENT</title>



    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- bootstrap 4 required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>

<body>

    <?php
    include 's_admin_header.php';
    ?>
    <div class="content-container">

        <?php include 'top_navbar.php'; ?>

        <div class="container my-5">




            <div class="jumbotron">
                <center>
                    <h3 class="text-center">ADD DEPARTMENT DETAILS</h3>
                </center>
                <hr class="my-4">

                <!--Form add subjects-->
                <form id="register">


                    <input type="hidden" name="faculty_id" value="<?php echo $_SESSION['faculty']; ?>">
                    <!--ADD DEPARTMENT-->
                    <div class="form-group my-4">
                        <input type="text" name="department_name" class="form-control" placeholder="DEPARTMENT NAME" required>
                    </div>
                    <center><input type="submit" name="submit" id="submit" class="my-3 btn btn-outline-info" value="SUBMIT" onclick="formregistration()" />
                        <span id="message"></span>
                    </center>

                </form>
            </div>

           
         

            <br>



        </div>


        <?php
        include 'footer.php';
        ?>
    </div>
</body>

</html>


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

            let response = await fetch('add_department_handler.php', {
                method: 'POST',
                body: new FormData(registrationform)
            });

            res = await response.text();



            let success = "Department Succesfully Inserted"
            let fail = "failed to insert Department"
            let exist = "Department already exist"

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