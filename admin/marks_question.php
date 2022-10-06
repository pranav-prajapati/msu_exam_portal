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


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>



    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">


    <style>
    .container {
        min-height: 433px;

    }

    thead {
        color: #263847;
        font-size: 13px;
    }
    </style>
    <title>Question and Marks Details</title>
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <div class="content-container">
        <?php include 'top_navbar.php'; ?>
        <div class="container my-5">
            <div class="container">
                <h3 class="text-center">EXAM DETAILS</h3>

                <br>
                <center> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-plus"></i>ADD EXAM DETAILS
                    </button></center>

                <table class="data my-3 table-bordered table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">NO.</th>
                            <th scope="col">SUBJECT NAME</th>
                            <th scope="col">TOTAL QUESTION</th>
                            <th scope="col">EASY</th>
                            <th scope="col">INTERMEDIATE</th>
                            <th scope="col">HARD</th>
                            <th scope="col">EACH MARKS</th>
                            <th scope="col">TOTAL MARKS</th>
                            <th scope="col">EXAM STATUS</th>
                            <th scope="col">ACTION</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $department=$_SESSION['department'];
                        //fetches exam details
                        $unit = "SELECT * FROM marks_question WHERE department_id=$department";
                        $query = mysqli_query($conn, $unit);
                        $count = 1;

                        while ($row = mysqli_fetch_assoc($query)) {

                            $subname = $row['subject_id'];

                            //fetches subject details
                            $sub = "SELECT * FROM subject_register WHERE `subject_id`='$subname'";
                            $query2 = mysqli_query($conn, $sub);
                            $row3 = mysqli_fetch_assoc($query2);
                            $sub_id = $row3['subject_id'];

                            $staussql = "SELECT * FROM `examination_schedule` WHERE subject_id=$subname";
                            $statusresult = mysqli_query($conn, $staussql);

                            $statusrow = mysqli_fetch_assoc($statusresult);

                            echo'<tr id="'.$row['id'].'">
                            <th scope="row">'.$count.'</th>

                            <td style="text-transform: uppercase;" data-target="subject_name">
                                 '.htmlspecialchars($row3['subject_name']).'</td>

                            <td style="text-transform: uppercase;" data-target="total_question">
                                '.htmlspecialchars($row['total_question']).'</td>

                            <td style="text-transform: uppercase;" data-target="easy">'.htmlspecialchars($row['easy']).'</td>

                            <td style="text-transform: uppercase;" data-target="intermediate">
                                '.htmlspecialchars($row['intermediate']).'</td>

                            <td style="text-transform: uppercase;" data-target="hard">'.htmlspecialchars($row['hard']).'</td>

                            <td style="text-transform: uppercase;" data-target="each">'.htmlspecialchars($row['each_marks']).'
                            </td>

                            <td style="text-transform: uppercase;" data-target="total_marks">
                                '.htmlspecialchars($row['total_marks']).'</td>




                        <form action="marks_question_handler.php" method="POST">


                            <input type="hidden" name="subject" value="' . $sub_id . '">';

                            if ($statusrow['exam_status'] == 0) {
                                echo '<td style=" text-transform: uppercase;" data-target="start"><button style="font-size:13px;" type="submit"
                              name="start" class="btn btn-outline-success">START</button>
                              </td>';
                            } else {
                                echo '<td style="text-transform: uppercase;" data-target="cancel"><button type="submit"
                              name="cancel"  style="font-size:13px;" class="btn btn-outline-danger">CANCEL</button>
                              </td>';
                            }

                            echo '<td><a class="delete-btn" href="#" role="button"
                                    data-id="' . $row['id'] . '" aria-pressed="true">
                                    <i class="fas fa-2x fa-trash" style="color: red;"></i></a></td>
                        </tr>
                        </form>';


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


    <!--ADD  Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ADD </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- <form method="POST" action="marks_question_handler.php"> -->
                <form id="register">
                    <div class="modal-body">

                        <div class="form-group">
                            <label>SUBJECT NAME</label>
                            <select class="custom-select  mb-3" id="subject_name" name="subject_name"
                                class=" subname form-control" required>

                                <option disabled>Choose Subject</option>
                                <?php
                                 $sql=mysqli_query($conn,"SELECT * FROM examination_schedule");
                                 while($re=mysqli_fetch_array($sql)){
                                 $subject_id=$re['subject_id'];
 
                                $department = $_SESSION['department'];
                                $abc = "SELECT * FROM subject_register WHERE `subject_id`='$subject_id' AND `department_id`='$department'";
                                $result = mysqli_query($conn, $abc);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['subject_name'] . '" required>' . $row['subject_name'] . '</option>';
                                }
                            }
                                ?>

                            </select>


                        </div>
                        <div class="form-group">
                            <label>TOTAL NUMBER OF QUESTIONS</label>
                            <input class="form-control dynamic" name="total_question" id="total_question" type="number" required>
                        </div>
                        <div class="form-row" style=" border: 1px solid gray;  padding:10px; padding-bottom:5px;">
                            <span style="font-size: 15px; color:gray">ENTER NUMBER OF QUESTION ACCORDING THEIR
                                LEVELS</span>
                            <div class="form-group col-md-4 my-2">
                                <label>EASY</label>
                                <input class="form-control" name="easy" type="number" required>
                            </div>

                            <div class="form-group col-md-4 my-2">
                                <label>INTERMEDIATE</label>
                                <input class="form-control" name="intermediate" type="number" required>
                            </div>
                            <div class="form-group col-md-4 my-2">
                                <label>HARD</label>
                                <input class="form-control" name="hard" type="number" required>
                            </div>
                        </div>
                        <div class="form-row my-3">
                            <div class="col-md-5">
                                <label style="font-size: 13px;">MARKS OF EACH QUESTION</label>
                                <input class="form-control dynamic" name="each_marks" id="each_marks" type="number" required>
                            </div>
                            <div class="form-group col-md-7">
                                <label>TOTAL MARKS</label>
                                <input class="form-control" name="total_marks" id="total_marks" type="number" disabled required>
                            </div>
                        </div>
                        <hr>

                    </div>
                    <div class="modal-center mt-2">

                        <center><button type="submit" id="submit" class="btn btn-primary my-1 mb-2"
                                onclick="formregistration()">SAVE</button> <span id="message"></span></center>

                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
    //delete record

    $(document).on('click', '.delete-btn', function() {



        var queId = $(this).data('id');
        var element = this;
        $.ajax({
            url: 'marks_question_delete.php',
            type: 'POST',
            data: {
                id: queId
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
    </script>

    <script>
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

            let response = await fetch('marks_question_handler.php', {
                method: 'POST',
                body: new FormData(registrationform)
            });

            res = await response.text();




            let exist = "Exam details already inserted"

            if (res == 1) {
                window.location.assign('../admin/marks_question.php')
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

    // total marks according to each mark
    let dynamic1 = document.getElementById('total_question')
    let dynamic2 = document.getElementById('each_marks')

    let dynamic = document.querySelectorAll('.dynamic')

    dynamic.forEach(element => {
        element.addEventListener('input', function() {
            document.getElementById('total_marks').value = (dynamic1.value * dynamic2.value)
        })
    });
    </script>

    </script>





</body>

</html>


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


<!--EXPORT CDNS-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js">
</script>




<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>