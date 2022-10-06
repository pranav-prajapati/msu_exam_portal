<?php
include 'connection.php';
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <title>Subject Selection</title>
  <style>
    body {
      background-color: #8C92AC;

    }

    .container {
      padding: 20px;
      width: 50%;
      background-color: white;
    }
  </style>
</head>

<body>
  <div class="container my-5">


    <div class="row">
      <div class="col-md-4">
        <span style="font-size:15px;" class="badge bg-primary"><?php echo $_GET['name'] ?></span>
      </div>
      <div class="col-md-4">
        <h5>SUBJECT SELECTION</h5>
      </div>
      <div class="col-md-4">
        <span style="font-size: 15px; float:right" class="badge bg-primary"><?php echo $_GET['prn'] ?></span>

      </div>
    </div>
    <br>
    <br>

    <!-- Table Start Here -->
    <!-- CORE -->
    <form action="subject_selection_handler.php" method="POST">

      <input type="hidden" name="prn" value="<?php echo $_GET['prn'] ?>">
      <table class="table table-borderless">
        <thead>
          <tr>
            <th>
              <?php

              $year = $_GET['year'];
              $department = $_GET['department'];




              //fetches core subjects year wise
              $re = mysqli_query($conn, "SELECT core FROM year_degree_register WHERE `year`='$year' ");
              $row_c = mysqli_fetch_assoc($re);
              $cor = $row_c['core']; ?>

              <h5>Core Subjects</h5><span style="color:red; font-weight:400">[Select maximum : <?php echo $cor; ?>] *</span>
            </th>
          </tr>


        </thead>
        <tbody>
          <?php

          echo '<input type="hidden" id="cor" value="' . $cor . '">';

          $sql = "SELECT * FROM `subject_register` WHERE year='$year' AND subject_category='core' AND department_id='$department'";
          $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>

            <td>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="' . $row['subject_name'] . '" name="core[]" onclick="coresubjectselection()" required>
                <label class="form-check-label" for="flexCheckDefault">
                ' . htmlspecialchars($row['subject_name']) . '
                </label>
              </div>
            </td>
          </tr>';
          }




          ?>
        </tbody>
      </table>

      <!-- Foundations -->
      <table class="table table-borderless">
        <thead>
          <tr>
            <th>
              <?php


              //fetches foundation subjects year wise

              $resu = mysqli_query($conn, "SELECT foundation FROM year_degree_register WHERE `year`='$year' ");
              $row_f = mysqli_fetch_assoc($resu);
              $foun = $row_f['foundation']; ?>

              <h5>Foundation Subjects</h5><span style="color:red; font-weight:400">[Select maximum : <?php echo $foun; ?>] *</span>

            </th>
          </tr>


        </thead>
        <tbody>

          <?php
          echo '<input type="hidden" id="found" value="' . $foun . '">';

          $sql = "SELECT * FROM `subject_register` WHERE year='$year' AND subject_category='foundation' AND department_id='$department'";
          $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>

            <td>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="' . $row['subject_name'] . '" name="foundation[]" onclick="foundationsubjectselection()" required>
                <label class="form-check-label" for="flexCheckDefault">
                ' . htmlspecialchars($row['subject_name']) . '
                </label>
              </div>
            </td>
          </tr>';
          }




          ?>



        </tbody>
      </table>


      <!-- ELECTIVES -->
      <table class="table table-borderless my-4 ">
        <thead>
          <tr>
            <th>


              <?php



              //fetches elec subjects year wise

              $re = mysqli_query($conn, "SELECT elective FROM year_degree_register WHERE `year`='$year' ");
              $row_e = mysqli_fetch_assoc($re);
              $elec = $row_e['elective']; ?>

              <h5>Elective Subjects</h5><span style="color:red; font-weight:400">[Select maximum : <?php echo $elec;?>] *</span>
            </th>
          </tr>


        </thead>
        <tbody>

          <?php
          echo '<input type="hidden" id="elec" value="' . $elec . '">';


          $sql = "SELECT * FROM `subject_register` WHERE year='$year' AND subject_category='elective' AND department_id='$department'";
          $result = mysqli_query($conn, $sql);

          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>

            <td>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="' . $row['subject_name'] . '" name="elective[]" onclick="electivesubjectselection()" required>
                <label class="form-check-label" for="flexCheckDefault">
                ' . htmlspecialchars($row['subject_name']) . '
                </label>
              </div>
            </td>
          </tr>';
          }




          ?>

        </tbody>
      </table>

      <center> <button type="submit" id="submit" class="btn-lg btn-primary text-center my-3">REGISTER</button>
      </center>
    </form>



  </div>



  </div>

  <script>
    //script to select core subjects with restrictions

    function coresubjectselection() {
      let cor = document.getElementById('cor').value;
      //console.log(cor);
      let core = document.getElementsByName('core[]')
      // console.log(core)
      let count = 0

      for (let index = 0; index < core.length; index++) {
        if (core[index].checked == true) {
          count = count + 1
        }

        if (core[index].checked == false && count >= 1) {
          count - 1
        }
      }

      // console.log(count)

      if (count == cor) {
        for (let index = 0; index < core.length; index++) {
          if (core[index].checked == false) {
            core[index].setAttribute('disabled', true)
          }
        }
      }

      if (count < cor) {
        for (let index = 0; index < core.length; index++) {
          if (core[index].checked == false) {
            core[index].removeAttribute('disabled')
          }
        }
      }

    }

    //script to select foundation subjects with restrictions


    function foundationsubjectselection() {
      let foun = document.getElementById('found').value;
      //console.log(foun);
      let foundation = document.getElementsByName('foundation[]')
      // console.log(core)
      let count = 0

      for (let index = 0; index < foundation.length; index++) {
        if (foundation[index].checked == true) {
          count = count + 1
        }

        if (foundation[index].checked == false && count >= 0) {
          count - 1
        }
      }

      console.log(count)

      if (count == foun) {
        for (let index = 0; index < foundation.length; index++) {
          if (foundation[index].checked == false) {
            foundation[index].setAttribute('disabled', true)
          }
        }
      }

      if (count < foun) {
        for (let index = 0; index < foundation.length; index++) {
          if (foundation[index].checked == false) {
            foundation[index].removeAttribute('disabled')
          }
        }
      }

    }


    //script to select elective subjects with restrictions


    function electivesubjectselection() {
      let elec = document.getElementById('elec').value;
      //  console.log(elec);
      let elective = document.getElementsByName('elective[]')
      // console.log(core)
      let count = 0

      for (let index = 0; index < elective.length; index++) {
        if (elective[index].checked == true) {
          count = count + 1
        }

        if (elective[index].checked == false && count >= 0) {
          count - 1
        }
      }

      // console.log(count)

      if (count == elec) {
        for (let index = 0; index < elective.length; index++) {
          if (elective[index].checked == false) {
            elective[index].setAttribute('disabled', true)
          }
        }
      }

      if (count < elec) {
        for (let index = 0; index < elective.length; index++) {
          if (elective[index].checked == false) {
            elective[index].removeAttribute('disabled')
          }
        }
      }

    }


    window.history.forward();

    function noBack() {
      window.history.forward();
    }
  </script>


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
</body>

</html>