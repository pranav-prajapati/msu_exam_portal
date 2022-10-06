<?php
require('../Export/Excel.php');
include '../connection.php';

$id = $_GET['id'];



$query = "SELECT * FROM question_list WHERE `subject_id`='$id'";
$query_run = mysqli_query($conn, $query) or die(mysqli_error($conn));


if (mysqli_num_rows($query_run) > 0) {
	$k = 0;
	$count = 1;

	while ($row = mysqli_fetch_assoc($query_run)) {

		$topic_id = $row['topic_id'];
		$subject_id = $row['subject_id'];
		$level_id = $row['difficulty_level'];
		$blooms_id = $row['blooms_texonomy_level'];

		//topic
		$tn = mysqli_query($conn, "SELECT * FROM subject_topic_list WHERE `topic_id`='$topic_id'");
		$rox1 = mysqli_fetch_assoc($tn);
		$topic_name = $rox1['topic_name'];
		//subject
		$sn = mysqli_query($conn, "SELECT * FROM subject_register WHERE `subject_id`='$subject_id'");
		$rox2 = mysqli_fetch_assoc($sn);
		$subject_name = $rox2['subject_name'];
		//level
		$ln = mysqli_query($conn, "SELECT * FROM difficulty_level WHERE `difficulty_id`='$level_id'");
		$rox3 = mysqli_fetch_assoc($ln);
		$level_name = $rox3['level_name'];
		//blooms
		$de = mysqli_query($conn, "SELECT * FROM blooms_texonomy WHERE `blooms_id`='$blooms_id'");
		$rox4 = mysqli_fetch_assoc($de);
		$desc = $rox4['description'];



		$data[$k]['Sr No.'] = $count;
		$data[$k]['QUESTIONS '] = $row['question_description'];
		$data[$k]['OPTION-1'] = $row['option_1'];
		$data[$k]['OPTION-2'] = $row['option_2'];
		$data[$k]['OPTION-3'] = $row['option_3'];
		$data[$k]['OPTION-4'] = $row['option_4'];
		$data[$k]['ANSWER'] = $row['correct_option'];
		$data[$k]['TOPIC NAME'] = $topic_name;
		$data[$k]['SUNJECT NAME'] = $subject_name;
		$data[$k]['LEVEL'] = $level_name;
		$data[$k]['BLOOMS-TEXONOMY'] = $desc;


		$k++;
		$count++;
	}
} else {
	echo "Data not found";
}

$excel = new excel();

$file_name = 'question_list' . date('d-m-Y') . '.xlsx';
$excel->userDefinedstream($file_name, $data);
