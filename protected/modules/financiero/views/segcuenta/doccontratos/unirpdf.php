<?php
 $PDFMergerPath = Yii::getPathOfAlias('application.extensions.PDFMerger');
 include($PDFMergerPath . DIRECTORY_SEPARATOR . 'PDFMerger.php');
 $pdf = new PDFMerger;
 
 foreach($Expedientedocumentos as $data){
	$realPath = Yii::app()->request->baseUrl; //."/".$data->EXDO_RUTA);
	$ruta = realpath(Yii::app( )->getBasePath( )."/..".$data->EXDO_RUTA);
	$pdf->addPDF($ruta, 'all');
  }
	$pdf->merge('browser', "/uploads/documento.pdf");
    
  
?>