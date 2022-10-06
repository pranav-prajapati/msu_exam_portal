<?php
include '../partials/connection.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

   

</head>

<body>


    <table  class="data my-3 table-bordered table table-hover text-center">
 
        <tbody id="msg">
            <?php
            if (isset($_POST['year'])) {
                $request = $_POST['year'];
                $department = $_SESSION['department'];
                $sql = "SELECT * FROM `student_register` WHERE department_id=$department AND `year`='$request'";
                $result = mysqli_query($conn, $sql);
                $count = 1;

                while ($row = mysqli_fetch_assoc($result)) {

                    $prn = $row['prn_number'];
                    $name = $row['student_name'];
                    $email = $row['email_id'];
                    $phone = $row['contact_number'];
                    $faculty = $row['faculty_id'];
                    $department = $row['department_id'];

                    echo '
          <tr id="' . $prn . '">
          <form class="student_verification">
          <input type="hidden" name="prn" value="' . $prn . '">
          <input type="hidden" name="name" value="' . $name . '">
          <input type="hidden" name="email" value="' . $email . '">
          <input type="hidden" name="phone" value="' . $phone . '">
          <input type="hidden" name="faculty" value="' . $faculty . '">
          <input type="hidden" name="department" value="' . $department . '">
          

          <th scope="row">' . $count . '</th>
          <td>' . $prn . '</td>
          <td>' . $name . '</td>
          <td data-target="email">' . $email . '</td>
          <td>' . $phone . '</td>
          <td><select id="inputState" class="form-control">
          <option value="" disabled selected hidden>View Subjects</option>';

                    $student_subject = "SELECT * FROM `subject_student_mapping` WHERE student_id=$prn";
                    $result1 = mysqli_query($conn, $student_subject);

                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $subject_id = $row1['subject_id'];

                        $subject_name = "SELECT * FROM `subject_register` WHERE subject_id=$subject_id ";
                        $result2 = mysqli_query($conn, $subject_name);

                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            $subject = $row2['subject_name'];
                            echo '
                      <option disabled>' . $subject . '</option>';
                        }
                    }

                    if ($row['verification_status'] == 1) {
                        echo '</select></td><td><button type="submit" name="submit" class="btn btn-success submit active" disabled>verified</button></td>
                <td><a href="#" class=" delete-btn  active" role="button" data-id="' . $prn . '" aria-pressed="true"><i class="fas fa-2x fa-trash" style="color: red;"></i></a></td>
                

                </tr>
                </form>
                ';
                    } else {
                        echo '</select></td><td><button type="submit" name="submit" class="btn btn-success submit active">VERIFY</button></td>
                <td><a href="#" class=" delete-btn  active" role="button" data-id="' . $prn . '" aria-pressed="true"><i class="fas fa-2x fa-trash" style="color: red;"></i></a></td>
                

                </tr>
                </form>
                ';
                    }

                    $count++;
                }
            }
            ?>
        </tbody>
    </table>





</body>

</html>