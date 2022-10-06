<?php
require('../Export/Excel.php');
include '../connection.php';


$query = "SELECT * FROM user_register WHERE role ='student'";
$query_run = mysqli_query($conn,$query) or die(mysqli_error($conn));


if(mysqli_num_rows($query_run)>0){
	$k=0;
	$count=1;

	while($row=mysqli_fetch_assoc($query_run)){

	
$ab='Verified';
		$data[$k]['Sr No.']=$count;
		$data[$k]['User ID']=$row['user_id'];
		$data[$k]['PRN']=$row['username'];
		$data[$k]['Name']=$row['name'];
		$data[$k]['Email ID']=$row['email_id'];
		$data[$k]['Contact ID']=$row['contact_number'];
		$data[$k]['Status']= $ab;
		$k++;
		$count++;
	}
}else{
	echo "Data not found";
}

$excel=new excel();

$file_name= 'user_register'.date('d-m-Y').'.xlsx';
$excel->userDefinedstream($file_name,$data);
?>