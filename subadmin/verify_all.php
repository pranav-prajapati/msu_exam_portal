<?php

include "../partials/connection.php";

if($_SERVER['REQUEST_METHOD']=='POST'){

    session_start();

    function randomPassword() {
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    
    $department = $_SESSION['department'];
    $sql1 = "SELECT * FROM `student_register` WHERE department_id=$department AND verification_status=0";
    $result1 = mysqli_query($conn,$sql1);
    $num=mysqli_num_rows($result1);

    $success=false;

    if($num>0){
        while($row=mysqli_fetch_assoc($result1)){
            $prn = $row['prn_number'];
            $name = $row['student_name'];
            $email = $row['email_id'];
            $phone = $row['contact_number'];
            $faculty = $row['faculty_id'];
            $department = $row['department_id'];
            $password=randomPassword();
    
            $hash=password_hash($password,PASSWORD_DEFAULT);
    
            $credentials=smtp_mailer($email,"username and password for your online exam","username : ".$prn."<br>"."password : ".$password);
    
            if($credentials==1){
    
                $sql="INSERT INTO `user_register` (`username`, `name`, `password`, `role`, `email_id`, `contact_number`, `department_id`, `faculty_id`) VALUES ('$prn', '$name', '$hash', 'student', '$email', '$phone', '$department', '$faculty')";
    
                $result=mysqli_query($conn,$sql);
    
                $verificationstatus="UPDATE `student_register` SET `verification_status` = '1' WHERE `student_register`.`prn_number` = $prn;
                ";
    
                $verificationstatusresult=mysqli_query($conn,$verificationstatus);
    
                if($result && $verificationstatusresult){
                   $success=true;
                }
            }
            
        }
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