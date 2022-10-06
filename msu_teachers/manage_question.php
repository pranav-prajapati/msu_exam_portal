<?php
include '../partials/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <script src="../js/sweetalert.js"></script>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- bootstrap 4 required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">



    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MANAGE QUESTION</title>


    <style>
        .container {
            box-sizing: border-box;

            min-height: 448px;


        }

        th {
            font-size: 12px;
        }

        td {
            font-size: 10px;
            font-weight: 700;
        }
    </style>
</head>

<body>


    <?php
    include 'teacher_header.php';
    ?>
    <div class="content-container">
        <?php include 'top_navbar.php'; ?>
        <div class="container my-5" >
        <?php
        $sub = $_GET['subject_name']; ?>
            <!-- Table of student verification  -->
            <h4 style="text-transform:uppercase;" class="text-center"><?php echo $sub;  ?></h4>

            <?php
            $sub_name = $_GET['subject_name'];

            $sq = "SELECT * FROM subject_register WHERE `subject_name`='$sub_name'";
            $quec = mysqli_query($conn, $sq);
            $rowy = mysqli_fetch_assoc($quec);
            $s = $rowy['subject_id'];

            ?>

        
            <?php

            $examiner_code = $_SESSION['code'];
            $examiner_code;
            $query0 = "SELECT * FROM subject_examiner_mapping WHERE `examiner_role`='Paper Setter' AND examiner_code='$examiner_code'";
            $abc = mysqli_query($conn, $query0);
            while ($x = mysqli_fetch_assoc($abc)) {
                $sub_n = $x['subject_name'];

                if ($sub_n === $sub_name) {


                    echo '          <a type="button" href="create_question.php?subject_name=' . $sub_name . '" style="float:right; color: white;" class="btn my-2 btn-primary">ADD QUESTIONS</a>';
                }
            }

            ?>
            <table class="data my-3 table-bordered table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">QUESTIONS</th>
                        <th scope="col">LEVEL</th>
                        <th scope="col">OPTION-1</th>
                        <th scope="col">OPTION-2</th>
                        <th scope="col">OPTION-3</th>
                        <th scope="col">OPTION-4</th>
                        <th scope="col">ANSWER</th>
                        <th scope="col">ACTIONS</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    //subject 
                    $subject_name = $_GET['subject_name'];
                    $subj = "SELECT * FROM subject_register WHERE `subject_name`='$subject_name'";
                    $que = mysqli_query($conn, $subj);
                    $row0 = mysqli_fetch_assoc($que);
                    $subject_id = $row0['subject_id'];


                    //question
                    $subject = "SELECT * FROM question_list WHERE `subject_id`='$subject_id'";
                    $query = mysqli_query($conn, $subject);
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                        $dif_id = $row['difficulty_level'];

                        //difficulty_level
                        $d2 = "SELECT * FROM difficulty_level WHERE `difficulty_id`='$dif_id'";
                        $re2 = mysqli_query($conn, $d2);
                        $ro2 = mysqli_fetch_assoc($re2);

                    ?>

                        <?php
                        echo '
                            <tr id="' . $row['question_id'] . '">
                            <th scope="row">' . $count . '</th>';
                        if ($row['image/text'] == 'text') {
                            echo ' <td style="text-transform: uppercase;" data-target="question">' . htmlspecialchars($row['question_description']) . '</td>';
                        } else {
                            echo '<td style="text-transform: uppercase;" data-target="question"><img style="width: 200px;" src="' . $row['question_description'] . '"></td>';
                        }
                        echo '
                           
                            <td style="text-transform: uppercase;" data-target="level">' . htmlspecialchars($ro2['level_name']) . '</td>
                            <td style="text-transform: uppercase;" data-target="o1">' . htmlspecialchars($row['option_1']) . '</td>
                            <td style="text-transform: uppercase;" data-target="o2">' . htmlspecialchars($row['option_2']) . '</td>
                            <td style="text-transform: uppercase;" data-target="o3">' . htmlspecialchars($row['option_3']) . '</td>
                            <td style="text-transform: uppercase;" data-target="o4">' . htmlspecialchars($row['option_4']) . '</td>
                            <td style="text-transform: uppercase;" data-target="cop">' . htmlspecialchars($row['correct_option']) . '</td>';

                        if ($row['image/text'] == 'text') {
                            echo '<td><a class="active" data-role="update" data-id="' . $row['question_id'] . '"  aria-pressed="true"><i class="fas fa-2x fa-pen-square" style="color: green; cursor:pointer; text-decoration:none"></i></a>
                                <a href="#" class="delete-btn  active" role="button" data-id="' . $row['question_id'] . '" aria-pressed="true"><i class="fas fa-2x fa-trash" style="color: red;"></i></a>
                            </td></tr>';
                        } else {
                            echo '<td><a href="#" class="delete-btn  active" role="button" data-id="' . $row['question_id'] . '" aria-pressed="true"><i class="fas fa-2x fa-trash" style="color: red;"></i></a>
                                
                            </td></tr>';
                        }









                        ?>





                    <?php
                        $count++;
                    }
                    ?>

                </tbody>

            </table>

        </div>





        <div id="update" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                    </div>
                    <form>
                        <div class="modal-body">






                            <!-- Add Question -->
                            <div class="input-group input-group-lg question_text">
                                <div class="form-group">
                                    <label for="inputState">QUESTION</label>

                                    <textarea type="text" name="question" id="question" class="form-control" id="exampleFormControlTextarea1" cols="60" rows="3" required></textarea>
                                </div>
                            </div>






                            <div class="form-group">
                                <label for="inputState">LEVEL</label>
                                <select name="level" id="level" class="form-control">
                                    <?php
                                    $d3 = "SELECT * FROM difficulty_level";
                                    $re3 = mysqli_query($conn, $d3);
                                    while ($ro3 = mysqli_fetch_assoc($re3)) {
                                        echo ' <option style="text-transform: uppercase;" value="' . $ro3['level_name'] . '">' . $ro3['level_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>




                            <div class="form-group">
                                <label>OPTION-1</label>
                                <input class="form-control" name="op1" id="op1" type="text" placeholder="Default input">
                            </div>
                            <div class="form-group">
                                <label>OPTION-2</label>
                                <input class="form-control" name="op2" id="op2" type="text" placeholder="Default input">
                            </div>
                            <div class="form-group">
                                <label>OPTION-3</label>
                                <input class="form-control" name="op3" id="op3" type="text" placeholder="Default input">
                            </div>
                            <div class="form-group">
                                <label>OPTION-4</label>
                                <input class="form-control" name="op4" id="op4" type="text" placeholder="Default input">
                            </div>
                            <div class="form-group">
                                <label>ANSWER</label>
                                <input class="form-control" name="cop" id="cop" type="text" placeholder="Default input">
                            </div>

                            <?php
                            $sql = "SELECT * FROM question_list";
                            $ew = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($ew);
                            $question_id = $row['question_id'];

                            ?>
                            <input type="hidden" name="queId" id="queId" />
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update" id="save" class="btn btn-primary" data-dismiss="modal">Update</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>






        <?php include 'footer.php' ?>
    </div>

</body>


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
            var question = $('#' + id).children('td[data-target=question]').text();
            var level = $('#' + id).children('td[data-target=level]').text();
            var op1 = $('#' + id).children('td[data-target=o1]').text();
            var op2 = $('#' + id).children('td[data-target=o2]').text();
            var op3 = $('#' + id).children('td[data-target=o3]').text();
            var op4 = $('#' + id).children('td[data-target=o4]').text();
            var cop = $('#' + id).children('td[data-target=cop]').text();

            $('#question').val(question);
            $('#level').val(level);
            $('#op1').val(op1);
            $('#op2').val(op2);
            $('#op3').val(op3);
            $('#op4').val(op4);
            $('#cop').val(cop);
            $('#queId').val(id);
            $('#update').modal('toggle');


        });









        $('#save').click(function() {
            var id = $('#queId').val();
            var question = $('#question').val();

            var level = $('#level').val();
            var op1 = $('#op1').val();
            var op2 = $('#op2').val();
            var op3 = $('#op3').val();
            var op4 = $('#op4').val();
            var cop = $('#cop').val();

            $.ajax({

                url: 'question_update.php',
                method: 'POST',
                data: {
                    question: question,

                    level: level,
                    op1: op1,
                    op2: op2,
                    op3: op3,
                    op4: op4,
                    cop: cop,
                    id: id
                },
                success: function(response) {



                    //update table UI
                    $('#' + id).children('td[data-target=question]').text(question);
                    $('#' + id).children('td[data-target=level]').text(level);
                    $('#' + id).children('td[data-target=o1]').text(op1);
                    $('#' + id).children('td[data-target=o2]').text(op2);
                    $('#' + id).children('td[data-target=o3]').text(op3);
                    $('#' + id).children('td[data-target=o4]').text(op4);
                    $('#' + id).children('td[data-target=cop]').text(cop);





                }

            });
        });


        //delete record

        $(document).on('click', '.delete-btn', function() {



            var quId = $(this).data('id');
            var element = this;
            $.ajax({
                url: 'question_delete.php',
                type: 'POST',
                data: {
                    id: quId
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

    });
</script>



</html>




<!--EXPORT CDNS-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>




<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>