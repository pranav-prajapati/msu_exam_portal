<?php
include '../partials/connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../css/sidebar.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="../css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>



    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">



    <style>
        .container {
            min-height: 433px;

        }
    </style>
    <title>Exam Schedule</title>
</head>

<body>
    <?php include 's_admin_header.php'; ?>
    <div class="content-container">
        <?php
        include 'top_navbar.php';
        ?>

        <div class="container my-5">
            <div class="container">
                <h3 class="text-center">EXAM SCHEDULE</h3>

                <br>
                <center> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-plus"></i> SCHEDULE
                    </button></center>

                <table class="data my-3 table-bordered table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">NO.</th>
                            <th scope="col">SUBJECT NAME</th>
                            <th scope="col">DEPARTMENT</th>
                            <th scope="col">YEAR</th>
                            <th scope="col">DATE</th>
                            <th scope="col">TIME</th>
                            <th scope="col">DURATION</th>
                            <th scope="col">SLOT</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">ACTION</th>

                        </tr>
                    </thead>
                    <!-- fetch subject details -->
                    <tbody>
                        <?php



                        $unit = "SELECT * FROM examination_schedule";
                        $query = mysqli_query($conn, $unit);
                        $count = 1;

                        while ($row = mysqli_fetch_assoc($query)) {
                            $date = date_create($row['exam_date']);
                            $time = date_create($row['exam_time']);

                            $subname = $row['subject_id'];

                            $sub = "SELECT * FROM subject_register WHERE subject_id=$subname";
                            $query2 = mysqli_query($conn, $sub);
                            $row3 = mysqli_fetch_assoc($query2);

                            $department = $row3['department_id'];
                            $depart_name_sql = "SELECT * FROM `department` WHERE department_id=$department";
                            $department_name_result = mysqli_query($conn, $depart_name_sql);
                            $department_name_row = mysqli_fetch_assoc($department_name_result);

                            $department_name = $department_name_row['department_name'];
                        ?>

                            <tr id="<?php echo $row['examination_id'] ?>">
                                <th scope="row"><?php echo $count ?></th>





                                <td style="text-transform: uppercase;" data-target="subject_name">
                                    <?php echo htmlspecialchars($row3['subject_name']); ?></td>
                                <td style="text-transform: uppercase;" data-target="department_name"><label style="font-size: 12px; ">
                                        <?php echo htmlspecialchars($department_name); ?></td>
                                <td style="text-transform: uppercase;" data-target="year"><?php echo $row['year']; ?></td>
                                <td style="text-transform: uppercase;" data-target="date">
                                    <?php echo date_format($date, "d/m/Y"); ?></td>
                                <td style="text-transform: uppercase;" data-target="time">
                                    <?php echo date_format($time, "h:i a");  ?></td>
                                <td style="text-transform: uppercase;" data-target="minute">
                                    <?php echo htmlspecialchars($row['exam_duration']); ?> Minutes</td>
                                <td style="text-transform: uppercase;" data-target="slot"><?php echo $row['slot_id']; ?>
                                </td>
                                <td style="text-transform: uppercase;" data-target="status">


                                    <?php
                                    if ($row['exam_status'] === '1') {

                                        echo '<span data-toggle="modal" data-id="' . $row['examination_id'] . '" data-target="#exampleModal9" class="badge badge-success">ACTIVE</span>';
                                    } else {
                                        echo '<span class="badge badge-secondary" data-id="' . $row['examination_id'] . '">DEACTIVE</span>';
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
                        ?>

                    </tbody>

                </table>



            </div>
        </div>
        <?php
        include 'footer.php';
        ?>
    </div>
</body>

</html>


<!--ADD  Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD SCHEDULE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form method="POST" action="exam_schedule_handler.php"> -->
            <form id="register">
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-6">
                            <select id="department" name="department_id" class="form-control">
                                <option hidden selected disabled>SELECT DEPARTMENT</option>
                                <?php
                                $faculty = $_SESSION['faculty'];
                                $sql = mysqli_query($conn, "SELECT * FROM department WHERE `faculty_id`='$faculty'");
                                while ($de = mysqli_fetch_assoc($sql)) {
                                    echo '<option value="' . $de['department_id'] . '"> ' . $de['department_name'] . ' </option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select id="degree" class="form-control" name="degree_id" required>
                                <option value="" disabled selected>SELECT DEGREE</option>

                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-4">

                            <select id="year" class="form-control" name="year" required>
                                <option value="" disabled selected>Select Year</option>
                            </select>
                        </div>

                        <div class="form-group col-md-8">

                            <select id="subject" class="form-control" name="subject_name" required>
                                <option value="" disabled selected>SELECT SUBJECT</option>
                            </select>
                        </div>

                    </div>
                 

                    <div class="form-group">
                        <label>DATE</label>
                        <input class="form-control" name="date" type="date" placeholder="Enter Date" required>
                    </div>
                    <div class="form-group">
                        <label>TIME</label>
                        <input class="form-control" name="time" type="time" placeholder="Enter Time" required>
                    </div>

                    <div class="form-group">
                        <label>DURATION</label>
                        <input class="form-control" name="minute" type="text" placeholder="Enter total Minutes" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">SLOTS</label>
                        <select name="slot" class="form-control" required>

                            <?php

                            $abc2 = "SELECT * FROM slot_register";
                            $result2 = mysqli_query($conn, $abc2);
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $dt = new DateTime($row2['slot_time']);
                                echo '<option value="' . $row2['slot_id'] . '">' . $dt->format("h:i a") . '</option>';
                            }


                            ?>
                            
                        </select>
                    </div>




                </div>
                <div class="modal-footer">
                    <center> <button type="submit" id="submit" class="btn btn-primary" onclick="formregistration()">SUBMIT</button> </center><span id="message"></span>
                </div>
            </form>
        </div>
    </div>
</div>








<!--update Modal -->
<div id="update" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">UPDATE SCHEDULE</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>DATE</label>
                    <input class="form-control" name="date" id="date" type="date" placeholder="Enter Date" required>
                </div>
                <div class="form-group">
                    <label>TIME</label>
                    <input class="form-control" name="time" id="time" type="time" placeholder="Enter Time" required>
                </div>

                <div class="form-group">
                    <label>DURATION</label>
                    <input class="form-control" name="minute" id="minute" type="text" placeholder="Enter total Minutes" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">SLOTS</label>
                    <select name="slot" id="slot" class="form-control" required>

                        <?php

                        $abc2 = "SELECT * FROM slot_register";
                        $result2 = mysqli_query($conn, $abc2);
                        while ($row2 = mysqli_fetch_assoc($result2)) {
                            $dt = new DateTime($row2['slot_time']);
                            echo '<option value="' . $row2['slot_id'] . '">' . $dt->format("h:i a") . '</option>';
                        }

                        ?>

                    </select>
                </div>




                <input type="hidden" id="examination_id">


            </div>
            <div class="modal-footer">
                <a type="submit" id="save" class="btn btn-primary" data-dismiss="modal">Update</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>











<script>
    $(document).ready(function() {

        $('.data').DataTable({
            "lengthMenu": [10, 25, 50, 75, 100],
            dom: 'Blfrtip',
            buttons: [

                {
                    extend: 'excelHtml5',
                    text: '',
                    className: 'exc',
                    titleAttr: 'Excel'

                },
                {
                    extend: 'csvHtml5',
                    text: '',
                    className: 'cv',
                    titleAttr: 'CSV'
                },
                {
                    extend: 'pdfHtml5',
                    text: '',
                    className: 'pf',
                    titleAttr: 'PDF'
                }
            ]
        });
        $('.exc').attr("class", "fas p-2 fa-file-excel mx-2 btn-success");
        $('.pf').attr("class", "fas p-2 fa-file-pdf mx-2 btn-danger");
        $('.cv').attr("class", "fas p-2 fa-file-csv mx-2 btn-warning ");
    });
</script>

<script>
    //append value in input field
    $(document).ready(function() {
        $(document).on('click', 'a[data-role=update]', function() {
            var id = $(this).data('id');
            var subject_name = $('#' + id).children('td[data-target=subject_name]').text();
            var date = $('#' + id).children('td[data-target=date]').text();
            var time = $('#' + id).children('td[data-target=time]').text();
            var minute = $('#' + id).children('td[data-target=minute]').text();
            var slot = $('#' + id).children('td[data-target=slot]').text();



            $('#examination_id').val(id);
            $('#date').val(date);
            $('#time').val(time);
            $('#minute').val(minute);
            $('#slot').val(slot);


            $('#update').modal('toggle');


        });

        //update in database

        $('#save').click(function() {
            var id = $('#examination_id').val();

            var date = $('#date').val();
            var time = $('#time').val();
            var minute = $('#minute').val();
            var slot = $('#slot').val();



            $.ajax({

                url: 'exam_schedule_update.php',
                method: 'POST',
                data: {

                    id: id,
                    date: date,
                    time: time,
                    minute: minute,
                    slot: slot

                },
                success: function(response) {

                    if (response == 1) {


                        //update table UI

                        $('#' + id).children('td[data-target=date]').text(date);
                        $('#' + id).children('td[data-target=time]').text(time);
                        $('#' + id).children('td[data-target=minute]').text(minute);
                        $('#' + id).children('td[data-target=slot]').text(slot);
                    } else {

                    }

                }

            });
        });
    });


    //delete record

    $(document).on('click', '.delete-btn', function() {



        var scheduleId = $(this).data('id');
        var element = this;
        $.ajax({
            url: 'exam_schedule_delete.php',
            type: 'POST',
            data: {
                id: scheduleId
            },
            success: function(data) {
                if (data == 1) {
                    $(element).closest('tr').fadeOut();
                } else {
                    alert('Record Could not deleted');
                }
            }
        });

    });

    //ajax code to insert schedule details
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

            let response = await fetch('exam_schedule_handler.php', {
                method: 'POST',
                body: new FormData(registrationform)
            });

            res = await response.text();




            let exist = "Subject already scheduled"

            if (res == 1) {
                window.location.assign('../super_admin/exam_schedule.php')
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

</script>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        $("#department").change(function() {
            var department_id = $(this).val();
            $.ajax({
                url: "department_degree.php",
                method: "POST",
                data: {
                    department: department_id
                },
                success: function(data) {
                    $("#degree").html(data);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#degree").change(function() {
            var degree_name = $(this).val();
            $.ajax({
                url: "year_degree.php",
                method: "POST",
                data: {
                    degree: degree_name
                },
                success: function(data) {
                    $("#year").html(data);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#year").change(function() {
            var year = $(this).val();
            var department=$("#department").val();
            $.ajax({
                url: "subject_fetch.php",
                method: "POST",
                data: {
                    id: year,
                    department_id: department
                },
                success: function(data) {
                    $("#subject").html(data);
                    console.log(department)
                }
            });
        });
    });
</script>




<!--EXPORT CDNS-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>




<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>