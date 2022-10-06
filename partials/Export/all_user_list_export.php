<?php
require('../Export/Excel.php');
include '../connection.php';


$query = "SELECT * FROM user_register";
$query_run = mysqli_query($conn,$query) or die(mysqli_error($conn));


if(mysqli_num_rows($query_run)>0){
	$k=0;
	$count=1;
	while($row=mysqli_fetch_assoc($query_run)){
		$f_name=$row['faculty_id'];
		$d_name=$row['department_id'];

		$query2="SELECT faculty_name FROM faculty_register WHERE faculty_id = $f_name";
		$query_run2= mysqli_query($conn,$query2);
		$row2 = mysqli_fetch_assoc($query_run2);


		
		$query3="SELECT department_name FROM department WHERE department_id = $d_name";
		$query_run3= mysqli_query($conn,$query3);
		$row3 = mysqli_fetch_assoc($query_run3);

		$data[$k]['Sr No.']=$count;
		$data[$k]['Username']=$row['username'];
		$data[$k]['Name']=$row['name'];
		$data[$k]['Role']=$row['role'];
		$data[$k]['Email ID']=$row['email_id'];
		$data[$k]['Contact ID']=$row['contact_number'];
		$data[$k]['Department ID']=$row3['department_name'];
		$data[$k]['Faculty ID']=$row2['faculty_name'];
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