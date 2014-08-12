<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','L', 'pt', 'Letter', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  
  
  $autor='ING. JOSE ANTONIO GONZALEZ LIÑAN - UNIVERSIDAD DE LA GUAJIRA';  
 // $Numero = $Contratos->numOrden;     
  $titulo="REPORTE DE CUENTAS ";
  $palabrasClaves='CUENTAS, OPS, TALENTO HUMANO';
  $Sujeto='CUENTAS';
  $NombreDocumento=$titulo;
  
  $Usuarios = Usuarios::model()->findByPk(Yii::app()->user->id);
  $Usuariodependencia = Seguimientouserdependencias::model()->findBySql("SELECT * FROM TBL_SEGUIMIENTOUSERDEPENDENCIAS 
  WHERE USUA_ID = ".$Usuarios->USUA_ID);
  $Dependencias = Dependencias::model()->findByPk($Usuariodependencia->DEPE_ID);
  
 // $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $PDF_HEADER_LOGO = 'tcpdf_logoo.jpg';
  $pdf->SetHeaderData($PDF_HEADER_LOGO, 160, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);
 // Información referente al PDF
  $pdf->SetCreator($autor);
  $pdf->SetAuthor($autor);
  $pdf->SetTitle($titulo);
  $pdf->SetSubject($Sujeto);
  $pdf->SetKeywords($palabrasClaves);
  
    // Fuente de la cabecera y el pie de página
  $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
  $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	
  // Márgenes
  $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
  $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
  $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  $pdf->setPrintFooter(true);
	
  // Saltos de página automáticos.
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
  // Establecer el ratio para las imagenes que se puedan utilizar
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
   //***** AÑADIR PAGINA *****//
  $pdf->SetFont('times', 'k', '9', true);
  $pdf->AddPage();
  ///***** CREANDO ARCHIVO *****///
  
  $html ='<table width="100%" border="1" align="center">';
  $html .='
       <tr>
        <td colspan="10" align="center"><strong>REPORTE DEL ESTADO DE CUENTAS TRAMITADAS O NO TRAMITADAS POR DEPENDENCIAS</strong></td>
       </tr>
       <tr>
        <td colspan="10" align="left"><strong>DEPENDENCIA : '.$Dependencias->DEPE_NOMBRE.'</strong></td>
       </tr>
       <tr>
        <td colspan="10" align="left">
		<strong>PERIODO DE TRAMITE : DESDE '.$Cuentas->CUEN_FECHAINICIO.' HASTA '.$Cuentas->CUEN_FECHAFINAL.'</strong></td>
       </tr>
	   <tr>
        <td colspan="10" align="left">&nbsp;</td>
       </tr>
	   <tr  bgcolor="#EBEBEB">
		<td align="center" width="4%"><strong>ITEM</strong></td>
		<td align="center" width="25%"><strong>NOMBRE DE LA PERSONA</strong></td>
		<td align="center" width="7%"><strong># ORDEN</strong></td>
		<td align="center" width="4%"><strong>AÑO</strong></td>
		<td align="center" width="8%"><strong>VR CUENTA</strong></td>
		<td align="center" width="10%"><strong>ORDEN PAGO</strong></td>
		<td align="center" width="8%"><strong>F. PROCESO</strong></td>
		<td align="center" width="7%"><strong>NUM. CTA</strong></td>
		<td align="center" width="9%"><strong>FECHA INICIO</strong></td>
		<td align="center" width="9%"><strong>FECHA FINAL</strong></td>
		<td align="center" width="9%"><strong>TIPO PAGO</strong></td>
	   </tr>			
	   ';
  $pdf->SetFont('times', 'k', '9', true);
  $i=1;	   	   
  foreach($Registros as $rows){  
     $criteria=new CDbCriteria;
     $criteria->condition='CUEN_ID = '.$rows["CUEN_ID"].' AND SECU_NUMORDENPAGO !=""';
	 $Seguimientocuenta = Seguimientocuentas::model()->find($criteria);
	 $Seguimientocuentas = Seguimientocuentas::model()->findByPk($Seguimientocuenta->SECU_ID);
	 $dia = date("d",strtotime($Seguimientocuentas->SECU_FECHAINGRESO));
     $mes = date("m",strtotime($Seguimientocuentas->SECU_FECHAINGRESO));
	 $anio = date("Y",strtotime($Seguimientocuentas->SECU_FECHAINGRESO));
 
     $fecha = $dia.'/'.$mes.'/'.$anio;
	 $html .='
	   <tr>
		<td align="center">'.$i.'</td>
		<td align="left">'.$rows["PENA_NOMBRES"].' '.$rows["PENA_APELLIDOS"].'</td>
		<td align="center">'.$rows["CONT_NUMORDEN"].'</td>
		<td align="center">'.$rows["CONT_ANIO"].'</td>
		<td align="right">'.number_format($rows["CUEN_VALOR"]).'</td>
		<td align="center">'.$Seguimientocuentas->SECU_NUMORDENPAGO.'</td>
		<td align="center">'.$fecha.'</td>
		<td align="center">'.$rows["CUEN_NUMERO"].'</td>
		<td align="center">'.$rows["CUEN_FECHAINICIO"].'</td>
		<td align="center">'.$rows["CUEN_FECHAFINAL"].'</td>
		<td align="center">'.$rows["TIPA_NOMBRE"].'</td>
		
	   </tr>			
	   '; 
	$i++;     
  }
  $html .='</table>';
 
 $pdf->writeHTML($html, true, 0, true, 0);
 $pdf->Output("$NombreDocumento.pdf", 'D');  
    
  Yii::app()->end();
  
?>