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
								 ->setCellValue('E8', 'FORMATO DEL CONTRATO')
								 ->setCellValue('F8', 'NUMERO ')
								 ->setCellValue('G8', 'OBJETO ')
								 ->setCellValue('H8', 'VALOR INICIAL DEL CONTRATO')
								 ->setCellValue('I8', 'CÉDULA / NIT DEL CONTRATISTA')
								 ->setCellValue('J8', 'NOMBRE COMPLETO DEL CONTRATISTA') 
								 ->setCellValue('K8', 'PERSONA NATURAL O JURÍDICA')
								 ->setCellValue('L8', 'FECHA DE ELABORACIÓN')
								 ->setCellValue('M8', 'CÉDULA / NIT DEL INTERVENTOR o SUPERVISOR')
								 ->setCellValue('N8', 'NOMBRE DEL INTERVENTOR o SUPERVISOR')
								 ->setCellValue('O8', 'AÑOS ')
								 ->setCellValue('P8', 'MESES ')
								 ->setCellValue('Q8', 'DIAS ')
								 ->setCellValue('R8', 'No. DEL CDP')
								 ->setCellValue('S8', 'FECHA DEL CDP')
								 ->setCellValue('T8', 'CODIGO')
								 ->setCellValue('U8', 'SECCION')
								 ->setCellValue('V8', 'DESCRIPCIÓN DEL CDP');
					
$fxls=10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:V8')->applyFromArray($styleArrayB);

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

 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'V'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data["TICO_NOMBRE"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data["CLCO_NOMBRE"]);
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $data["FCCO_NOMBRE"]);
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $data["CONT_NUMORDEN"]);
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data["MOOR_OBJETO"]);
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $data["MOOR_VALOR"]);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $idcontratista);
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $contratista); 
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $tipopersona);
 $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $data["CONT_FECHAINICIO"]);
 $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $idsupervisor);
 $objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $supervisor);
 $objPHPExcel->getActiveSheet()->setCellValue('O'.$fxls, $data["MOOR_ANIOS"]);
 $objPHPExcel->getActiveSheet()->setCellValue('P'.$fxls, $data["MOOR_MESES"]);
 $objPHPExcel->getActiveSheet()->setCellValue('Q'.$fxls, $data["MOOR_DIAS"]);
 $objPHPExcel->getActiveSheet()->setCellValue('R'.$fxls, $data["PRES_NUM_CERTIFICADO"]);
 $objPHPExcel->getActiveSheet()->setCellValue('S'.$fxls, $data["PRES_FECHA_VIGENCIA"]);
 $objPHPExcel->getActiveSheet()->setCellValue('T'.$fxls, $data["PRES_CODIGO"]);
 $objPHPExcel->getActiveSheet()->setCellValue('U'.$fxls, $data["PRES_SECCION"]);
 $objPHPExcel->getActiveSheet()->setCellValue('V'.$fxls, $data["PRES_DESCRIPCION"]);
 
 $fxls++;
 $item++; 

}  

  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(70);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true); 
  $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
  
 
 $objPHPExcel->getActiveSheet()->getStyle('H10:H'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
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