<?php
include "../partials/connection.php";


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


if(isset($_POST['username'])){

    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $username=mysqli_real_escape_string($conn,$_POST['username']);
    $email_id=mysqli_real_escape_string($conn,$_POST['email_id']);
    $role=mysqli_real_escape_string($conn,$_POST['role']);
    $contact=mysqli_real_escape_string($conn,$_POST['contact']);
    $faculty=mysqli_real_escape_string($conn,$_POST['faculty']);
    $department=mysqli_real_escape_string($conn,$_POST['department']);
    $password=randomPassword();

    $hash=password_hash($password,PASSWORD_DEFAULT);

    
    $existsql="SELECT * FROM `user_register` WHERE username='$username' OR email_id='$email_id' ";
    $result=mysqli_query($conn,$existsql);

    $num=mysqli_num_rows($result);
    
    

    if($num > 0){
        echo 2;
    }
    else{

        $credentials=smtp_mailer($email_id,"login credentials for online exam portal","username : ".$username."<br>"."password : ".$password);


        if($credentials==1){

                    
            $sql2="INSERT INTO `user_register` (`username`, `name`,`password`,`role`, `email_id`, `contact_number`,`faculty_id`,`department_id`) 
            VALUES ('$username', '$name','$hash','$role', '$email_id', '$contact','$faculty','$department')";
            $result2=mysqli_query($conn,$sql2);

            foreach($_POST['activity'] as $activity){
    
        
                $insertsql="INSERT INTO `admin_activitity_mapping` (`activity_id`, `admin_id`) VALUES ('$activity', '$username')";
                $insertresult=mysqli_query($conn,$insertsql);
        
                
            }

            if($result2 || $insertresult){
                echo 1;
            }
           
        }

        else{
            echo 0;
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