<?php
 $PDFMergerPath = Yii::getPathOfAlias('application.extensions.UnirPDF');
 include($PDFMergerPath . DIRECTORY_SEPARATOR . 'PDFMerger.php');
 if($Expedientedocumentos){
 foreach($Expedientedocumentos as $data){
  $ruta[] = realpath(Yii::app( )->getBasePath( )."/..".$data->EXDO_RUTA);
  
 }
 $pdf =& new concat_pdf();
 $pdf->setFiles($ruta);
 $pdf->concat();
 $pdf->Output('newDocument.pdf','F'); 
 /*F > file, I > browser, D >download */
 Yii::app()->request->redirect(Yii::app()->request->baseUrl."/newDocument.pdf"); 
 }else{
	  throw new CHttpException(404,'Lo sentimos, no se han encontrado documentos :(');
	  }
?>