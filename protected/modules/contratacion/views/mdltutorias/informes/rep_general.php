<?php
$phpExcelPath = Yii::getPathOfAlias('ext.vendors.phpexcel');
spl_autoload_unregister(array('YiiBase','autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()
					->setCreator("ING. JOSE ANTONIO GONZALEZ LIÑAN")
					->setLastModifiedBy("ING. JOSE ANTONIO GONZALEZ LIÑAN")
					->setTitle("REPORTE CONTRALORIA")
					->setSubject("REPORTE")
					->setDescription("REPORTE")
					->setKeywords("REPORTE, CONTRALORIA")
					->setCategory("CONTRATACION");
					

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

$index = 0; 
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'UNIVERSIDAD DE LA GUAJIRA')
								 ->setCellValue('B2', 'DIRECCION DE TALENTO HUMANO')
								 ->setCellValue('B3', 'RELACION ORDENES DE PRESTACION DE SERVICIOS')
								 ->setCellValue('B6', 'PERIODO : ')
								  
								 ->setCellValue('B8', 'ITEM')
								 ->setCellValue('C8', 'NUM. ORDEN')
								 ->setCellValue('D8', 'IDENTIFICACION') 
								 ->setCellValue('E8', 'APELLIDOS')
								 ->setCellValue('F8', 'NOMBRES')
								 ->setCellValue('G8', 'PROGRAMA')
								 ->setCellValue('H8', 'VALOR HORA') 
								 ->setCellValue('I8', 'TOTAL HORAS')
								 ->setCellValue('J8', 'VALOR TOTAL')
								 ->setCellValue('K8', 'VALOR CON 4XMIL')
								 ->setCellValue('L8', 'OBJETO')
								 ->setCellValue('M8', 'N. CERTIFICADO')
								 ->setCellValue('N8', 'F. VIGENCIA')
								 ->setCellValue('O8', 'DESCRIPCION')
								 ->setCellValue('P8', 'MONTO');
					
$fxls=10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:P8')->applyFromArray($styleArrayB);

$valorContrato = 0; $valorContrato4xMil = 0;
foreach($registros as $data){
 /*
 $criteria = new CDbCriteria;
 $criteria->condition = 'DEPE_ID = '.$data["DEPE_ID"];
 $criteria->order = 'JEDE_FECHAINICIO DESC';
 $Jefesdependencias = Jefesdependencias::model()->find($criteria);
 $Personasnaturales = Personasnaturales::model()->findByPk($Jefesdependencias->PENA_ID);
 */
 $Tutoriascontratos = Tutoriascontratos::model()->findByPk($data["TUCO_ID"]);
 $Tutoriascontratos->generarContratos();
 
 $valorContrato = ((($data["TUCO_VALORHORA"])*($data["HORAS"])) + ($data["TUCO_CUOTAADICIONAL"]));
 $valorContrato4xMil = (($valorContrato)+(($valorContrato)*(4/1000)));
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'O'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data["CONT_NUMORDEN"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data["PERS_IDENTIFICACION"]);
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data["PENA_APELLIDOS"]);
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data["PENA_NOMBRES"]);  
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data["TUSP_NOMBRE"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $data["TUCO_VALORHORA"]);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data["HORAS"]);
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $valorContrato);
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $valorContrato4xMil);
 $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $Tutoriascontratos->TUTORIAS_LISTADO_MODULOS);
 $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $data["PRES_NUM_CERTIFICADO"]);
 $objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $data["PRES_FECHA_VIGENCIA"]);
 $objPHPExcel->getActiveSheet()->setCellValue('O'.$fxls, $data["PRES_DESCRIPCION"]);
 $objPHPExcel->getActiveSheet()->setCellValue('P'.$fxls, $data["PRES_MONTO"]);
 
 $fxls++;
 $item++; 
}

  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(100);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
  
  
  $objPHPExcel->getActiveSheet()->getStyle('D10:D'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('G10:G'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('H10:H'.$fxls)->getNumberFormat()->setFormatCode('#,##0');  
  $objPHPExcel->getActiveSheet()->getStyle('I10:I'.$fxls)->getNumberFormat()->setFormatCode('#,##0');  
  $objPHPExcel->getActiveSheet()->getStyle('J10:J'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->getStyle('P10:P'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex($index);
   $dependencia = substr('REPORTE_GENERAL_TUTORIAS',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$dependencia");
   $index++;
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
  //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $objWriter->save('REPORTE_TURTORIAS.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="RELACION_CONTRATOS_TUTORIAS.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();
  
?>