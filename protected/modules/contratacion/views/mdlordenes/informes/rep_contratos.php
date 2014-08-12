<?php
$phpExcelPath = Yii::getPathOfAlias('ext.vendors.phpexcel');
spl_autoload_unregister(array('YiiBase','autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()
					->setCreator("ING. JESUS GABRIEL AREVALO AGUILAR - UNIVERSIDAD DE LA GUAJIRA")
					->setLastModifiedBy("ING. JESUS GABRIEL AREVALO AGUILAR - UNIVERSIDAD DE LA GUAJIRA")
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

$inicio = $Informes->CONT_FECHAINICIO;
$fin = $Informes->CONT_FECHAFINAL;

$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'UNIVERSIDAD DE LA GUAJIRA')
								 ->setCellValue('B2', 'OFICINA DE CONTRATACION')
								 ->setCellValue('B3', 'RELACION DE CONTRATACION EN GENERAL')
								 ->setCellValue('B6', 'PERIODO: DEL '.$inicio.' AL '.$fin)
								  
								 ->setCellValue('B8', 'ITEM')
								 ->setCellValue('C8', 'TIPO DE CONTRATO')
								 ->setCellValue('D8', 'CLASE DEL CONTRATO')
								 ->setCellValue('E8', 'NUMERO ')
								 ->setCellValue('F8', 'AÑOS ')
								 ->setCellValue('G8', 'MESES ')
								 ->setCellValue('H8', 'DIAS ')
								 ->setCellValue('I8', 'CONTRATISTA ');
					
$fxls=10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:I8')->applyFromArray($styleArrayB);

foreach($registros as $data){

 $criteria = new CDbCriteria;
 $criteria->condition = 'PERS_ID = '.$data["PERS_ID"];
 $Personas = Personas::model()->find($criteria);
 $Personas = Personas::model()->findByPk($Personas->PERS_ID);
 
 $criteria = new CDbCriteria;
 $criteria->condition = 'SUPE_ID = '.$data["SUPE_ID"];
 $Supervisores = Supervisores::model()->find($criteria);
 $Supervisores = Supervisores::model()->findByPk($Supervisores->SUPE_ID);
 
if($data["TIID_ID"]==2){ 
$tipopersona="Juridica";
$contratista= $Personas->rel_personas_juridicas->PEJU_NOMBRE;
//$idcontratista = substr($data["PERS_IDENTIFICACION"], -3, 10);
$idcontratista = $data["PERS_IDENTIFICACION"];
 
}else{
$tipopersona="Natural";
$contratista= $Personas->rel_personas_naturales->PENA_NOMBRES.' '.$Personas->rel_personas_naturales->PENA_APELLIDOS;
$idcontratista = $data["PERS_IDENTIFICACION"];
}


$idsupervisor= $Supervisores->rel_persona->PERS_IDENTIFICACION;
$supervisor= $Supervisores->rel_persona->rel_personas_naturales->PENA_NOMBRES.' '.$Supervisores->rel_persona->rel_personas_naturales->PENA_APELLIDOS;

 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'I'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data["TICO_NOMBRE"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data["CLCO_NOMBRE"]);
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data["CONT_NUMORDEN"]);
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data["MOOR_ANIOS"]);
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data["MOOR_MESES"]);
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $data["MOOR_DIAS"]);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $contratista);


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

 
 $objPHPExcel->getActiveSheet()->getStyle('H10:I'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
  // $objPHPExcel->setActiveSheetIndex($index);
  // $dependencia = substr('REPORTE_CONTRATOS',0,20);
  // $objPHPExcel->getActiveSheet()->setTitle("$dependencia");
   $index++;
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

 	
  //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $objWriter->save('REPORTE_CONTRATOS.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="RELACION_CONTRATOS.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();
  
?>