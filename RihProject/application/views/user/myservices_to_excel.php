<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


// Set document properties
$objPHPExcel->getProperties()->setCreator("Services")
                             ->setLastModifiedBy("Service")
                             ->setTitle("Office 2007 XLSX Test Document")
                             ->setSubject("Office 2007 XLSX Test Document")
                             ->setDescription("Creacion para Office 2007 XLSX, generado via web.")
                             ->setKeywords("office 2007 openxml php")
                             ->setCategory("Resultado");



// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '#')
            ->setCellValue('B1', 'ID')            
            ->setCellValue('C1', 'ID Account')
            ->setCellValue('D1', 'ID Service')
            ->setCellValue('E1', 'Status')
            ->setCellValue('F1', 'Valuation')
            ->setCellValue('G1', 'Username')
            ->setCellValue('H1', 'Password')
            ->setCellValue('I1', 'Old Password')
            ->setCellValue('J1', 'Notes')
            ->setCellValue('K1', 'Times visited')
            ->setCellValue('L1', 'Created')
            ->setCellValue('M1', 'Last Visited')            
            ->setCellValue('N1', 'Last Changed Pwd');            
            /*->setCellValue('I2', 'Estado');*/

$style['cell'] = array( 
    'font' => array(
        'name' => 'Arial',
        'color' => array(
            'rgb' => '000000'
        )       
    )    
);
$style['cell_header'] = array( 
    'font' => array(
        'name' => 'Arial',
        'color' => array(
            'rgb' => '000000'
        ),
        'italic' => 'italic',
        'bold' => 'bold'
    )    
);

$style['border'] = array(
    'style' => PHPExcel_Style_Border::BORDER_THIN
);
$style['alignment'] =  array(
             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,                                
             'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
             'rotation'   => 0,
             'wrap'       => false
         );
// Misborderaneous glyphs, UTF-8
$number = 1;
$count = 1;
$mes = array(1 => 'Ene', 2 => 'Feb', 3=> 'Mar', 4 =>'Abr', 
            5 => 'May', 6 => 'Jun', 7 => 'Jul',8 => 'Ago',
            9 => 'Sep',10 => 'Oct',11 => 'Nov',12 => 'Dic');

//AUTOSIZE COLUMN
foreach(range('A','N') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
        ->setAutoSize(true);
}


$objPHPExcel->getActiveSheet()
->getStyle('G1:H5')
->applyFromArray($style['border']);
//HEADER
$totcols = 14;
for($i=0;$i<$totcols;$i++){
    $objPHPExcel->getActiveSheet()
    ->getStyleByColumnAndRow($i, $number)
    ->applyFromArray($style['cell_header']);
    
    $objPHPExcel->getActiveSheet()
    ->getStyleByColumnAndRow($i, $number)
    ->getAlignment()
    ->applyFromArray($style['alignment']);

    $objPHPExcel->getActiveSheet()
    ->getStyleByColumnAndRow($i, $number)
    ->getBorders()->getTop()
    ->applyFromArray($style['border']);
     $objPHPExcel->getActiveSheet()
    ->getStyleByColumnAndRow($i, $number)
    ->getBorders()->getBottom()
    ->applyFromArray($style['border']);
     $objPHPExcel->getActiveSheet()
    ->getStyleByColumnAndRow($i, $number)
    ->getBorders()->getLeft()
    ->applyFromArray($style['border']);
     $objPHPExcel->getActiveSheet()
    ->getStyleByColumnAndRow($i, $number)
    ->getBorders()->getRight()
    ->applyFromArray($style['border']);
}
    
         

//print_r($services);
/*ALL IN ONE
$objPHPExcel->getActiveSheet()
    ->fromArray(
        $services,   // The data to set
        NULL,           // Array values with this value will not be set
        'M3'            // Top left coordinate of the worksheet range where
                        //    we want to set these values (default is A1)
    );    
    */

$number++;

$thestats = array(
                '000' => array('Visible','Vulnerable','Asynchronous'),
                '001' => array('Visible','Vulnerable','Synchronous'),
                '010' => array('Visible','Protected','Asynchronous'),
                '011' => array('Visible','Protected','Synchronous'),
                '100' => array('Hidden','Vulnerable','Asynchronous'),
                '101' => array('Hidden','Vulnerable','Synchronous'),
                '110' => array('Hidden','Protected','Asynchronous'),
                '111' => array('Hidden','Protected','Synchronous')
            );
if($services != false){


    foreach ($services as $row){  

        $stats = $thestats[$row['status']];
         $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$number, $count++)
            ->setCellValue('B'.$number, $row['id'])        
            ->setCellValue('C'.$number, $row['idAcc'])
            ->setCellValue('D'.$number, $row['idServ'])
            ->setCellValue('E'.$number, $stats[0].' - '.$stats[1].' - '.$stats[2]) 
            ->setCellValue('F'.$number, $row['valuation'])
            ->setCellValue('G'.$number, $row['username'])
            ->setCellValue('H'.$number, $row['password'])
            ->setCellValue('I'.$number, $row['oldpassword'])
            ->setCellValue('J'.$number, $row['notes'])
            ->setCellValue('K'.$number, $row['times'])
            ->setCellValue('L'.$number, $row['created'])
            ->setCellValue('M'.$number, $row['lastVisited'])
            ->setCellValue('N'.$number, $row['lastChangedPwd']);
        
        
        for($i=0;$i<$totcols;$i++){
            $objPHPExcel->getActiveSheet()
            ->getStyleByColumnAndRow($i, $number)
            ->applyFromArray($style['cell']);
            
            $objPHPExcel->getActiveSheet()
            ->getStyleByColumnAndRow($i, $number)
            ->getAlignment()
            ->applyFromArray($style['alignment']);

            $objPHPExcel->getActiveSheet()
            ->getStyleByColumnAndRow($i, $number)
            ->getBorders()->getTop()
            ->applyFromArray($style['border']);
             $objPHPExcel->getActiveSheet()
            ->getStyleByColumnAndRow($i, $number)
            ->getBorders()->getBottom()
            ->applyFromArray($style['border']);
             $objPHPExcel->getActiveSheet()
            ->getStyleByColumnAndRow($i, $number)
            ->getBorders()->getLeft()
            ->applyFromArray($style['border']);
             $objPHPExcel->getActiveSheet()
            ->getStyleByColumnAndRow($i, $number)
            ->getBorders()->getRight()
            ->applyFromArray($style['border']);
        }
        
         
        $number = $number + 1;
    }
  
}



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Services Log');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Services.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>