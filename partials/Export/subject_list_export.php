<?php
require('../Export/Excel.php');
include '../connection.php';


$query = "SELECT * FROM subject_register";
$query_run = mysqli_query($conn,$query) or die(mysqli_error($conn));


if(mysqli_num_rows($query_run)>0){
	$k=0;
	$count=1;
	while($row=mysqli_fetch_assoc($query_run)){
	

		$data[$k]['Sr No.']=$count;
		$data[$k]['Subject Name']=$row['subject_name'];
		$data[$k]['Category']=$row['subject_category'];
		$data[$k]['Subject Code']=$row['subject_code'];
		$data[$k]['Credit']=$row['credit'];
		$k++;
        $count++;
	}
}else{
	echo "Data not found";
}

$excel=new excel();
$file_name= 'subject_list'.date('d-m-Y').'.xlsx';
$excel->userDefinedstream($file_name,$data);
?>