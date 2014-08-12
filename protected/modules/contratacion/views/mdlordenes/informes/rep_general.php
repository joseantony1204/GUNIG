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
								 ->setCellValue('E8', 'NOMBRES COMPLETO')
								 ->setCellValue('F8', 'DEPENDENCIA')
								 ->setCellValue('G8', 'CED. SUPERVISOR')
								 ->setCellValue('H8', 'NOMB. SUPERVISOR')
								 ->setCellValue('I8', 'APE. SUPERVISOR')
								 ->setCellValue('J8', 'MESES')
								 ->setCellValue('K8', 'DIAS') 
								 ->setCellValue('L8', 'VALOR MENSUAL')
								 ->setCellValue('M8', 'VALOR TOTAL')
								 ->setCellValue('N8', 'VALOR CON 4XMIL')
								 ->setCellValue('O8', 'OBJETO')
								 ->setCellValue('P8', 'N. CERTIFICADO')
								 ->setCellValue('Q8', 'F. VIGENCIA')
								 ->setCellValue('R8', 'DESCRIPCION')
								 ->setCellValue('S8', 'MONTO');
					
$fxls=10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:S8')->applyFromArray($styleArrayB);

$valorContrato = 0; $valorContrato4xMil = 0;
foreach($registros as $data){
 $criteria = new CDbCriteria;
 $criteria->condition = 'DEPE_ID = '.$data["DEPE_ID"];
 $criteria->order = 'JEDE_FECHAINICIO DESC';
 $Jefesdependencias = Jefesdependencias::model()->find($criteria);
 $Personasnaturales = Personasnaturales::model()->findByPk($Jefesdependencias->PENA_ID);
 
 $valorContrato = ((($data["OPCO_VALOR_MENSUAL"])*($data["OPCO_MESES"])) + (($data["OPCO_VALOR_MENSUAL"]/30)*($data["OPCO_DIAS"])));
 $valorContrato4xMil = (($valorContrato)+(($valorContrato)*(4/1000)));
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'R'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data["CONT_NUMORDEN"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data["PERS_IDENTIFICACION"]);
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data["PENA_NOMBRES"].' '.$data["PENA_APELLIDOS"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data["DEPE_NOMBRE"]);      
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $Personasnaturales->rel_personas->PERS_IDENTIFICACION);
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $Personasnaturales->PENA_NOMBRES);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $Personasnaturales->PENA_APELLIDOS);
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $data["OPCO_MESES"]);
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $data["OPCO_DIAS"]);
 $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $data["OPCO_VALOR_MENSUAL"]);
 $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $valorContrato);
 $objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $valorContrato4xMil);
 $objPHPExcel->getActiveSheet()->setCellValue('O'.$fxls, $data["OBJE_NOMBRE"]);
 $objPHPExcel->getActiveSheet()->setCellValue('P'.$fxls, $data["PRES_NUM_CERTIFICADO"]);
 $objPHPExcel->getActiveSheet()->setCellValue('Q'.$fxls, $data["PRES_FECHA_VIGENCIA"]);
 $objPHPExcel->getActiveSheet()->setCellValue('R'.$fxls, $data["PRES_DESCRIPCION"]);
 $objPHPExcel->getActiveSheet()->setCellValue('S'.$fxls, $data["PRES_MONTO"]);
 
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
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(100);
  //$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);

  
  $objPHPExcel->getActiveSheet()->getStyle('D10:D'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('F10:F'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('L10:L'.$fxls)->getNumberFormat()->setFormatCode('#,##0');  
  $objPHPExcel->getActiveSheet()->getStyle('M10:M'.$fxls)->getNumberFormat()->setFormatCode('#,##0');  
  $objPHPExcel->getActiveSheet()->getStyle('N10:N'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->getStyle('S10:S'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex($index);
   $dependencia = substr('REPORTE_GENERAL_OPS',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$dependencia");
   $index++;
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
  //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $objWriter->save('REPORTE_OPS.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="RELACION_CONTRATOS_OPS.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();
  
?>