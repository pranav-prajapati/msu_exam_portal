<?php

include '../partials/connection.php';
?>

<html>

<head>
    <title>SUBJECT SELECTION</title>

    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- bootstrap 4 required -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#degree").change(function() {
                var degree_name = $(this).val();
                $.ajax({
                    url: "year_degree1.php",
                    method: "POST",
                    data: {
                        Degree: degree_name
                    },
                    success: function(data) {
                        $("#year").html(data);
                    }
                });
            });
        });
    </script>



</head>

<body>

    <?php
    include 's_admin_header.php';
    ?>
    <div class="content-container">
       
    <?php   include 'top_navbar.php'; ?>

        <div class="container my-5">



            <div class="jumbotron">
            <center> <h3 class="text-center">SUBJECT ALLOCATION</h3></center>
              
              <hr class="my-4">
              <center>  <label>[ The maximum number of subjets in each category to be selected ]</label></center>
                <div class="form-group">
                    <!--Form add subjects-->
                    <form id="register" method="POST" action="subject_selection_handler.php">
                        <div class="table-responsive">
                        
                            
                                <!--bca or msc it-->
                        <div class="form-group col-md-4">
                            <label for="inputState">Degree</label>
                            <select id="degree" class="form-control" name="degree" required>
                            <option   disabled hidden selected>SELECT DEGREE</option>
                                <?php

                                $abc = "SELECT * FROM degree ";
                                $result = mysqli_query($conn, $abc);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['degree_name'] . '">' . $row['degree_name'] . '</option>';
                                }

                                ?>

                            </select>
                        </div>
                       
                              
                                    <div class="form-group col-md-4">
                                        <select id="year" class="form-control" name="year" required>
                                            <option  disabled selected hidden>CHOOSE YEAR</option>
                                    

                                        </select>
                                    </div>
                               
                           
                                    
                                   <label for="inputState">CORE</label>  <input type="number" name="core"  placeholder="ENTER TOTAL NUMBER" class="form-control name_list" required>
                              
                                   <label for="inputState">FOUNDATION</label>   <input type="number" name="foundation"  placeholder="ENTER TOTAL NUMBER" class="form-control name_list" required>
                                   <label for="inputState">ELECTIVES</label>   <input type="number" name="elective"  placeholder="ENTER TOTAL NUMBER" class="form-control name_list" required>
                        
                            <center><input type="submit" name="submit" id="submit" class="my-3 btn btn-outline-info" value="SUBMIT" onclick="formregistration()" /></center>
                            <span id="message"></span>
                        </div>
                    </form>
                </div>
            </div>

        </div>
   
    

    <?php
    include 'footer.php';
    ?>
     </div>
</body>




</html>