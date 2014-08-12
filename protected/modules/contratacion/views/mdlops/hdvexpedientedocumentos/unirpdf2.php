<?php
 $PDFMergerPath = Yii::getPathOfAlias('application.extensions.UnirPDF');
 include($PDFMergerPath . DIRECTORY_SEPARATOR . 'PDFMerger.php');
 foreach($Hdvexpedientedocumentos as $data){
  $ruta[] = realpath(Yii::app( )->getBasePath( )."/..".$data->HEXD_RUTA);
  
 }
 $pdf =& new concat_pdf();
 $pdf->setFiles($ruta);
 $pdf->concat();
 $pdf->Output('hdv.pdf','F'); 
 /*F > file, I > browser, D >download */
 Yii::app()->request->redirect(Yii::app()->request->baseUrl."/hdv.pdf"); 
?>