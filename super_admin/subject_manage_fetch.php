<?php
include '../partials/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>










</head>

<body>

    <table class="data my-3 table-bordered table table-hover text-center">

      <!-- fetch subject details -->
      <tbody id="msg">
        <?php
        if(isset($_POST['year'])){
            $request=$_POST['year'];
        $subject = "SELECT * FROM subject_register WHERE `year`='$request'";
        $query = mysqli_query($conn, $subject);
        $count = 1;
        while ($row = mysqli_fetch_assoc($query)) {

          echo '
 
    <tr id="' . $row['subject_id'] . '">
    <th scope="row">' . $count . '</th>
      <td style="text-transform: uppercase;" data-target="subject_name">' . $row['subject_name'] . '</td>
      <td style="text-transform: uppercase;" data-target="subject_category">' . $row['subject_category'] . '</td>
      <td style="text-transform: uppercase;" data-target="subject_code">' . $row['subject_code'] . '</td>
      <td data-target="credit">' . $row['credit'] . '</td>
      <td><a   class="active" data-role="update" data-id="' . $row['subject_id'] . '" role="button"  aria-pressed="true"><i class="fas fa-2x fa-pen-square" style="color: green; cursor:pointer; text-decoration:none"></i></a>
      <a href="#" class="delete-btn  active" role="button" data-id="' . $row['subject_id'] . '" aria-pressed="true"><i class="fas fa-2x fa-trash" style="color: red;"></i></a></td>
    </tr>';
    $count++;
        }
    }
        ?>

      </tbody>

    </table>


</html>