<?php
include '../connection.php';


if (isset($_POST['submit'])) {
	$file = $_FILES['doc']['tmp_name'];

	$ext = pathinfo($_FILES['doc']['name'], PATHINFO_EXTENSION);
	if ($ext == 'xlsx') {
		require('../Import/PHPExcel/PHPExcel.php');
		require('../Import/PHPExcel/PHPExcel/IOFactory.php');


		$obj = PHPExcel_IOFactory::load($file);
		foreach ($obj->getWorksheetIterator() as $sheet) {
			$getHighestRow = $sheet->getHighestRow();
			for ($i = 1; $i <= $getHighestRow; $i++) {
				$question_description = $sheet->getCellByColumnAndRow(0, $i)->getValue();
				$option_1 = $sheet->getCellByColumnAndRow(1, $i)->getValue();
				$option_2 = $sheet->getCellByColumnAndRow(2, $i)->getValue();
				$option_3 = $sheet->getCellByColumnAndRow(3, $i)->getValue();
				$option_4 = $sheet->getCellByColumnAndRow(4, $i)->getValue();
				$correct_option = $sheet->getCellByColumnAndRow(5, $i)->getValue();
				$topic_name = $sheet->getCellByColumnAndRow(6, $i)->getValue();
				$subject_name = $sheet->getCellByColumnAndRow(7, $i)->getValue();
				$diff_name = $sheet->getCellByColumnAndRow(8, $i)->getValue();
				$desc = $sheet->getCellByColumnAndRow(9, $i)->getValue();


//topic sql
$topic="SELECT * FROM subject_topic_list WHERE `topic_name`= '$topic_name'";
$re1=mysqli_query($conn,$topic);
$row1=mysqli_fetch_assoc($re1);
$topic_id=$row1['topic_id'];

//subject sql
$subject="SELECT * FROM subject_register WHERE `subject_name`= '$subject_name'";
$re2=mysqli_query($conn,$subject);
$row2=mysqli_fetch_assoc($re2);
$subject_id=$row2['subject_id'];


//diff level
$diff="SELECT * FROM difficulty_level WHERE `level_name`= '$diff_name'";
$re3=mysqli_query($conn,$diff);
$row3=mysqli_fetch_assoc($re3);
$difficulty_level=$row3['difficulty_id'];


//blooms 
$bloom="SELECT * FROM blooms_texonomy WHERE `description`= '$desc'";
$re4=mysqli_query($conn,$bloom);
$row4=mysqli_fetch_assoc($re4);
$blooms_taxonomy_level=$row4['blooms_id'];






				if ($question_description != '') {
					$result = mysqli_query($conn, "INSERT INTO question_list(`question_description`,`image/text`,`option_1`,`option_2`,`option_3`,`option_4`,`correct_option`,`topic_id`,`subject_id`,`difficulty_level`,`blooms_texonomy_level`)
                    VALUES('$question_description','text','$option_1','$option_2','$option_3','$option_4','$correct_option','$topic_id','$subject_id','$difficulty_level','$blooms_taxonomy_level')");

					if ($result) {
						header("location:../../msu_teachers/index.php");
					} else {
						echo 0;
					}
				} else {
					echo 'wrong';
				}
			}
		}
	} else {
	
	}
}
