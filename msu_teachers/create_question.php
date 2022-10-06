<!DOCTYPE html>
<?php
include "../partials/connection.php";

if (!isset($_GET['subject_name'])) {

    header('Location: ' . $_SERVER['PHP_SELF']);
    die;
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sidebar.css">
    <!-- <link rel="stylesheet" href="../css//all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- bootstrap 4 required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <title>QUESTIONS</title>

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'poppins', sans-serif;
        }



        body {
            font-family: 'Poppins', sans-serif;


        }

        .container {
            min-height: 433px;

        }

        .jumbotron span {
            color: #263847;
        }

        .jumbotron textarea {
            height: 80px;
        }

        #inputGroup-sizing-lg {
            width: 180px;
            height: 80px;
            font-size: 20px;
        }




        @media screen and (max-width: 767px) {
            #inputGroup-sizing-lg {
                width: 120px;
                height: 50px;
                font-size: 12px;

            }

            .jumbotron textarea {
                height: 50px;
            }

            .upload-btn-wrapper {
                position: relative;
                overflow: hidden;
                display: inline-block;
            }

            .btn {
                border: 2px solid gray;
                color: gray;
                background-color: white;
                padding: 8px 20px;
                border-radius: 8px;
                font-size: 20px;
                font-weight: bold;
            }

            .upload-btn-wrapper input[type=file] {
                font-size: 100px;
                position: absolute;
                left: 0;
                top: 0;
                opacity: 0;
            }
        }
    </style>




</head>

<body>
    <?php include 'teacher_header.php'  ?>
    <div class="content-container">

    <?php include 'top_navbar.php'; ?>
        <div class="container my-4">

            <div class="jumbotron">
                <?php 
                $sub_name=$_GET['subject_name'];
                $subject=mysqli_query($conn,"SELECT * FROM subject_register WHERE `subject_name`='$sub_name'");
                $res=mysqli_fetch_assoc($subject);
                $subject_id=$res['subject_id'];
                
                $sql1=mysqli_query($conn,"SELECT * FROM question_list WHERE `subject_id`='$subject_id'");
                $res2=mysqli_num_rows($sql1);
                $qu=$res2+1;
                echo '<h6  style="color:gray; font-weight:600; float: right;">TOTAL QUESTIONS INSERTED: <span style="font-size:20px;">'. $res2.' </span></h6>';
                ?>

                <h2 style="text-transform:uppercase;"><?php echo $_GET['subject_name']; ?></h2>


                <br>
                <hr class="my-4" style="height:5px; color:black;">

                <form method="post" enctype="multipart/form-data" action="../partials/Import/excelsheet.php">


                    <label class="badge badge-secondary">Upload Question Through Excel</label><label style="color:gray;">[ FORMAT OF EXCEL : Question / option-1/ option-2/ option-3/ option-4/ Correct option/ unit name/ subject name/ Level/ Blooms taxonomy ]</label>
                    <br>
                    <input type="file" name="doc" required />
                    <input type="submit" name="submit" class="btn btn-secondary" />
                </form>


                <hr class="my-4" style="height:5px; color:black;">

                <!-- <form action="create_question_handler.php" class="login" method="POST"> -->
                <form id="register" enctype="multipart/form-data">

                    <?php
                    $subject_name = $_GET['subject_name'];
                    $qu = "SELECT * FROM subject_register WHERE `subject_name`='$subject_name'";
                    $re = mysqli_query($conn, $qu);
                    $r = mysqli_fetch_assoc($re);
                    $sub = $r['subject_id'];

                    ?>
                    <input type="hidden" name="subject_id" value="<?php echo $sub; ?>" />


                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <select list="topi_name" class=" topic form-control" id="topic_name" name="topic_name" required>
                                <datalist id="topi_name">
                                    <option value="" disabled selected hidden>Choose Topic Name</option>
                                    <?php

                                    $abc = "SELECT * FROM subject_topic_list WHERE subject_id=$sub";
                                    $result = mysqli_query($conn, $abc);
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<option value="' . $row['topic_id'] . '">' . $row['topic_name'] . '</option>';
                                    }

                                    ?>
                                </datalist>
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="form-row ">
                        Insert Question as a :
                        <label class="form-check-label mx-4">
                            <input type="radio" class="form-check-input" name="question_radio" id="text_radio" required checked>Text
                        </label>
                        <label class="form-check-label mx-3">
                            <input type="radio" class="form-check-input" name="question_radio" id="image_radio" required>Image
                        </label>
                    </div>
                    <br>




                    <!-- Add Question -->
                    <div class="input-group input-group-lg question_text">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ADD QUESTION</span>
                        </div>
                        <textarea type="text" name="question_desc" id="question_desc" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" required></textarea>
                    </div>




                    <!-- Add Image -->
                    <div class="input-group mb-3 question_image" style="margin-top: 20px;" hidden>
                        <label class="input-group-text" for="inputGroupFile01">Upload Question Image</label>
                        <input type="file" class="form-control" id="image" name='image'>
                    </div>

                    <hr class="my-4" style="height:5px; color:black;">



                    <LABEl> Difficulty Level </LABEl>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <select list="diff_id" name="diff_level" class=" difficulty form-control" id="diff_level" required>
                                <datalist id="diff_id">
                                    <option value="" disabled selected hidden>Choose Difficulty Level</option>
                                    <?php

                                    $abc = "SELECT * FROM difficulty_level";
                                    $result = mysqli_query($conn, $abc);
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<option value="' . $row['difficulty_id'] . '">' . $row['level_name'] . '</option>';
                                    }

                                    ?>
                                </datalist>
                            </select>
                        </div>
                    </div>

                    <hr class="my-4" style="height:5px; color:black;">


                    <LABEl>Bloom's Taxonomy</LABEl>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <select list="blo_id" name="bloom_tex" class=" blooms form-control" id="bloom_tex" required>
                                <datalist id="blo_id">

                                    <option value="" disabled selected hidden>Choose Blooms Taxonomy Level</option>
                                    <?php

                                    $abc = "SELECT * FROM blooms_texonomy";
                                    $result = mysqli_query($conn, $abc);
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<option value="' . $row['blooms_id'] . '">' . $row['description'] . '</option>';
                                    }

                                    ?>
                                </datalist>
                            </select>
                        </div>
                    </div>

                    <hr class="my-4" style="height:5px; color:black;">

                    <!--For Options -->

                    <h4>Enter Options</h4>

                    <hr class="my-4" style="height:5px; color:black;">

                    <!-- 1 -->
                    <div class="input-group input-group-sm" style="width: 70%;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="op_2">Option 1</span>
                        </div>
                        <textarea type="text" class="form-control textarea" aria-label="Large" name="op_1" aria-describedby="inputGroup-sizing-sm" required></textarea>
                    </div>


                    <!-- Correct Answer -->

                    <div class="form-check" style="margin-left:80%;">
                        <input class="form-check-input" type="radio" name="correct_option" required>
                        <label class="form-check-label" for="exampleRadios1">
                            Correct Answer
                        </label>
                    </div>



                    <hr class="my-4" style="height:5px; color:black;">

                    <!-- 2 -->
                    <div class="input-group input-group-sm" style="width: 70%;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="op_2">Option 2</span>
                        </div>
                        <textarea type="text" class="form-control textarea" aria-label="Large" name="op_2" aria-describedby="inputGroup-sizing-sm" required></textarea>
                    </div>


                    <!-- Correct Answer -->

                    <div class="form-check" style="margin-left:80%;">
                        <input class="form-check-input" type="radio" name="correct_option" required>
                        <label class="form-check-label" for="exampleRadios1">
                            Correct Answer
                        </label>
                    </div>



                    <hr class="my-4" style="height:5px; color:black;">

                    <!-- 3 -->
                    <div class="input-group input-group-sm" style="width: 70%;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="op_3">Option 3</span>
                        </div>
                        <textarea type="text" class="form-control textarea" aria-label="Large" name="op_3" aria-describedby="inputGroup-sizing-sm" required></textarea>
                    </div>

                    <!-- Correct Answer -->

                    <div class="form-check" style="margin-left:80%;">
                        <input class="form-check-input" type="radio" name="correct_option" required>
                        <label class="form-check-label" for="exampleRadios1">
                            Correct Answer
                        </label>
                    </div>




                    <hr class="my-4" style="height:5px; color:black;">

                    <!-- 4 -->
                    <div class="input-group input-group-sm" style="width: 70%;">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="op_4">Option 4</span>
                        </div>
                        <textarea type="text" class="form-control textarea" aria-label="Large" name="op_4" aria-describedby="inputGroup-sizing-sm" required></textarea>
                    </div>
                    <!-- Correct Answer -->
                    <div class="form-check" style="margin-left:80%;">
                        <input class="form-check-input" type="radio" name="correct_option" required>
                        <label class="form-check-label" for="exampleRadios1">
                            Correct Answer
                        </label>
                    </div>







                    <center> <button type="submit" class="btn btn-outline-info" id="submit" onclick="formregistration()">SUBMIT</button> <span id="message"></span></center>



                </form>
            </div>


        </div>
        <?php include 'footer.php'  ?>
    </div>

    <script>
        //to assign value of textarea to radio button

        let radio = document.getElementsByName('correct_option')
        let texte = document.getElementsByClassName('textarea')



        for (let index = 0; index < texte.length; index++) {
            const element = texte[index];
            element.addEventListener('change', function() {
                radio[index].value = element.value

                // alert(radio[index].value)
            })
        }


        //question add as a image or text

        let image_radio = document.getElementById('image_radio')
        // console.log(image_radio);
        let image_div = document.getElementsByClassName('question_image')
        // console.log(image_div)
        let text_radio = document.getElementById('text_radio')
        // console.log(text_radio);
        let text_div = document.getElementsByClassName('question_text')
        // console.log(text_div)
        let question_desc = document.getElementById('question_desc')
        // console.log(question_desc)
        let image = document.getElementById('image')

        image_radio.addEventListener('click', function() {
            image_div[0].removeAttribute('hidden')
            text_div[0].setAttribute('hidden', true)
            image.setAttribute('required', true)
            question_desc.removeAttribute('required')
        })

        text_radio.addEventListener('click', function() {
            text_div[0].removeAttribute('hidden')
            image_div[0].setAttribute('hidden', true)
            image.removeAttribute('required')
            question_desc.setAttribute('required', true)
        })

        //ajax request to insert question without page reload
        function formregistration() {

            let registrationform = document.querySelector('#register');
            let message = document.querySelector('#message')
            let submit = document.querySelector('#submit')



            registrationform.addEventListener('submit', function() {

                submit.innerHTML = "Inserting"
            })

            let html = ""
            registrationform.onsubmit = async (e) => {
                e.preventDefault();

                let response = await fetch('create_question_handler.php', {
                    method: 'POST',
                    body: new FormData(registrationform)
                });

                res = await response.text();



                let success = "Question added Succesfully"
                let fail = "failed to add question"


                if (res == 1) {
                    html += `${success}`
                    message.innerHTML = html
                    message.style.color = "green"
                    submit.innerHTML = "Submit"
                    document.getElementById("register").reset();
                    text_div[0].removeAttribute('hidden')
                    image_div[0].setAttribute('hidden', true)
                    image.removeAttribute('required')
                    question_desc.setAttribute('required', true)

                }

                if (res == 0) {
                    html += `${fail}`
                    message.innerHTML = html
                    message.style.color = "red"
                    submit.innerHTML = "Try again"
                }



            }

        }
    </script>


</body>

</html>