<?php
session_start();
error_reporting(0);

$loggedin = $_SESSION['loggedin'];
$admin = $_SESSION['admin'];


if ($loggedin != true || $admin != true) {
  echo '<script> location.replace("/msu_exam_portal/index.php"); </script>';
}


?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="stylesheet" type="text/css" href="../css/admin_header.css"> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    .a {
      background-color: #34495E;
    }


    a {
      text-decoration: none;
      color: white;
    }

    a:hover {
      color: darkgrey;

    }


    ul {
      list-style-type: none;


    }


    li {
      padding-top: 10px;
      display: block;
      color: blue;
      text-align: center;
      float: left;
      text-decoration: none;
    }

    li h3 {
      color: white;
    }
  </style>
</head>

<body>
  <div class="a">
    <div class="row w-100 justify-content-center mb-1">
      <ul>
        <li> <img src="../image/msu.png" width="60" height="50" alt=""></li>
        <li>
          <h3 class="text-center card-title mx-3">THE MAHARAJA SAYAJIRAO UNIVERSITY OF BARODA</h3>
        </li>
      </ul>
    </div>
    <nav class="navbar navbar-expand-lg" style="background-color: #34495E;">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add_faculty.php">ADD FACULTY</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="subject.php">ADD SUBJECT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="subject_manage.php">SUBJECT MANAGEMENT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="student_verification.php">STUDENT VERIFICATION</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="exam_schedule.php">SCHEDULE EXAM</a>
          </li>
         
        <li id="icon"><a href=""><img src="/msu_exam_portal/image/user.png"></a></li>
        <li id="username"><a href=""></a></li> 
        </ul>
        
         <li class="nav-item">
            <a class="nav-link" href="#"><img src="/msu_exam_portal/image/user.png"><span  class="mx-2 my-2">Logged in as <?php echo $_SESSION['username'] ?></span></a>
          </li>
           <a href="cart.php"><img src="/msu_exam_portal/image/user.png" href="#" height="40" width="48" class="pt-2 pb-1 my-0 nav-link" alt="cart-icon" ></a> 
        <a class="nav-link btn btn-danger border-secondary text-center" href="/msu_exam_portal/partials/logouthandler.php">Logout</a>
      </div>
  </div>
  </nav>


</body>

</html> -->

<div class="sidebar-container">
  <div class="sidebar-logo">
  <img src="../image/book.png" class="img-fluid qimg" alt="Responsive image" style="width:180px; padding:0px 25px 10px 30px">
    <b style="font-family: Verdana, sans-serif; font-size:13px;" class="title">VI-BOH EXAM PORTAL</b>
    <br>

  </div>
  <ul class="sidebar-navigation">
    <li class="header">Navigation</li>
    <li>
      <a href="index.php">
        <i class="fa fa-home" aria-hidden="true"></i> HOMEPAGE
      </a>
    </li>


    <li class="header">VERIFICATIONS</li>
    <li>
      <a href="student_verification.php">
        <i class="fas fa-user-check " aria-hidden="true"></i> STUDENT VERIFICATION
      </a>
    </li>
    <li class="header">EXAMINATION</li>
    <li>
      <a href="exam_schedule.php">
      <i style="padding-right: 5px;" class="far fa-clock" aria-hidden="true"></i>EXAM SCHEDULE
      </a>
    </li>
    <li>
      <a href="marks_question.php">
      <i class="fas fa-info-circle"></i> EXAM DETAILS
      </a>
    </li>
    <li>
      <a href="subject_selection.php">
      <i class="fas fa-clipboard-list"></i> SUBJECT ALLOCATION
        </a>
    </li>

    <li class="header">MANAGE</li>
    <li>
      <a href="add_degree.php">
        <i class="fas fa-plus" aria-hidden="true"></i> ADD DEGREE
      </a>
    </li>
 
    <li>
      <a href="add_faculty.php">
        <i class="fas fa-plus" aria-hidden="true"></i> ADD FACULTY
      </a>
    </li>
    <li>
      <a href="subject.php">
        <i class="fas fa-plus" aria-hidden="true"></i> ADD SUBJECT
      </a>
    </li>
    <li>
      <a href="examiner_assigning.php">
        <i class="far fa-address-card" aria-hidden="true"></i> EXAMINER ASSIGN
      </a>
    </li>
    <li>
      <a href="subject_manage.php">
        <i class="fa fa-cog" aria-hidden="true"></i>MANAGE SUBJECTS
      </a>
    </li>



  </ul>
</div>