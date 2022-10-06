<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 <title>LOGIN</title>
  <link rel="stylesheet" href="css/main_index.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
  /* alert css */

.dangeralert {
    padding: 20px;
    background-color: #ff4d4d;
    color: white;
}

.successalert {
    padding: 20px;
    background-color: #009900;
    color: white;
}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
</style>
</head>

<body>
<?php
if(isset($_GET['signup'])&&$_GET['signup']=='success'){
  echo"
  <div class='successalert' style='background-color:#228B22; font-size:13px;' >
  <span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span> 
  <strong>You signed up successfully!</strong> Your Login Credentials will be sent via Email , Once Verified.
</div>";
}

if(isset($_GET['signup'])&&$_GET['signup']=='failed'){
  echo"
  <div class='dangeralert' style='background-color:	#A52A2A; font-size:13px;'>
  <span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span> 
  <strong>Failed!</strong> Your signup is failed...please Try Again!!!.
</div>";
}

if(isset($_GET['error'])&&$_GET['error']=='invalidcredentials'){
  echo"
  <div class='dangeralert' style='background-color:	#A52A2A; font-size:13px;'>
  <span class='closebtn' onclick='this.parentElement.style.display=`none`;'>&times;</span> 
  <strong>Invalid credentials!</strong> Please provide valid username and password.
</div>";
}




?>



  <div class="wrapper">
    <div class="title-text">
    
      <div class="title login">
          USER LOGIN </div>
      
    </div>
    <div class="form-container">
        
        <div class="slider-tab">
        </div>
      </div>

      <div class="form-inner">
        <!-- login -->
        <form action="partials/login_handler.php" method="POST" class="login">

          <div class="field">
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your Username" required>

          </div>

          <div class="field">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>

          </div>

          <input type="hidden" name="role" id="role">

          <!-- <div class="field">
          <select id="role" name="role" class="form-control my-2" required>
          <option value="" disabled selected hidden>Select your Role</option>
            <option value="student">Student</option>
            <option value="examiner">Examiner</option>
            <option value="admin">Admin</option>
            <option value="super_admin">SUPER ADMIN</option>
          </select>
        </div> -->
  
      


    <div class="field">
            <input style="width:40%" type="text" class="form-control my-0" id="captcha" name="captcha" placeholder="captcha" required> <img style="margin-left: 40px; width:70px;" src="./captcha/logincaptcha.php" alt="noo"/>
          
          </div>
         
      
          <div class="field btn">
            <div class="btn-layer">
            </div>
            <input type="submit" value="LOGIN">
          </div>
          <div class="signup-link">
            Not registered? <a href="partials/student_signup.php">Signup now</a></div>
        </form>


        
  </div>

 

</body>
<script>

// function for close button in alert
function remove(){

}
</script>
<!-- User role -->
<script type="text/javascript">
        $(document).ready(function() {
            $("#username").change(function() {
                var username = $(this).val();
                $.ajax({
                    url: "partials/username_role.php",
                    method: "POST",
                    data: {
                        username: username
                    },
                    success: function(data) {
                        $("#role").val(data);
                        // console.log(data)
                    }
                });
            });
        });
    </script>

</html>