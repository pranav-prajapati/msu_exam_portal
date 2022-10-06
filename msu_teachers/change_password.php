<!doctype html>
<html lang="en">

<head>

    <script src="../js/sweetalert.js"></script>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- bootstrap 4 required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <!-- datatable cdn -->
    <link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css" />



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATE PASSWORD</title>


    <style>
        .container {
            box-sizing: border-box;

            min-height: 448px;
            width: 60%;

        }

        th {
            font-size: 12px;
        }

        td {
            font-size: 12px;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <?php
    include 'teacher_header.php';
    ?>
    <div class="content-container mx-5">
        <?php
        if (isset($_GET['password_update']) == 'success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your password changed successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
        }

        ?>
        <div class="container my-5">
            <form id="register">
                <h4 class="text-center">UPDATE YOUR PASSWORD HERE</h4>
                <hr>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
                    <div id="validate" class="invalid-feedback my-0">
                        Please enter username.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    <div id="validate" class="invalid-feedback my-0">
                        Please Enter valid email address.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div id="validate" class="invalid-feedback">
                        password should be Minimum eight characters, at least one uppercase letter, one lowercase
                        letter, one number and one special character
                    </div>
                </div>

                <button type="submit" id="submit" class="btn btn-primary" onclick="formregistration()" disabled>Update
                    Password</button> <span id="updatepwd"></span>
            </form>

        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->

    <script>
        let newpwd = document.getElementById('password')
        let email = document.getElementById('email')
        let username = document.getElementById('username')
        let submit = document.getElementById('submit')

        let validEmail = false;
        let validUname = false;
        let pwd = false;

        //username validation
        username.addEventListener("input", () => {
            let regex = /^[a-zA-Z0-9]+$/;
            let str = username.value;
            if (regex.test(str)) {
                username.classList.remove('is-invalid');
                validUname = true;
            } else {
                username.classList.add('is-invalid');
                validUname = false;
            }
        });


        //email validation
        email.addEventListener('input', () => {
            let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
            let str = email.value;
            if (regex.test(str)) {
                email.classList.remove('is-invalid');
                validEmail = true;
            } else {
                email.classList.add('is-invalid');
                validEmail = false;
            }
        });

        //password validation
        newpwd.addEventListener('input', function() {
            // console.log("blurred")
            let regx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$#!%*?&]{8,}$/
            let str = newpwd.value
            // console.log(regx,str)
            if (regx.test(str)) {
                // console.log("password is valid")
                newpwd.classList.remove('is-invalid')
                pwd = true
            } else {
                // console.log("password is invalid")
                newpwd.classList.add('is-invalid')
                pwd = false
            }
        })


        //condition to enable button
        let input = document.getElementsByTagName('input')

        for (let index = 0; index < input.length; index++) {
            // console.log(input[index])
            input[index].addEventListener('input', function() {
                if (pwd && validEmail && validUname) {
                    // console.log('validated')
                    submit.removeAttribute("disabled")
                } else {
                    // console.log("not validated")
                    submit.setAttribute("disabled", true)
                }
            })

        }






        function formregistration() {

            let registrationform = document.querySelector('#register');
            // let message = document.querySelector('#message')

            registrationform.addEventListener('submit', function() {
                submit.setAttribute("disabled", true)
                submit.innerHTML = "Please Wait"
            })

            let html = ""
            registrationform.onsubmit = async (e) => {
                e.preventDefault();

                let response = await fetch('change_password_handler.php', {
                    method: 'POST',
                    body: new FormData(registrationform)
                });

                res = await response.text();

                if (res == 0) {
                    submit.removeAttribute("disabled")
                    submit.innerHTML="Try Again"
                    updatepwd.innerHTML=""

                }

                if (res == 1) {
                    window.location.assign("change_password_verification.php")
                }

                if (res == 2) {
                    updatepwd.innerHTML = "Wrong email address or username!!!"
                    updatepwd.style.color = "red"
                    submit.removeAttribute("disabled")
                    submit.innerHTML="Try Again"
                }
            }

        }
    </script>
</body>

</html>