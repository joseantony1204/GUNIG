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
								 ->setCellValue('B3', 'INFORME GENERAL DE PERSONAS CONTRATADAS')
								 ->setCellValue('B6', 'PERIODO : ')
								  
								 ->setCellValue('B8', 'ITEM')
								 ->setCellValue('C8', 'IDENTIFICACION') 
								 ->setCellValue('D8', '1er NOMBRE')
								 ->setCellValue('E8', '2do NOMBRE')
								 ->setCellValue('F8', '1er APELLIDO')
								 ->setCellValue('G8', '2do APELLIDO')
								 ->setCellValue('H8', 'ESTADO CIVIL')
								 ->setCellValue('I8', 'FECHA NACIMIENTO') 
								 ->setCellValue('J8', 'PAIS')
								 ->setCellValue('K8', 'DEPARTAMENTO')
								 ->setCellValue('L8', 'MUNICIPIO')
								 ->setCellValue('M8', 'HORAS')
								 ->setCellValue('N8', 'PERFIL')
								 ->setCellValue('O8', 'TIPO ESTUDIO')
								 ->setCellValue('P8', 'PROGRAMA');
					
$fxls=10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:P8')->applyFromArray($styleArrayB);

foreach($registros as $data){
 
 $Estadoscivil = Estadoscivil::model()->findByPk($data["ESCI_ID"]);
 $Paises = Paises::model()->findByPk($data["PAIS_ID"]);
 $Departamentos = Departamentos::model()->findByPk($data["DEPA_ID"]);
 $Municipios = Municipios::model()->findByPk($data["MUNI_ID"]);


 $criteria = new CDbCriteria;
 $criteria->select = 'e.ESTU_ID, e.ESTU_NOMBRE';
 $criteria->join = '
            INNER JOIN TBL_ESTUDIOS e ON e.ESTU_ID = t.ESTU_ID
            INNER JOIN TBL_TIPOSESTUDIOS te ON e.TIES_ID = te.TIES_ID 
			AND t.PENA_ID = '.$data["PENA_ID"].' AND te.TIES_ID <=5';
 $criteria->order = 'te.TIES_ID DESC';
 $Personasnaturalesestudio = Personasnaturalesestudios::model()->find($criteria);
 
 $Estudios = Estudios::model()->findByPk($Personasnaturalesestudio->ESTU_ID);
 
  $Tiposestudios = Tiposestudios::model()->findByPk($Estudios->TIES_ID);
  
  $Nombres = explode(" ",$data["PENA_NOMBRES"]);
  $Apellidos = explode(" ",$data["PENA_APELLIDOS"]);
 
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'P'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data["PERS_IDENTIFICACION"]);
  
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $Nombres[0]);
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $Nombres[1]." ".$Nombres[2]);
 
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $Apellidos[0]);
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $Apellidos[1]." ".$Apellidos[2]);
 
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $Estadoscivil->ESCI_NOMBRE);  
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data["PENA_FECHANACIMIENTO"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $Paises->PAIS_NOMBRE);
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $Departamentos->DEPA_NOMBRE);
 $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $Municipios->MUNI_NOMBRE);
 $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $data["HORAS"]);
 $objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $Estudios->ESTU_NOMBRE);
 $objPHPExcel->getActiveSheet()->setCellValue('O'.$fxls, $Tiposestudios->TIES_NOMBRE);
 $objPHPExcel->getActiveSheet()->setCellValue('P'.$fxls, $data["TUSP_NOMBRE"]);
 
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
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
  
  $objPHPExcel->getActiveSheet()->setAutoFilter('B8:P'.$fxls);
  
  
  $objPHPExcel->getActiveSheet()->getStyle('C10:C'.$fxls)->getNumberFormat()->setFormatCode('#,##0');  
  $objPHPExcel->getActiveSheet()->getStyle('K10:K'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex($index);
   $dependencia = substr('ESTUDIOS_DOCENTES_TUTORES',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$dependencia");
   $index++;
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
  //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $objWriter->save('ESTUDIOS_DOCENTES_TUTORES.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="ESTUDIOS_DOCENTES_TUTORES.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();
  
?>