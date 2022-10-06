<?php include '../partials/connection.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>


    <table class="data my-3 table-bordered table table-hover text-center">

        <!-- fetch subject details -->
        <tbody id="msg">
            <?php

            $department = $_SESSION['department'];

            if (isset($_POST['year'])) {
                $request = $_POST['year'];
                $unit = "SELECT * FROM examination_schedule WHERE `year`='$request' AND department_id=$department";
                $query = mysqli_query($conn, $unit);
                $count = 1;

                while ($row = mysqli_fetch_assoc($query)) {
                    $date = date_create($row['exam_date']);
                    $time = date_create($row['exam_time']);

                    $subname = $row['subject_id'];


                    $sub = "SELECT subject_name FROM subject_register WHERE subject_id=$subname AND department_id=$department";
                    $query2 = mysqli_query($conn, $sub);
                    $row3 = mysqli_fetch_assoc($query2);
            ?>

                    <tr id="<?php echo $row['examination_id'] ?>">
                        <th scope="row"><?php echo $count ?></th>

                        <td style="text-transform: uppercase;" data-target="subject_name"><?php echo htmlspecialchars($row3['subject_name']); ?>
                        </td>
                        <td style="text-transform: uppercase;" data-target="year"><?php echo $row['year']; ?></td>
                        <td style="text-transform: uppercase;" data-target="date"><?php echo date_format($date, "d/m/Y"); ?>
                        </td>
                        <td style="text-transform: uppercase;" data-target="time"><?php echo date_format($time, "h:i a");  ?>
                        </td>
                        <td style="text-transform: uppercase;" data-target="minute"><?php echo htmlspecialchars($row['exam_duration']); ?> Minutes
                        </td>
                        <td style="text-transform: uppercase;" data-target="slot"><?php echo $row['slot_id']; ?></td>
                        <td style="text-transform: uppercase;" data-target="topic_name">


                            <?php
                            if ($row['exam_status'] === '1') {

                                echo '<span class="badge badge-success">ACTIVE</span>';
                            } else {
                                echo '<span class="badge badge-secondary">DEACTIVE</span>';
                            }

                            ?>


                        </td>


                        <td><a type="button" data-toggle="modal" data-target="#exampleModal2" data-role="update" data-id="<?php echo $row['examination_id'] ?>">
                                <i class="fas fa-2x fa-pen-square" style="color: green; cursor:pointer; text-decoration:none"></i>
                            </a><a class="delete-btn" role="button" data-id="<?php echo $row['examination_id'] ?>" aria-pressed="true">
                                <i class="fas fa-2x fa-trash" style="color: red; cursor:pointer;"></i></a></td>
                    </tr>

            <?php
                    $count++;
                }
            }
            ?>

        </tbody>

    </table>

</body>

</html>