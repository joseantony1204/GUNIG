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
								 ->setCellValue('F8', 'CED. SUPERVISOR')
								 ->setCellValue('G8', 'NOMB. SUPERVISOR')
								 ->setCellValue('H8', 'APE. SUPERVISOR')
								 ->setCellValue('I8', 'MESES')
								 ->setCellValue('J8', 'DIAS') 
								 ->setCellValue('K8', 'VALOR TOTAL')
								 ->setCellValue('L8', 'VALOR CON 4XMIL')
								 ->setCellValue('M8', 'OBJETO')
								 ->setCellValue('N8', 'N. CERTIFICADO')
								 ->setCellValue('O8', 'F. VIGENCIA')
								 ->setCellValue('P8', 'DESCRIPCION')
								 ->setCellValue('Q8', 'MONTO');
					
$fxls=10;
$item = 1;

$objPHPExcel->getActiveSheet()->getStyle('B1:B6')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('B8:Q8')->applyFromArray($styleArrayB);

$valorContrato = 0; $valorContrato4xMil = 0;
foreach($registros as $data){
 	
 $Personas = new Personas;
 $idSupervisor = ''; $nSupervisor = ''; $aSupervisor = '';  $valorContrato = ''; $valorContrato4xMil =''; $nObjeto = '';
 $meses = ''; $dias = ''; $nCertificado = ''; $fVigencia = ''; $pDescripcion = ''; $pMonto = '';
 
 $criteria = new CDbCriteria;
 $criteria->condition = 'CONT_ID = '.$data["CONT_ID"];
 if($Opscontrato = Opscontratos::model()->find($criteria)){
  $Opscontratos = Opscontratos::model()->findByPk($Opscontrato->OPCO_ID);
  $valorContrato = ((($Opscontratos->OPCO_VALOR_MENSUAL)*($Opscontratos->OPCO_MESES)) + 
  (($Opscontratos->OPCO_VALOR_MENSUAL/30)*($Opscontratos->OPCO_DIAS)));
  $valorContrato4xMil = (($valorContrato)+(($valorContrato)*(4/1000)));
  
  $meses = $Opscontratos->OPCO_MESES; $dias = $Opscontratos->OPCO_DIAS;
  
  $criteria = new CDbCriteria;
  $criteria->condition = 'DEPE_ID = '.$Opscontratos->DEPE_ID;
  $criteria->order = 'JEDE_FECHAINICIO DESC';
  $Jefesdependencias = Jefesdependencias::model()->find($criteria);
  $Personasnaturales = Personasnaturales::model()->findByPk($Jefesdependencias->PENA_ID);
  
  $Opsobjetos = Opsobjetos::model()->findByPk($Opscontratos->OPOB_ID);
  $Objetos = Objetos::model()->findByPk($Opsobjetos->OBJE_ID);  
  $nObjeto = $Objetos->OBJE_NOMBRE;
  
  $Opspresupuestos = Opspresupuestos::model()->findByPk($Opscontratos->OPPR_ID);
  $Presupuestos = Presupuestos::model()->findByPk($Opspresupuestos->PRES_ID);  
  $nCertificado = $Presupuestos->PRES_NUM_CERTIFICADO;
  $fVigencia = $Presupuestos->PRES_FECHA_VIGENCIA;
  $pDescripcion = $Presupuestos->PRES_DESCRIPCION;
  $pMonto = $Presupuestos->PRES_MONTO;
  
  
  
  $idSupervisor = $Personasnaturales->rel_personas->PERS_IDENTIFICACION;
  $nSupervisor = $Personasnaturales->PENA_NOMBRES;
  $aSupervisor = $Personasnaturales->PENA_APELLIDOS;
 }else{
	   if($Tutoriascontrato = Tutoriascontratos::model()->find($criteria)){
        $Tutoriascontratos = Tutoriascontratos::model()->findByPk($Tutoriascontrato->TUCO_ID);
		$Tutoriascontratos->generarContratos();		
		
        $criteria = new CDbCriteria;
        $criteria->select = 't.TUTO_ID, SUM(t.TUTO_INTENSIDAD) AS TUTO_INTENSIDAD'; 
		$criteria->condition = 'TUCO_ID = '.$Tutoriascontratos->TUCO_ID;
        $Tutorias = Tutorias::model()->find($criteria);
		$Tutorias = Tutorias::model()->findByPk($Tutorias->TUTO_ID);
		
		$Tutoriaspresupuestos = Tutoriaspresupuestos::model()->findByPk($Tutorias->TUPR_ID);
        $Presupuestos = Presupuestos::model()->findByPk($Tutoriaspresupuestos->PRES_ID);  
        $nCertificado = $Presupuestos->PRES_NUM_CERTIFICADO;
		$fVigencia = $Presupuestos->PRES_FECHA_VIGENCIA;
        $pDescripcion = $Presupuestos->PRES_DESCRIPCION;
        $pMonto = $Presupuestos->PRES_MONTO;
		
		$nObjeto = $Tutoriascontratos->TUTORIAS_LISTADO_MODULOS;
		$meses = $Tutoriascontratos->TUTORIAS_PLAZO;
 
        $valorContrato = ((($Tutoriascontratos->TUCO_VALORHORA)*($Tutorias->TUTO_INTENSIDAD)) + ($Tutoriascontratos->TUCO_CUOTAADICIONAL));
        $valorContrato4xMil = (($valorContrato)+(($valorContrato)*(4/1000)));
		
	   }
	  }
 
 
 
 $objPHPExcel->getActiveSheet()->getStyle('B'.$fxls.':'.'Q'.$fxls)->applyFromArray($styleArrayBInt);
 $objPHPExcel->getActiveSheet()->setCellValue('B'.$fxls, $item);
 $objPHPExcel->getActiveSheet()->setCellValue('C'.$fxls, $data["CONT_NUMORDEN"]); 
 $objPHPExcel->getActiveSheet()->setCellValue('D'.$fxls, $data["PERS_IDENTIFICACION"]);
 $objPHPExcel->getActiveSheet()->setCellValue('E'.$fxls, $Personas->nombreCompleto($data["PERS_ID"]));
 $objPHPExcel->getActiveSheet()->setCellValue('F'.$fxls, $idSupervisor);
 $objPHPExcel->getActiveSheet()->setCellValue('G'.$fxls, $nSupervisor);
 $objPHPExcel->getActiveSheet()->setCellValue('H'.$fxls, $aSupervisor);
 $objPHPExcel->getActiveSheet()->setCellValue('I'.$fxls, $meses);
 $objPHPExcel->getActiveSheet()->setCellValue('J'.$fxls, $dias); 
 $objPHPExcel->getActiveSheet()->setCellValue('K'.$fxls, $valorContrato);
 $objPHPExcel->getActiveSheet()->setCellValue('L'.$fxls, $valorContrato4xMil);
 $objPHPExcel->getActiveSheet()->setCellValue('M'.$fxls, $nObjeto);
 $objPHPExcel->getActiveSheet()->setCellValue('N'.$fxls, $nCertificado);
 $objPHPExcel->getActiveSheet()->setCellValue('O'.$fxls, $fVigencia);
 $objPHPExcel->getActiveSheet()->setCellValue('P'.$fxls, $pDescripcion);
 $objPHPExcel->getActiveSheet()->setCellValue('Q'.$fxls, $pMonto);
 
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
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(42);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(82);
  //$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);	
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);

  
  $objPHPExcel->getActiveSheet()->getStyle('D10:D'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('F10:F'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  $objPHPExcel->getActiveSheet()->getStyle('K10:K'.$fxls)->getNumberFormat()->setFormatCode('#,##0');  
  $objPHPExcel->getActiveSheet()->getStyle('L10:L'.$fxls)->getNumberFormat()->setFormatCode('#,##0');  
  $objPHPExcel->getActiveSheet()->getStyle('M10:M'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  $objPHPExcel->getActiveSheet()->getStyle('Q10:Q'.$fxls)->getNumberFormat()->setFormatCode('#,##0');
  
  
  /*CREANDO HOJAS PARA CADA PROGRAMA INCLUYENDO SUS RESPECTIVAS CATEDRAS ASIGNADAS*/
   $objPHPExcel->setActiveSheetIndex($index);
   $dependencia = substr('REPORTE_CONTRALORIA',0,20);
   $objPHPExcel->getActiveSheet()->setTitle("$dependencia");
   $index++;
   
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
  //$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $objWriter->save('REPORTE_CONTRALORIA.xls'); 
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="REPORTE_CONTRALORIA.xls"');
  header('Cache-Control: max-age=0');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  $objWriter->save('php://output'); 
  unset($this->objWriter);
  unset($this->objWorksheet);
  unset($this->objReader);
  unset($this->objPHPExcel);
  
  Yii::app()->end();
  
?>