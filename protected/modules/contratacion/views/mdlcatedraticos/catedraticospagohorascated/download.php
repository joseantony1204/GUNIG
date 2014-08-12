<?php
$phpExcelPath = Yii::getPathOfAlias('ext.vendors.phpexcel');
spl_autoload_unregister(array('YiiBase','autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()
->setCreator("Talento Humano Uniguajira")
->setLastModifiedBy("Universidad De La Guajira")
->setTitle("Docentes catedraticos")
->setSubject("Docentes catedraticos")
->setDescription("Docentes catedraticos")
->setKeywords("Docentes catedraticos, uniguajira")
->setCategory("listado");


$styleArray = array(
  'font' => array(
    'bold' => true,
    ),
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
    ),
  'borders' => array(
    'top' => array(
     'style' => PHPExcel_Style_Border::BORDER_THIN,
      ),
    ),
  'fill' => array(
    'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
       'rotation' => 90,
        'startcolor' => array(
          'argb' => 'FFA0A0A0',
           ),
        'endcolor' => array(
         'argb' => 'FFFFFFFF',
         ),
      ),
 );

$styleArrayB = array(
  'borders' => array(
   'allborders' => array(
    'style' => PHPExcel_Style_Border::BORDER_THICK,
   'color' => array('argb' => '000000'),
   ),
  ),
);

$styleArrayBInt = array(
  'borders' => array(
   'allborders' => array(
    'style' => PHPExcel_Style_Border::BORDER_DASHED,
   'color' => array('argb' => '000000'),
   ),
  ),
);


/*MIENTRAS QUE EXISTAN FACULTADES CON CATEDRAS ASIGNADAS EN EL PERIODO ACTUAL
 POR CADA FACULTAD IMPRIME SUS RESPECIVAS CATEDRAS*/

$index =0;
$data = $Catedraticoscatedras->facultadesConCatedras();
foreach($data as $rows ){ 
 $objPHPExcel->createSheet();
 $objPHPExcel->setActiveSheetIndex($index)
 
 ->setCellValue('B1', 'UNIVERSIDAD DE LA GUAJIRA')
 ->setCellValue('B2', 'DIRECCION DE TALENTO HUMANO')
 ->setCellValue('B3', 'RELACION PAGO HORAS DOCENTES CATEDRATICOS ')
 ->setCellValue('B4', 'FACULTAD : '.$rows["FACU_NOMBRE"])
 ->setCellValue('B6', 'PERIODO : '.$rows["PEAC_NOMBRE"])
  
 ->setCellValue('B8', 'ITEM')
 ->setCellValue('C8', 'IDENTIFICACION') 
 ->setCellValue('D8', 'NOMBRES')
 ->setCellValue('E8', 'APELLIDOS')
 ->setCellValue('F8', 'CATEGORIA')
 ->setCellValue('G8', 'HORAS RESTANTES')
 ->setCellValue('H8', 'HORAS A PAGAR') 
 ->setCellValue('I8', 'PERIODO ACADEMICO');
 $objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
 $objPHPExcel->getActiveSheet()->getStyle('B8:I8')->applyFromArray($styleArrayB);

  $horas = $Catedraticoscatedras->reporteHorasLiqNomina($rows["FACU_ID"]);
  /*IMPRIMIENDO CATEDRAS DE LA FACULTAD*/
  $fxls=10;
  $item = 1;
  foreach($horas as $datosHoras){
   
   $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'I'.$fxls)->applyFromArray($styleArrayBInt); 
 	
   $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
   $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $datosHoras["PERS_IDENTIFICACION"]);
   $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $datosHoras["PENA_NOMBRES"]);
   $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $datosHoras["PENA_APELLIDOS"]); 
   $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $datosHoras["PENC_CATEGORIA"]); 
   $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $datosHoras["CPHC_HORASRESTANTES"]);
   $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $datosHoras["CPHC_HORASXPAGAR"]);
   $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $datosHoras["PEAC_ID"]);   
   $fxls++;
   $item ++;	
  }

   $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
   
   $objPHPExcel->getActiveSheet()->getStyle('C10:C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');  
  $objPHPExcel->getActiveSheet()->getStyle('G10:G'.$fxls)->getNumberFormat()->setFormatCode('#,##0');  
  $objPHPExcel->getActiveSheet()->getStyle('H10:H'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
   
   
   /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex($index);
   $Programas = substr($rows["FACU_NOMBRE"],0,13);
   $objPHPExcel->getActiveSheet()->setTitle("$Programas");
   $index++;
}   
 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
 //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
 $objWriter->save('HORAS_CATEDRAS_LIQUIDACION.xls'); 
 header('Content-Type: application/vnd.ms-excel');
 header('Content-Disposition: attachment;filename="HORAS_CATEDRAS_LIQUIDACION.xls"');
 header('Cache-Control: max-age=0');
 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
 $objWriter->save('php://output'); 
 exit;

 						

?>
