<?php
$phpExcelPath = Yii::getPathOfAlias('ext.vendors.phpexcel');
spl_autoload_unregister(array('YiiBase','autoload'));
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()
					->setCreator("ING. TATIANA KATHERINE MONTOYA ZABALETA - UNIVERSIDAD DE LA GUAJIRA")
					->setLastModifiedBy("ING. TATIANA KATHERINE MONTOYA ZABALETA - UNIVERSIDAD DE LA GUAJIRA")
					->setTitle("REPORTE REGISTRO GRADUADOS")
					->setSubject("REPORTE")
					->setDescription("REPORTE")
					->setKeywords("REPORTE, GRADUADOS")
					->setCategory("SECRETARIA GENERAL");
					

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

$dataProvider = $_SESSION['datos_filtrados'];
$contador=count($dataProvider);

$registros=$dataProvider->getData(true);

$folios= new Folios;
$graduados= new Graduados;
$rectores= new Rectores;
$decanos= new Decanos;
$secretarios= new Secretariosgenerales;
$titulos= new Titulos;
$graduados= new Graduados;
$programas= new Programas;
$codigosicfes = new Codigosicfes;
$sedes= new Sedes;
$fechasgrados= new Fechasgrados;
$facultades= new Facultades;
$titulostrabajosgrados= new Titulostrabajosgrados;
 $jornadas=new Jornadas;
  $programas=new Programas;
     $nivele=new Nivelesestudios;
$fechaActual=date("d-m-Y H:i:s");
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex($index)
								 ->setCellValue('B1', 'UNIVERSIDAD DE LA GUAJIRA')
								 ->setCellValue('B2', 'OFICINA DE SECRETARIA GENERAL')
								 ->setCellValue('B3', 'RELACION DE GRADUADOS')
								 ->setCellValue('B4', 'FECHA DE REPORTE '.$fechaActual)
								  
								  ->setCellValue('B8', 'ITEM')
								  ->setCellValue('C8', 'NOMBRES')
								  ->setCellValue('D8', 'APELLIDOS')
								  ->setCellValue('E8', 'CEDULA')
								  ->setCellValue('F8', 'EXPEDICION')
								  ->setCellValue('G8', 'ACTA')
								  ->setCellValue('H8', 'FOLIO')
								  ->setCellValue('I8', 'LBRO')
								  ->setCellValue('J8', 'FECHA DE GRADO')
								  ->setCellValue('K8', 'TITULO')
								  ->setCellValue('L8', 'NIVELES ESTUDIO')
								  ->setCellValue('M8', 'EXTENSION')
								  ->setCellValue('N8', 'TRABAJO DE GRADO')
								  ->setCellValue('O8', 'JORNADA')
								  ->setCellValue('P8', 'SEXO')
								  ->setCellValue('Q8', 'FACULTAD')
								  ->setCellValue('R8', 'PROGRAMA')
								  ->setCellValue('S8', 'RECTOR')
								  ->setCellValue('T8', 'DECANO')
								  ->setCellValue('U8', 'SECRETARIA');
								
								
								 
								 
								 
								
								
								 
								    
					
$fxls=10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:U8')->applyFromArray($styleArrayB);

foreach($registros as $data){
$idGraduado=$data["GRAD_ID"];
 $numfolio=$folios->getFolio($data["FOLI_ID"]);
   $nombreTitulo=strtoupper($titulos->getNombreTitulo($data["TITU_ID"]));
 //$cedulaGraduado=$data["GRAD_ID"];
  //$nombreGraduado=$data["GRAD_ID"];
 // $ApellidosGraduado=$data["GRAD_ID"];
  $titulotrabajo=strtoupper($titulostrabajosgrados->getTitulotrabajogrado($data["TITG_ID"]));
   $nombreRector= strtoupper($rectores->getNombreRector($data["RECT_ID"]));
 $nombreDecano= strtoupper($decanos->getNombreDecanos($data["DECA_ID"]));
 $nombreSecretario= strtoupper($secretarios->getNombreSecretarios($data["SEGE_ID"]));
 $nombreFacultad=strtoupper($facultades->getNombreFacultad($data["FACU_ID"]));
 $nombreSede=strtoupper($sedes->getNombreSedes($data["SEDE_ID"]));
//$sexoGraduado=$data["GRAD_ID"];
$jornadaGraduado=$jornadas->getNombreJornadas($data["JORN_ID"]);
$programaGraduado=$programas->getNombrePrograma($data["PROG_ID"]);
$nivelesGraduados=$nivele->getNombreNivel($data["NIES_ID"]);
//$lugarExpediccioCedula=$data["GRAD_ID"];
$cedulaGraduado=$graduados->getCedulaGraduado($idGraduado);
$sexoGraduado=$graduados->getNombreSexoGraduado($idGraduado);
$lugarExpediccioCedula=$graduados->getLugarExpedicionCedula($idGraduado);
$nombreGraduado=$graduados->getNombresGraduado($idGraduado);
 $ApellidosGraduado=$graduados->getApellidosGraduados($idGraduado);
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'I'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $nombreGraduado);
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $ApellidosGraduado);
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $cedulaGraduado);
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $lugarExpediccioCedula);
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $data["REGR_ACTA"]);
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $numfolio);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $data["LIBR_ID"]);
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, Yii::app()->dateformatter->format("dd-MM-yyyy",$fechasgrados->FechaGrado($data["FEGR_ID"])));
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $nombreTitulo);
 $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $nivelesGraduados);
 $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $nombreSede);
 $objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $titulotrabajo);
  $objPHPExcel->getActiveSheet()->setCellValue('O'.$fxls, $jornadaGraduado);
 $objPHPExcel->getActiveSheet()->setCellValue('P'.$fxls, $sexoGraduado);
 $objPHPExcel->getActiveSheet()->setCellValue('Q'.$fxls, $nombreFacultad);
 $objPHPExcel->getActiveSheet()->setCellValue('R'.$fxls, $programaGraduado);
 $objPHPExcel->getActiveSheet()->setCellValue('S'.$fxls, $nombreRector);
 $objPHPExcel->getActiveSheet()->setCellValue('T'.$fxls, $nombreDecano);
  $objPHPExcel->getActiveSheet()->setCellValue('U'.$fxls, $nombreSecretario);
  

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
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
   $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);	
  

 
 $objPHPExcel->getActiveSheet()->getStyle('H10:I'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
 
   $index++;
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

 	
 
  $objWriter->save('REPORTE_GRADUADOS.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="REPORTE_GRADUADOS.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();
  
?>