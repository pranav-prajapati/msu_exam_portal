<?php
include '../partials/connection.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>










</head>

<body>

  <table id="msg" class="data my-3 table-bordered table table-hover text-center">


    <!-- fetch subject details -->
    <tbody id="msg">
      <?php
      $department = $_SESSION['department'];
      if (isset($_POST['year'])) {
        $request = $_POST['year'];
        $subject = "SELECT * FROM subject_register WHERE `year`='$request' AND department_id=$department";
        $query = mysqli_query($conn, $subject);
        $count = 1;
        while ($row = mysqli_fetch_assoc($query)) {

          echo '
 
    <tr id="' . htmlspecialchars($row['subject_id']) . '">
    <th scope="row">' . $count . '</th>
      <td style="text-transform: uppercase;" data-target="subject_name">' . htmlspecialchars($row['subject_name']) . '</td>
      <td style="text-transform: uppercase;" data-target="subject_category">' . htmlspecialchars($row['subject_category']) . '</td>
      <td style="text-transform: uppercase;" data-target="subject_code">' . htmlspecialchars($row['subject_code']) . '</td>
      <td data-target="credit">' . htmlspecialchars($row['credit']) . '</td>
      <td><a   class="active" data-role="update" data-id="' . htmlspecialchars($row['subject_id']) . '" role="button"  aria-pressed="true"><i class="fas fa-2x fa-pen-square" style="color: green; cursor:pointer; text-decoration:none"></i></a>
      <a href="#" class="delete-btn  active" role="button" data-id="' . htmlspecialchars($row['subject_id']) . '" aria-pressed="true"><i class="fas fa-2x fa-trash" style="color: red;"></i></a></td>
    </tr>';
          $count++;
        }
      }
      ?>

    </tbody>

  </table>


</html>