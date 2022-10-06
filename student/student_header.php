<?php
session_start();
error_reporting(0);

$loggedin = $_SESSION['loggedin'];
$student = $_SESSION['student'];


if ($loggedin != true || $student != true) {
    echo '<script> location.replace("/msu_exam_portal/index.php"); </script>';
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<style>
    nav {
        background-color: #34495E;
        color: white;
    }

    .but a {
         margin-left: 10px;
        }
        li a {
            margin-left: 50px;
           color:#FFD700;
          
            font-size: 15px;
        }

    @media screen and (max-width: 991px) {
      

        li a {
            margin-left: 0px;
           
            font-size: 15px;
        }
        .but a {
         margin-left: 0px;
         padding-right:50px;
         padding-left:50px;

        }
        .float-lg-right {
           
           font-size: 15px;
        
       }
      
    }

    @media screen and (max-width: 548px) {


        li a {
          
           
            font-size: 12px;
        }

        .float-lg-right {
           
            font-size: 12px;
         
        }

        .but a {
         margin-left: 0px;
         padding-right:50px;
         padding-left:50px;
        }
    }
</style>

<body>

    <nav class="navbar navbar-expand-lg  navbar-light ">
    <h4 class="text-center">VI-BOH EXAM PORTAL</h4>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <br>
            <div class="navbar-nav  mr-auto">
                <li>
                    <a  style=" text-decoration:none;" href="index.php">DASHBOARD <span class="sr-only">(current)</span></a>
                </li>

            </div>
            <div class="float-lg-right">
                <form class="form-inline my-2 ">


                    <span><?php echo $_SESSION['uname'] . '-' . ucwords($_SESSION['username']) ?></span>
                    
                    

                </form>
                   
            </div>
            <div class="but">
            <a style="text-decoration:none; font-size :12px; cursor:pointer;" class="btn-sm btn-danger " href="../partials/logouthandler.php">
                        <i class="fa fa-power-off"></i> LOGOUT
                    </a>
            </div>
        </div>
    </nav>







    <!-- nav bar -->
    <!-- <nav class="ab navbar-expand-sm navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <center>
                <h4>VI-BOH EXAM PORTAL</h4>
            </center>

            <div class="links">
                <a href="">Dashboard</a>

                <div class="user">

                    <i class="fas fa-user-circle fa-lg"></i>
                    <label><?php echo $_SESSION['uname'] . '-' . ucwords($_SESSION['username']) ?></label>
                    <a style=" color: #ffffff;" class="btn-lg btn-danger mx-2" href="../partials/logouthandler.php">
                        <i class="fa fa-power-off"></i> LOGOUT
                    </a>
                </div>


            </div>

    </nav> -->


</body>

</html>