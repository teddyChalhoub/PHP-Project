<?php
require_once '../vendor/autoload.php';
use App\Classes\Connection;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PDOException;

  $db = new Connection();
  $conn = $db->connect();


  $spreadSheet = new Spreadsheet();
  $sheet = $spreadSheet->getActiveSheet();

  try{
    $stmt = $conn->prepare("SELECT * FROM blogs ");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }catch(PDOException $e){
    echo "<br>" . $e->getMessage();
  }

  $timestamp = time();
  $filename = 'Export_excel_' . $timestamp . '.xls';

  header("Content-Type: application/xls");    
  header("Content-Disposition: attachment; filename=$filename");  
  header("Pragma: no-cache"); 
  header("Expires: 0");

  //Define the separator line
  $separator = "\t";

  //If our query returned rows
  if(!empty($rows)){
      
      //Dynamically print out the column names as the first row in the document.
      //This means that each Excel column will have a header.
      echo implode($separator, array_keys($rows[0])) . "\n";
      
      //Loop through the rows
      foreach($rows as $row){
          
          //Clean the data and remove any special characters that might conflict
          foreach($row as $k => $v){
              $row[$k] = str_replace($separator . "$", "", $row[$k]);
              $row[$k] = preg_replace("/\r\n|\n\r|\n|\r/", " ", $row[$k]);
              $row[$k] = preg_replace("/<[^>]*>/", "", $row[$k]);
              $row[$k] = trim($row[$k]);
          }
          
          //Implode and print the columns out using the 
          //$separator as the glue parameter
          echo implode($separator, $row) . "\n";
      }
  }
?>