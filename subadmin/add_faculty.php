<?php
include "../partials/connection.php";
?>
<!doctype html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" />

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

  <title>Faculty Registration</title>
  <style>
    .container {

      background-color: #ffffff00;
      padding: 20px;
      width: 70%;

      min-height: 433px;
    }
  </style>

</head>

<body>


  <?php
  include 'subadmin_header.php';
  ?>

  <div class="content-container">
    <?php
    include 'top_navbar.php';
    ?>
    <div class="container  my-5">

      <h2 class="text-center">FACULTY REGISTRATION</h2>
      <br>
      <a href="faculty_list.php">
        <h6 style="color:darkblue; float: right;"><i class="fas fa-list"></i> FACULTY LIST </h6>
      </a>
      <br>
      <!-- <form action="add_faculty_handler.php" method="POST"> -->
      <form id="register">
        <!-- Teacher ID -->
        <div>
          <input class="form-control" type="text" id="name" name="name" placeholder="FULL NAME"
            aria-label="default input example" required>
          <div id="validate" class="invalid-feedback my-0">
            Please Enter Fullname. 'for example : NILAY PAKAKEDA'
          </div>
        </div>
        <br>
        <!-- Teacher Name -->
        <div>
          <input class="form-control" type="text" placeholder="USER NAME" id="username" name="username"
            aria-label="default input example" required>
          <div id="validate" class="invalid-feedback my-0">
            Please enter username.
          </div>
        </div>
        <br>

        <!-- Email ID -->
        <div class="mb-3">
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email_id"
            placeholder="EMAIL-ID" required>
          <div id="validate" class="invalid-feedback my-0">
            Please Enter valid email address.
          </div>
        </div>


        <br>
        <div>
          <input class="form-control" type="text" name="contact" id="contact" placeholder="CONTACT NUMBER"
            aria-label="default input example">
          <div id="validate" class="invalid-feedback my-0">
            Please Enter valid contact number. 'for example : 9054546362'
          </div>
        </div>
        <br>

        <!-- Roles -->
        <div class="form-group">

          <select class="form-control" name="role" id="role">
            <option hidden disabled selected>CHOOSE ROLE</option>
            <option value="subadmin" id="subadmin">Admin</option>
            <option value="examiner" id="examiner">Examiner</option>
          </select>

        </div>

        <div id="activitydiv" hidden>

          Give Right To Admin :
          <hr>
          <?php

          $activitysql='SELECT * FROM `admin_activities`';
          $activityresult=mysqli_query($conn,$activitysql);

          while($activityrow=mysqli_fetch_assoc($activityresult)){

            $activityid=$activityrow['id'];
            $activity=$activityrow['activity'];

            echo'
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="'.$activityid.'" name="activity[]">
              <label class="form-check-label" for="flexCheckDefault">
                '.$activity.' </label>
            </div>';
          }

          

        ?>
        </div>

        <br>

        <div class="row">
          <div class="form-group col-md-6">
            <label for="inputState">FACULTY</label>
            <select style="text-transform: uppercase;" id="faculty_id" class="form-control" name="faculty" required>
              <option style="color:blue" disabled selected hidden>SELECT FACULTY</option>
              <?php

              $abc = "SELECT * FROM faculty_register ORDER BY faculty_id";
              $result = mysqli_query($conn, $abc);
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['faculty_id'] . '">' . $row['faculty_name'] . '</option>';
              }

              ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="inputState">DEPARTMENT</label>
            <select style="text-transform: uppercase;" id="department" class="form-control" name="department" required>
              <option value="" disabled selected></option>

            </select>
          </div>
        </div>



        <br>



        <center><button type="submit" class="btn btn-outline-info" id="submit"
            onclick="formregistration()">SUBMIT</button> <span id="message"></span>
        </center>

      </form>
    </div>

    <?php
    include 'footer.php';
    ?>
  </div>







  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

<script>
  const teacher_name = document.getElementById("name");
  const email = document.getElementById("email");
  const contact = document.getElementById("contact");
  const username = document.getElementById("username");
  const submit = document.getElementById('submit');


  let validName = false;
  let validEmail = false;
  let validUname = false;
  let validPhno = false;

  // Validation of fields

  //fullname
  teacher_name.addEventListener("input", () => {
    let regex = /^[a-zA-Z]+ [a-zA-Z]+$/;
    let str = teacher_name.value;
    if (regex.test(str)) {
      teacher_name.classList.remove('is-invalid');
      validName = true;
    } else {
      teacher_name.classList.add('is-invalid');
      validName = false;
    }
  });

  //username
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


  //email
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

  //phone number
  contact.addEventListener('input', () => {
    let regex = /^([0-9]){10}$/;
    let str = contact.value;

    if (regex.test(str)) {
      contact.classList.remove('is-invalid');
      validPhno = true;
    } else {
      contact.classList.add('is-invalid');
      validPhno = false;
    }


  });


  let input = document.getElementsByTagName('input')

  for (let index = 0; index < input.length; index++) {
    // console.log(input[index])
    input[index].addEventListener('input', function () {
      if (validName && validEmail && validPhno && validUname) {
        // console.log('validated')
        submit.removeAttribute("disabled")
      } else {
        // console.log("not validated")
        submit.setAttribute("disabled", true)
      }
    })

  }
</script>
<script>
  $(document).ready(function () {
    $("#faculty_id").change(function () {
      var faculty_id = $(this).val();
      $.ajax({
        url: "get_department.php",
        method: "POST",
        data: {
          faculty_id: faculty_id
        },
        success: function (data) {
          $("#department").html(data);
          // console.log(data)
        }
      });
    });
  });

  function formregistration() {

    let registrationform = document.querySelector('#register');
    let message = document.querySelector('#message')
    let submit = document.querySelector('#submit')



    registrationform.addEventListener('submit', function () {
      submit.setAttribute("disabled", true)
      submit.innerHTML = "Please Wait"
    })

    let html = ""
    registrationform.onsubmit = async (e) => {
      e.preventDefault();

      let response = await fetch('add_faculty_handler.php', {
        method: 'POST',
        body: new FormData(registrationform)
      });

      res = await response.text();



      let success = "FACULTY SUCCESSFULLY INSERTED"
      let fail = "can't insert user...some error occured!!!"
      let exist = "user already exist"

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

  let role=document.getElementById('role')
  let activitydiv=document.getElementById('activitydiv')

  role.addEventListener('change',function(){
    if(role.value=='subadmin'){
      activitydiv.removeAttribute('hidden')
    }
    else{
      activitydiv.setAttribute('hidden',true)
    }
  })
</script>






</html>