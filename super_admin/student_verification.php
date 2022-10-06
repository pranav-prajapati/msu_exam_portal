<?php
include "../partials/connection.php";


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/sidebar.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script type="text/javascript" src="1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUDENT VERIFICATION</title>

    <style>
        /* status and edit link properties */
        .container {
            min-height: 433px;

        }

        .container thead {
            color: #263847;
            font-size: 12px;

        }

        .container td {

            font-size: 14px;

        }
    </style>

</head>

<body>

    <?php
    include 's_admin_header.php';
    ?>
    <div class="content-container">
        <?php
        include 'top_navbar.php';
        ?>

        <div class="container my-5">

            <!-- Table of student verification  -->
            <h3 class="text-center">STUDENTS VERIFICATION</h3>
            <!-- <form action="student_verification_handler.php" method="POST"> -->
            <!-- verify all button -->
            <a style="float:right;" href="student_list.php"><i class="fas fa-list"></i> STUDENT LIST</a> <br>
            <form id="verify_all">
                <?php
                $faculty = $_SESSION['faculty'];


                $sql1 = "SELECT * FROM `student_register` WHERE faculty_id=$faculty AND verification_status=0";
                $result1 = mysqli_query($conn, $sql1);
                $num = mysqli_num_rows($result1);
                if ($num > 0) {
                    echo '<button style="float:right; font-size:13px;" type="submit" name="verifyall" id="verifyall" class="btn my-2 btn-success active">VERIFY ALL</button>';
                } else {
                    echo '<button style="float:right; font-size:10px;" type="submit" name="verifyall" id="verifyall" class="btn my-2 btn-success active" disabled>ALL STUDENTS ARE VERIFIED <i class="far fa-check-circle"></i></button>';
                }

                ?>
            </form>

            <table id="msg" class="data my-3 table-bordered table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">PRN</th>
                        <th scope="col">STUDENT NAME</th>
                        <th scope="col">DEPARTMENT</th>
                        <th scope="col">YEAR</th>
                        <th scope="col">EMAIL-ID</th>
                        <th scope="col">CONTACT NO.</th>
                        <th scope="col">SUBJECTS</th>
                        <th scope="col">VERIFY</th>
                        <th scope="col">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT * FROM `student_register` WHERE faculty_id=$faculty";
                    $result = mysqli_query($conn, $sql);
                    $count = 1;

                    while ($row = mysqli_fetch_assoc($result)) {

                        $prn = $row['prn_number'];
                        $name = $row['student_name'];
                        $year = $row['year'];
                        $email = $row['email_id'];
                        $phone = $row['contact_number'];
                        $faculty = $row['faculty_id'];
                        $department = $row['department_id'];

                        $depart_name_sql = "SELECT * FROM `department` WHERE department_id=$department";
                        $department_name_result = mysqli_query($conn, $depart_name_sql);
                        $department_name_row = mysqli_fetch_assoc($department_name_result);

                        $department_name = $department_name_row['department_name'];

                        echo '
          <tr id="' . $prn . '">
          <form id="msg" class="student_verification">
          <input type="hidden" name="prn" value="' . $prn . '">
          <input type="hidden" name="name" value="' . $name . '">
          <input type="hidden" name="email" value="' . $email . '">
          <input type="hidden" name="phone" value="' . $phone . '">
          <input type="hidden" name="faculty" value="' . $faculty . '">
          <input type="hidden" name="department" value="' . $department . '">
          
          

          <th scope="row">' . $count . '</th>
          <td>' . htmlspecialchars($prn) . '</td>
          <td>' . htmlspecialchars($name) . '</td>
          <td><label style="font-size: 12px; ">' . htmlspecialchars($department_name) . '</td>
          <td>' . htmlspecialchars($year) . '</td>
          <td data-target="email">' . htmlspecialchars($email) . '</td>
          <td>' . htmlspecialchars($phone) . '</td>
          <td><select class="form-control">
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
                      <option disabled>' . htmlspecialchars($subject) . '</option>';
                            }
                        }

                        if ($row['verification_status'] == 1) {
                            echo '</select></td><td><button style="font-size:10px;" type="submit" name="submit" class="btn btn-success submit active" disabled>VERIFIED</button></td>
                <td><a href="#" class=" delete-btn  active" role="button" data-id="' . $prn . '" aria-pressed="true"><i class="fas fa-2x fa-trash" style="color: red;"></i></a></td>
                

                </tr>
                </form>
                ';
                        } else {
                            echo '</select></td><td><button  style="font-size:10px;" type="submit" name="submit" class="btn btn-success submit active">VERIFY</button></td>
                <td><a href="#" class=" delete-btn  active" role="button" data-id="' . $prn . '" aria-pressed="true"><i class="fas fa-2x fa-trash" style="color: red;"></i></a></td>
                

                </tr>
                </form>
                ';
                        }

                        $count++;
                    }
                    ?>

                </tbody>
            </table>

        </div>
        <?php
        include 'footer.php';
        ?>
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

    <!-- ajax script to verify individual student -->
    <script>
        let submit = document.querySelectorAll(".submit")
        let deletebtn = document.querySelectorAll(".delete")

        function formregistration() {


            let registrationform = document.querySelectorAll(".student_verification");
            // console.log(registrationform)
            // console.log(submit)

            registrationform.forEach((elem) => {
                // console.log(elem['submit'])
                elem.addEventListener('submit', function() {
                    elem['submit'].setAttribute("disabled", true)
                    elem['submit'].innerHTML = "Please Wait"
                })


                let html = ""
                elem.onsubmit = async (e) => {
                    e.preventDefault();

                    let response = await fetch("student_verification_handler.php", {
                        method: "POST",
                        body: new FormData(elem)
                    });
                    // console.log(elem)
                    let res = await response.text();



                    if (res == 1) {
                        elem['submit'].setAttribute('disabled', true)
                        elem['submit'].innerHTML = "VERIFIED"
                    }

                    if (res == 0) {
                        elem['submit'].removeAttribute("disabled")
                        elem['submit'].innerHTML = "Try again"
                    }

                }
            });
        }

        submit.forEach(element => {
            element.addEventListener('click', function() {

                formregistration()
                // console.log('clicked')

            })
        });

        //delete record

        $(document).on('click', '.delete-btn', function() {



            var studentId = $(this).data('id');
            var element = this;
            var email = $('#email').val();

            $.ajax({
                url: 'student_delete.php',
                type: 'POST',
                data: {
                    id: studentId,
                    email: email
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

    <!-- ajax script to verify all students -->

    <script>
        let verify_all = document.getElementById('verify_all')
        let verify_all_button = document.getElementById('verifyall')

        function verifyall() {

            verify_all.onsubmit = async (e) => {
                e.preventDefault();

                let response1 = await fetch("verify_all.php", {
                    method: "POST",
                    body: new FormData(verify_all)

                });
                // console.log(elem)
                let res1 = await response1.text();

                verify_all.addEventListener('submit', function() {

                })

                if (res1 != 'false') {
                    window.location.reload()
                }
            }
        }

        verify_all_button.addEventListener('click', function() {
            verifyall()

            verify_all_button.innerHTML = "Please Wait"
            verify_all_button.classList.add("disabled");
        })
    </script>

</body>

</html>


<!--EXPORT CDNS-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>




<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>