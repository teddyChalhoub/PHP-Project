<?php
require_once '../vendor/autoload.php';

use App\Classes\Connection;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

  $db = new Connection();
  $conn = $db->connect();

  $spreadSheet = new Spreadsheet();
  $sheet = $spreadSheet->getActiveSheet();

  try{
    $stmt = $conn->prepare("SELECT * FROM blogs ");
    $stmt->execute();
  }catch(PDOException $e){
    echo "<br>" . $e->getMessage();
  }
  

  $sheet->setCellValue("A1","title");
  $sheet->setCellValue("B1","overview");
  $sheet->setCellValue("C1","content");
  $sheet->setCellValue("D1","created_at");

 

  while($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){

    $i = 2;
    foreach($row as $line){    

      $line["content"] = strip_tags($line["content"]);
      $line["content"] = html_entity_decode($line["content"]);

      $sheet->setCellValue("A".$i,$line["title"]);
      $sheet->setCellValue("B".$i,$line["overview"]);
      $sheet->setCellValue("C".$i,$line["content"]);
      $sheet->setCellValue("D".$i,$line["created_at"]);
      $i++;
    }
 
  }

  $timestamp = time();
  $filename = 'Export_excel_' . $timestamp . '.xls';

  $writer = new Xlsx($spreadSheet);

  $writer->save($filename);

  header('Content-Type: application/x-www-form-urlencoded');

  header('Content-Transfer-Encoding: Binary');

  header("Content-disposition: attachment; filename=\"".urlencode($filename)."\"");

  readfile($filename);

  unlink($filename);

  exit;

?>