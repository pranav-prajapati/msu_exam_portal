<?php
require('../Export/Excel.php');
include '../connection.php';


$query = "SELECT * FROM user_register WHERE role ='examiner'";
$query_run = mysqli_query($conn,$query) or die(mysqli_error($conn));


if(mysqli_num_rows($query_run)>0){
	$k=0;
	$count=1;

	while($row=mysqli_fetch_assoc($query_run)){


		$data[$k]['Sr No.']=$count;
		$data[$k]['User Name']=$row['username'];
		$data[$k]['Name']=$row['name'];
		$data[$k]['Email ID']=$row['email_id'];
		$data[$k]['Contact Number']=$row['contact_number'];

		
		$k++;
		$count++;
	}
}else{
	echo "Data not found";
}

$excel=new excel();

$file_name= 'examiner_list'.date('d-m-Y').'.xlsx';
$excel->userDefinedstream($file_name,$data);
?>