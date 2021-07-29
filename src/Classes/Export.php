<?php 
namespace App\Classes;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export{



public function exportData($data){

  $spreadSheet = new Spreadsheet();
  $sheet = $spreadSheet->getActiveSheet();
  
  $i = 1;
  
  while($row = $data){

    print_r($row);

    $sheet->setCellValue("A".$i,$row["title"]);
    $sheet->setCellValue("A".$i,$row["overview"]);
    $sheet->setCellValue("A".$i,$row["content"]);
    $sheet->setCellValue("A".$i,$row["created_at"]);
    $i++;
  }
  
  $writer = new Xlsx($spreadSheet);
  $writer->save('test.xlsx');
  echo "OK";

}


}
?>