<?php
include "../partials/connection.php";
?>


<!doctype html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <title>Exam Role Assigning</title>
  <style>
    .container {

      min-height: 448px;

      border-radius: 20px;
      padding: 50px;
    }

    .ab {
      background-color: #E6E6FA;
      padding: 20px;
    }
  </style>
</head>

<body>
  <?php include 's_admin_header.php' ?>
  <div class="content-container">
    <?php
    include 'top_navbar.php';
    ?>
    <div class="container justify-content-center ">
      <div class="row">
        <div class="col-md-8 ab">
          <form id=register>
            <br>
            <?php
            $faculty = $_SESSION['faculty'];
            ?>
            <input type="hidden" name="faculty_id" value="<?php echo $faculty; ?>" />

            <h2 class="text-center"> EXAM ROLE ASSIGNING </h2>

            <br>
            <br>
            <div class="form-group">
              <select class="form-control" id="department" name="department_id">
                <option selected disabled hidden> SELECT DEPARTMENT </option>
                <?php
                $department_selection = mysqli_query($conn, "SELECT * FROM department WHERE `faculty_id`='$faculty'");
                while ($result_d = mysqli_fetch_assoc($department_selection)) {
                  echo '
                  <option value="' . $result_d['department_id'] . '">' . $result_d['department_name'] . '</option>
                  ';
                }
                ?>
              </select>

            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                SUBJECT NAME: <select class="custom-select mb-3" id="subject" name="sub_name" required>
                    <option hidden disabled selected>SELECT SUBJECTS</option>

                  </select>
                </div>
              </div>




              <div class="col-md-6">
                <!-- Subject Code -->
                <div class="form-group">
                  SUBJECT CODE: <select id="subject_code" class="form-control" name="subject_code" required>

                  </select>
                </div>
              </div>
            </div>



            <div class="row">
              <div class="col-md-6">
                <!-- Examiner Name -->
                <div class="form-group">

                  EXAMINER NAME: <select class="custom-select examiner  mb-3" id="examiner_name" name="examiner_name" required>

                    <option hidden disabled selected>CHOOSE EXAMINER NAME</option>
                    <?php

                    $abc = "SELECT name FROM user_register WHERE role='examiner' AND faculty_id=$faculty ";
                    $result = mysqli_query($conn, $abc);
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                    }

                    ?>
                  </select>


                </div>
              </div>
              <!-- Examiner Code -->
              <div class="col-md-6">
                <div class="form-group">
                  EXAMINER CODE:<select id="examiner_code" class="form-control" name="examiner_code" required>

                  </select>
                </div>
              </div>
            </div>



            <!-- Role Dropdown -->

            <div class="form-group">

              <select id="role" name="role" class="form-control" required>
                <option value="" disabled selected hidden>CHOOSE ROLE</option>
                <option>Paper Setter</option>
                <option>Chair Paper Setter</option>
              </select>
            </div>




            <!--Button Submit-->
            <br>

            <button type="submit" style="margin-left:40% ;" id="submit" class="btn  btn-outline-primary" onclick="formregistration()">SUBMIT</button> <span id="message"></span>
          </form>
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
              <a class="my-2" href="examiner_list.php"><h6  style="color:darkblue; float: right;"><i class="fas fa-list"></i> EXAMINER LIST </h6></a>
                <?php
                $faculty_id = $_SESSION['faculty'];

                $ab = mysqli_query($conn, "SELECT * FROM subject_examiner_mapping  WHERE `examiner_role`='Paper Setter' AND  `faculty_id`='$faculty_id'");
                $re = mysqli_num_rows($ab);

                echo '<h6> TOTAL PAPER SETTER : ' . $re . '</h6>';

                ?>
                <?php
                $faculty_id = $_SESSION['faculty'];

                $ab = mysqli_query($conn, "SELECT * FROM subject_examiner_mapping  WHERE `examiner_role`='Chair Paper Setter' AND  `faculty_id`='$faculty_id'");
                $re = mysqli_num_rows($ab);

                echo '<h6> TOTAL CHAIR PAPER SETTER : ' . $re . '</h6>';

                ?>





              </div>
              <div class="row my-3 no-gutters align-items-center">







              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
    <?php include 'footer.php' ?>
  </div>


  <script>
    //  ajax query for subject code to be fetched from the table with the help of subject name.
    $(document).ready(function() {
      $('#subject').change(function() {



        var subject_id = $(this).val();

        $.ajax({
          url: 'name_code_subject.php',
          method: "POST",
          data: {
            sub_name: subject_id
          },
          success: function(data) {
            $("#subject_code").html(data);
          }
        });
      });



      // ajax query for the examiner code to be fetched from table with the help of name of the examine
      $('#examiner_name').change(function() {



        var user_id = $(this).val();

        $.ajax({
          url: 'name_code_examiner.php',
          method: "POST",
          data: {
            examiner_name: user_id
          },
          success: function(data) {
            $("#examiner_code").html(data);
          }
        });
      });
    });


    //ajax code to assign examiner

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

        let response = await fetch('examiner_assigning_handler.php', {
          method: 'POST',
          body: new FormData(registrationform)
        });

        res = await response.text();



        let insert = "Exam role assigned successfully"
        let exist = "Exam role already assigned"

        if (res == 1) {
          html += `${insert}`
          message.innerHTML = html
          message.style.color = "green"
          submit.removeAttribute("disabled")
          submit.innerHTML = "submit"
          document.getElementById("register").reset();

        }

        if (res == 0) {
          html += `${exist}`
          message.innerHTML = html
          message.style.color = "red"
          submit.removeAttribute("disabled")
          submit.innerHTML = "submit"

        }

      }

    }
  </script>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
</body>


</html>


<script type="text/javascript">
  $(document).ready(function() {
    $("#department").change(function() {
      var department_id = $(this).val();
      $.ajax({
        url: "department_subject.php",
        method: "POST",
        data: {
          department: department_id
        },
        success: function(data) {
          $("#subject").html(data);
        }
      });
    });
  });
</script>