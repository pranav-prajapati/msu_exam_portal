<?php
class Excel {
    private $excel;
    public function __construct() {
        require_once 'PHPExcel.php';
		$cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
		$cacheSettings = array( 'memoryCacheSize' => '25M');		
		PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
        $this->excel = new PHPExcel();
    }

    public function load($path) {
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        $this->excel = $objReader->load($path);
    }

    public function save($path) {
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        $objWriter->save($path);
    }

   public function userDefinedstream($filename, $data = null) {

		
       if ($data != null) {
            $col = 'A';
            foreach ($data[0] as $key => $val) {
                $objRichText = new PHPExcel_RichText();
                $objPayable = $objRichText->createTextRun(str_replace("_", " ", $key));
                $this->excel->getActiveSheet()->getCell($col . '1')->setValue($objRichText);
                $col++;
            }
            $rowNumber = 2;
            foreach ($data as $row) {
                $col = 'A';
                foreach ($row as $cell) {
                    $this->excel->getActiveSheet()->setCellValue($col . $rowNumber, $cell);
                    $col++;
                }
                $rowNumber++;
            }
        }

       header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
       header("Content-Disposition: attachment; filename=\"" . $filename . "\"");
       header("Cache-control: private");
	   $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
       $objWriter->save('php://output');
    }

    public function __call($name, $arguments) {
        if (method_exists($this->excel, $name)) {
            return call_user_func_array(array($this->excel, $name), $arguments);
        }
        return null;
    }
}
?>