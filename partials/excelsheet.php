<?php
include 'connection.php';


if(isset($_POST['submit'])){

    $extension=pathinfo($_FILES['doc']['name'],PATHINFO_EXTENSION);
    // echo $extension;

    if($extension=='xlsx'){
        require('PHPExcel/PHPExcel.php');
        require('PHPExcel/PHPExcel/IOFactory.php');
    
        $file=$_FILES['doc']['tmp_name'];
        // echo $file;
    
        $obj=PHPExcel_IOFactory::load($file);
        foreach($obj->getWorksheetIterator() as $sheet){
            $getHighestRow=$sheet->getHighestRow();
    
            for($i=0;$i<=$getHighestRow;$i++){
               $fullname=$sheet->getCellByColumnAndRow(0,$i)->getValue();
               $prn=$sheet->getCellByColumnAndRow(1,$i)->getValue();
               $email=$sheet->getCellByColumnAndRow(2,$i)->getValue();
               $phone=$sheet->getCellByColumnAndRow(3,$i)->getValue();
               $year=$sheet->getCellByColumnAndRow(4,$i)->getValue();
               $faculty=$sheet->getCellByColumnAndRow(5,$i)->getValue();
               $department=$sheet->getCellByColumnAndRow(6,$i)->getValue();
    
                if($fullname!=''){
                
                    $sql="INSERT INTO `student_register` (`student_name`, `prn_number`, `email_id`, `contact_number`, `year`, `faculty_name`, `department_name`) 
                    VALUES ('$fullname', '$prn', '$email', '$phone', '$year', '$faculty', '$department');";
                    $result=mysqli_query($conn,$sql);
                }
               
            }
                        if($result){
                            echo "record inserted succesfully";
                        }
                        else{
                            echo "not inserted".mysqli_error($conn);
                        }
    
          
        }
    }
    else{
        echo "invalid file format";
    }
}
    

?>

<form method="POST" enctype="multipart/form-data">
<input type="file" name="doc">
<input type="submit" name="submit">
</form>

