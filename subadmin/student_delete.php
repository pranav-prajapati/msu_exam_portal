<?php 
include '../partials/connection.php';
session_start();

if(isset($_POST['id'])){
	$prn=$_POST['id'];
	$department=$_SESSION['department'];
	$select="SELECT * FROM `student_register` WHERE prn_number=$prn";
	$selectresult=mysqli_query($conn,$select);
	
	$row=mysqli_fetch_assoc($selectresult);
	
	$email=$row['email_id'];
	$verification= $row['verification_status'];
	
	if($verification==0){
		$credentials=smtp_mailer($email,"verification Denied","You have to signup again...please provide valid details!!!");
	
		if($credentials==1){
			$sql= "DELETE FROM student_register WHERE prn_number = {$prn}";
			$result= mysqli_query($conn,$sql);
		
			$deletestudent="DELETE from subject_student_mapping WHERE student_id = $prn";
			$deleteresult=mysqli_query($conn,$deletestudent);
		}
		
	}
	else{
		$sql= "DELETE FROM student_register WHERE prn_number = {$prn}";
		$result= mysqli_query($conn,$sql);
	
		$deletestudent="DELETE from subject_student_mapping WHERE student_id = $prn";
		$deleteresult=mysqli_query($conn,$deletestudent);
	}
	
	
	if($result && $deleteresult){
		echo 1;
	
	}else{
		echo 0;
	}
}

if(isset($_POST['prn'])){

	$username=$_POST['prn'];
	$department=$_SESSION['department'];	

			$sql= "DELETE FROM student_register WHERE prn_number = '$username'";
			$result= mysqli_query($conn,$sql);
		
			$deletestudent="DELETE from subject_student_mapping WHERE student_id = '$username'";
			$deleteresult=mysqli_query($conn,$deletestudent);
		
			$sql2= "DELETE FROM `user_register` WHERE `username` = '$username'";
			$result2= mysqli_query($conn,$sql2);

			$sql3= "DELETE FROM `answer_student_mapping` WHERE `student_id` = '$username'";
			$result3= mysqli_query($conn,$sql3);
	
			$sql4= "DELETE FROM `student_images` WHERE `prn` = '$username'";
			$result4= mysqli_query($conn,$sql4);

			$sql5= "DELETE FROM `block_list` WHERE `student_id` = '$username'";
			$result5= mysqli_query($conn,$sql5);

			
	
	if($result && $deleteresult && $result2 && $result3 && $result4 && $result5){
		echo 1;
	
	}else{
		echo 0;
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