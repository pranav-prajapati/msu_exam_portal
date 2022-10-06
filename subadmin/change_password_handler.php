<?php


if($_SERVER['REQUEST_METHOD']=='POST'){
    session_start();
    include '../partials/connection.php';
    $email=$_POST['email'];
	$password=$_POST['password'];
    $username=$_POST['username'];
	
	$existsql="SELECT * FROM `user_register` WHERE email_id='$email' AND username='$username'";
    $result=mysqli_query($conn,$existsql);

    $num=mysqli_num_rows($result);
    
    

    if($num == 1){
		$otp=rand(111111,999999);
		$hash=password_hash($password,PASSWORD_DEFAULT);
	
		$user_confirm=smtp_mailer($email,"OTP to set new password","Your otp is : ".$otp);
	
		$_SESSION['updatemail']=$email;
		$_SESSION['updatepassword']=$hash;
		$_SESSION['updateotp']=$otp;
        $_SESSION['updateuname']=$username;

		if($user_confirm === 1){
            echo 1;
        }
        else{
            echo 0;
        }
	}
	else{
		echo 2;
	}

   
}

function smtp_mailer($to,$subject, $msg){
	require_once("../partials/smtp/class.phpmailer.php");
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPDebug = 0; 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'ssl'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "msudca.6b@gmail.com";
	$mail->Password = "nilu2711";
	$mail->SetFrom("msudca.6b@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	if(!$mail->Send()){
		return "Mailer Error: " . $mail->ErrorInfo;
	}else{
		return 1;
	}
}



?>