<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'pt', 'Letter', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  $phpNumToLetterPath = Yii::getPathOfAlias('ext');
  include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
  $NumberToLetters = new EnLetras();
  
  
  $autor='ING. JESUS GABRIEL AREVALO AGUILAR - UNIVERSIDAD DE LA GUAJIRA';  
  $Numero = $Contratos->numOrden;     
  $titulo="EVALUACION DE CONTRATO";
  $palabrasClaves='CONTRATO, ORDENES, CONTRATACION';
  $Sujeto='CONTRATOS EN GENERAL';
  $NombreDocumento=$titulo;
  $logo="tcpdf_u.jpg";
  
  
  // Extend the TCPDF class to create custom Header and Footer
  class MYPDF extends TCPDF {

  // Page footer
  public function Footer() {
    // Set font		
    //$this->SetFont('times', 'K', 11);
	$user = strtolower(Yii::app()->user->nombres);
    $nameUser = "(30,31,32)";
	//$nameUser =$pag_formato;
	
	
	$txt ='
    <table width="100%" border="0" align="center">
	 
	 <tr>
	   <th colspan="5" align="left"><font size="6">'.$nameUserxxxx.'</font></th>
     </tr>
	 <tr>
      <th width="10%" ><font size="7">LIF-'.$pag_formato.'</font></th>
      <th width="25%" ><font size="9">Cesar D. Maestre M.</font> <br> <font size="8">ELABOR&Oacute;</font></th>
	  <th width="24%" ><font size="9">Tatiana Martínez</font> <br> <font size="8">REVIS&Oacute;</font></th>
      <th width="24%" ><font size="9">Freddy Rodríguez</font> <br> <font size="8">APROB&Oacute;</font></th>
	  <th width="17%" align="left" ><font size="9">Rev. 0 Jul / 2013<br></font>'.'<font size="8">Pág. '.$this->getAliasNumPage().' de '.$this->getAliasNbPages().'</font></th>
      
     </tr>
    

	 
    </table>';
    $this->Line(15,282,195,282); 
    $this->writeHTML($txt, true, 0, true, 0);
   }
  }
  
  
 
  $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $pdf->SetHeaderData(PDF_HEADER_LOGO, 160, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);
  $pdf->SetHeaderData($logo, 160, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);
  
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
  $pdf->setPrintFooter(false);
	
  // Saltos de página automáticos.
  $pdf->SetAutoPageBreak(TRUE, 10);
	
  // Establecer el ratio para las imagenes que se puedan utilizar
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
   function NombreMes($m){
   switch ($m){
    case 1: return "Ene";
    case 2: return "Feb";
    case 3: return "Mar";
    case 4: return "Abr";
    case 5: return "May";
    case 6: return "Jun";
    case 7: return "Jul";
    case 8: return "Ago";
    case 9: return "Sep";
    case 10: return "Oct";
    case 11: return "Nov";
    case 12: return "Dic";
   }
  }
 
  $id = "";
  if($_REQUEST["id"]){
   $id = $_REQUEST["id"];
  }
 
  $data = $Modeloordenes->downloadContratos($id);
  
  $datacriterio= $Modeloordenes->criterios($id);
  
  $numerocdp =count($datacriterio);
  
  $datacontratista = $Modeloordenes->contratista($id);
 
  foreach($data as $rows){
  $Modeloordenes = Modeloordenes::model()->findByPk($rows["MOOR_ID"]);
  
  /* OBTENIENDO EL NOMBRE DEL CONTRATISTA - ID Y EMAIL*/	
	if ($datacontratista>0) {
	//si es una persona natural
	$contratista = $html.=$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
	'.$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'
	';
	$cedula=$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION;
	$email = $Modeloordenes->rel_contrato->Persona->PERS_EMAIL;
	$identificacion = $Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION;
	
	}else{
	//si es una persona juridica
	$contratista=$html.=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.'';
	$nit= $Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.'';
	$email = $Modeloordenes->rel_contrato->Persona->PERS_EMAIL;
	$identificacion = $Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION;
	}
	 
	 
  /* OBTENIENDO EL NUMERO DE CONTRATO */	
  $numero = $Modeloordenes->rel_contrato->CONT_NUMORDEN;
  $numerocontrato = substr($numero, -3); 	
  $objeto= trim($Modeloordenes->MOOR_OBJETO); 
  
    /* OBTENIENDO OBSERVACION */
  $observaciones = $Modeloordenes->rel_observacion->EVOB_NOMBRE;
  if ($observaciones!=NULL){
  $observacion= trim($observaciones);
  }else{
	   $observacion= "Sin observaciones";
	  }
	  
	 
   /* OBTENIENDO PUNTAJE */
     $puntajes = $Modeloordenes->puntaje($id);
     $puntaje = ((int) ($puntajes)); 
  	
   if($puntaje>=90){
	   $resultado="EXCELENTE";
	   }elseif( ($puntaje>=80 ) & ($puntaje<90) ){
	   $resultado="BUENO";
	   }elseif( ($puntaje>=50 ) & ($puntaje<80) ){
	   $resultado="ACEPTABLE";
	   }elseif($puntaje<50){
	   $resultado="INSATISFACTORIO";
	   }
   
  
   /* OBTENIENDO EL TIPO Y LA CLASE DEL CONTRATO */	
  $tipo = $Modeloordenes->rel_contrato->tICO->TICO_NOMBRE;
  $clase = $Modeloordenes->rel_contrato->cLCO->CLCO_NOMBRE;	
  
   /* SUPERVISOR */	
  $cargosuper = $Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE;
  $nombresuper = $Modeloordenes->rel_contrato->Supervisor->rel_persona->rel_personas_naturales->PENA_NOMBRES.' 
		'.$Modeloordenes->rel_contrato->Supervisor->rel_persona->rel_personas_naturales->PENA_APELLIDOS;
  
  /* CONFIGURANDO LA FECHA */
  $dia_contrato = date("d",strtotime($Evaluaciones->CONT_FECHAEVALUACION));
  $mes_contrato=NombreMes(date("m",strtotime($Evaluaciones->CONT_FECHAEVALUACION)));
  $anio_contrato= date("Y",strtotime($Evaluaciones->CONT_FECHAEVALUACION));
  $fecha = "".$dia_contrato." de ".$mes_contrato." del ".$anio_contrato;
 // $fechacontratos = $dia_contrato." días del mes de ".$mes_contrato." de año ".$anio_contrato;

  $Contratos = Contratos::model()->findByPk($Modeloordenes->CONT_ID);
		
  
  //EVTC clase: 1 BIENES, 2 SERVICIOS, 3 OBRAS
  //servcios: 20 ORDEN PRESTACION DE SERVICIO, 50 ORDEN TRABAJO, 80 CONTRATO PRESTACION DE SERVICIOS, 110 CONSULRORÍA, 150 SEGUROS
  //bienes: 30 SUMINISTRO, 40 COMPRAVENTA, 90 SUMINISTRO, 100 COMPRAVENTA, 120 ARRENDAMIENTO
  //obras: 140 OBRA
					
	$clasecont = $Modeloordenes->rel_contrato->cLCO->CLCO_ID;	
					
	if($clasecont==20 or $clasecont==50 or $clasecont==80 or $clasecont==110 or $clasecont==150 or $clasecont==170 or $clasecont==180){
	$claseevaluacion=1;
	$nombreclase="SERVICIOS";
	$pag_formato="LIF-31";
	$pag_elaboro="Cesar D. Maestre M.";
	$pag_reviso="Tatiana Martínez";
	$pag_aprovo="Freddy Rodríguez";
				
	}elseif($clasecont==30 or $clasecont==40 or $clasecont==90 or $clasecont==100 or $clasecont==120){
	$claseevaluacion=2;
	$nombreclase="BIENES Y/O SUMINISTROS";
	$pag_formato="LIF-30";
	$pag_elaboro="Cesar D. Maestre M.";
	$pag_reviso="Tatiana Martínez";
	$pag_aprovo="Freddy Rodríguez";
				
	}elseif($clasecont==140){
	$claseevaluacion=3;
	$nombreclase="OBRAS CIVILES";
	$pag_formato="LIF-32";
	$pag_elaboro="Cesar D. Maestre M.";
	$pag_reviso="Tatiana Martínez";
	$pag_aprovo="Freddy Rodríguez";
						
	}
  
    
   $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
  // $ima = echo $image = CHtml::image($imageUrl);
		  
  
    
  /*A PARTIR DE AQUI SE COMIENZA A VINCULAR LA EVALUACION CORRESPONDIENTE*/  
  if(($claseevaluacion)==3){
	 /*SI ES UNA EVALUACION DE OBRAS CIVILES */
    
	 
	  //***** AÑADIR PAGINA *****//
	  //$pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 10);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   
	   <table width="100%" border="0" align="center">		
	   
	   <tr>
		 <td align="center"><strong>INFORMACIÓN DE EVALUACIÓN DEL PROVEEDOR DE '.$nombreclase.'</strong></td>
	   </tr>
	  
	  
	  <tr>
		 <td align="center">
		 
			<table width="100%" border="0">
			  <tr>
				<td width="70%" align="left"><strong>PROVEEDOR:</strong> '.$contratista.'</td>
				<td width="30%" align="left"><strong>&nbsp;C.C./NIT:</strong> '.$identificacion.'</td>
			  </tr>
			  
			   <tr>
				<td width="70%" align="left"><strong>CORREO ELECTRONICO:</strong> '.$email.'</td>
				<td width="30%" align="left"><strong>&nbsp;FECHA:</strong> '.$fecha.'</td>
			  </tr>
			  
			  <tr>
				<td width="100%" align="left"><strong>CONTRATO/ORDEN:</strong> '.$tipo.' '.$numerocontrato.' DE '.$clase.' DE  '.$anio_contrato.'<br></td>
			  </tr>		  
			  
			 </table>
			
		 </td>
		</tr> 
	   
	   <tr>
		<td align="center"><strong>CRITERIOS DE EVALUACIÓN PARA PROVEEDORES DE '.$nombreclase.'</strong></td>
	   </tr>
	   
	
	   
	     <tr>
		 <td align="center">
		 
		  '; 
		     foreach($datacriterio as $rows){
			 $criterio = Evamodeloscriterios::model()->findByPk($rows["EMCE_ID"]);
			 $descriterio[] = $criterio->rel_criterios->EVCR_NOMBRE;
			 $idestado[] = $criterio->rel_estados->EVES_ID;
			 $desestado[] = $criterio->rel_estados->EVES_NOMBRE;
			 $despunto[] = $criterio->rel_criterios->EVCR_PUNTO;
			 }
				 
	$html .='
		 
		 <br>
		 
			<table width="99%" border="0">
			<tr>
	     	<td align="center">&nbsp;</td>
	       </tr>
		    </table>
			
			<table width="99%" border="0.7">  
			  <tr>
				<td width="18%" align="center">Tipo de Criterio</td>
				<td width="59%" align="center">Descripción</td>
				<td width="9%" align="center">¿Cumple?</td>
				<td width="7%" align="center">Max.</td>
				<td width="7%" align="center">Asig.</td>
			  </tr>
			  
			  ';
			  if($idestado[0]==1){
				  $valpunto=$despunto[0];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			  
			   <tr>
				<td rowspan="8" width="18%" align="center"><br><br><br><br><br><br><br><br><br>CALIDAD DE LA OBRA</td>
				<td width="59%" align="justify">'.$descriterio[0].'</td>
				<td width="9%" align="center">'.$desestado[0].'</td>
				<td rowspan="8" width="7%" align="center"><br><br><br><br><br><br><br><br><br>70</td>
				<td width="7%" align="center">'.$valpunto.'</td>
			  </tr>
			  
			  ';
			  if($idestado[1]==1){
				  $valpunto=$despunto[1];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			  
			  <tr>
				<td width="59%" align="justify">'.$descriterio[1].'</td>
				<td width="9%" align="center">'.$desestado[1].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
			  </tr>
			  
			   ';
			  if($idestado[2]==1){
				  $valpunto=$despunto[2];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			  
			  <tr>
			    <td width="59%" align="justify">'.$descriterio[2].'</td>
				<td width="9%" align="center">'.$desestado[2].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[3]==1){
				  $valpunto=$despunto[3];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			    <td width="59%" align="justify">'.$descriterio[3].'</td>
				<td width="9%" align="center">'.$desestado[3].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[4]==1){
				  $valpunto=$despunto[4];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			    <td width="59%" align="justify">'.$descriterio[4].'</td>
				<td width="9%" align="center">'.$desestado[4].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[5]==1){
				  $valpunto=$despunto[5];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			    <td width="59%" align="justify">'.$descriterio[5].'</td>
				<td width="9%" align="center">'.$desestado[5].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[6]==1){
				  $valpunto=$despunto[6];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			    <td width="59%" align="justify">'.$descriterio[6].'</td>
				<td width="9%" align="center">'.$desestado[6].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[7]==1){
				  $valpunto=$despunto[7];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			    <td width="59%" align="justify">'.$descriterio[7].'</td>
				<td width="9%" align="center">'.$desestado[7].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[8]==1){
				  $valpunto=$despunto[8];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
				<td width="18%" align="center">CUMPLIMIENTO EN CANTIDADES</td>
				<td width="59%" align="justify">'.$descriterio[8].'</td>
				<td width="9%" align="center">'.$desestado[8].'</td>
				<td width="7%" align="center">10</td>
				<td width="7%" align="center">'.$valpunto.'</td>
			  </tr>
			  
			   ';
			  if($idestado[9]==1){
				  $valpunto=$despunto[9];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			  
			  <tr>
				<td width="18%" align="center">CUMPLIMIENTO EN LOS TIEMPOS DE ENTREGA</td>
				<td width="59%" align="justify">'.$descriterio[9].'</td>
				<td width="9%" align="center">'.$desestado[9].'</td>
				<td width="7%" align="center">10</td>
				<td width="7%" align="center">'.$valpunto.'</td>
			  </tr>
			  
			   ';
			  if($idestado[10]==1){
				  $valpunto=$despunto[10];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			  
			   <tr>
				<td rowspan="2" width="18%" align="center">SERVICIO POSOBRA</td>
				<td width="59%" align="justify">'.$descriterio[10].'</td>
				<td width="9%" align="center">'.$desestado[10].'</td>
				<td rowspan="2" width="7%" align="center">10</td>
				<td width="7%" align="center">'.$valpunto.'</td>
			  </tr>
			  
			   ';
			  if($idestado[11]==1){
				  $valpunto=$despunto[11];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			  
			  <tr>
				<td width="59%" align="justify">'.$descriterio[11].'</td>
				<td width="9%" align="center">'.$desestado[11].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
			  </tr>
			  
			 </table>
			 
			 
			  <table width="99%" border="0">  
			  <tr>
				<td width="100%" align="center">&nbsp;</td>
			  </tr>
			 </table>
			 
			 <table width="99%" border="0">  
			  <tr>
				<td width="100%" align="right"><strong>RESULTADO:</strong> '.$resultado.' ('.$puntaje.' Puntos)<br></td>			 
			  </tr>
			 </table>
			 
			 <table width="99%" border="0.5">
			  <tr>
	     	  <td width="50%" align="justify"><strong>OBSERVACIONES:</strong>&nbsp;'.$observacion.'.</td>
			  <td width="50%" align="center"><br><br><br><br><strong>'.$nombresuper.'</strong><br>'.$cargosuper.'<br><strong>SUPERVISOR</strong></td>
	         </tr>
		    </table>
			
			<table width="100%" border="0">  
			  <tr>
				<td width="100%" align="center">&nbsp;</td>
			  </tr>
			 </table>
			
		 </td>
		</tr> 
	   
	   

	    <tr>
		<td align="center"><strong>CONVENCIONES</strong></td>
	   </tr>
	   
	   
	   	 <table width="100%" border="0.5">  
	   	
		<tr>
			<td rowspan="4" width="18%" align="center"><br><br><br>NIVELES DE CALIFICACIÓN</td>
			<td width="40%" align="justify">Mayor o igual a 90 puntos</td>
			<td width="42%" align="justify"><strong>Excelente:</strong> El contratista se mantiene en el listado de proveedores.</td>
		</tr>
			  
		<tr>
			<td width="40%" align="justify">Mayor o igual a 80 puntos  y Menor a 90 puntos</td>
			<td width="42%" align="justify"><strong>Bueno:</strong> El contratista queda en periodo de prueba.</td>
		</tr>
		
		<tr>
			<td width="40%" align="justify">Mayor o igual a 50 puntos  y Menor a 80 puntos</td>
			<td width="42%" align="justify"><strong>Aceptable:</strong> El contratista queda con 2da opción de compra.</td>
		</tr>
		
		<tr>
			<td width="40%" align="justify">Menor a igual a 50 puntos</td>
			<td width="42%" align="justify"><strong>Insatisfactorio:</strong> El contratista es retirado del listado de proveedores hasta nueva orden.</td>
		</tr>
		
			  		  
		  	 </table>
 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 

	   </table>
	   
	   <IMG SRC="/GUNIG/protected/extensions/tcpdf/tcpdf/images/eva_pie_obras-LIF32.png">
	   
	   
	   ';
  } elseif(($claseevaluacion)==1){
	 /*SI ES UNA EVALUACION DE SERVICIOS */
    
	 
	  //***** AÑADIR PAGINA *****//
	  //$pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 10);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
	  
	   <tr>
		 <td align="center"><strong>INFORMACIÓN DE EVALUACIÓN DEL PROVEEDOR DE '.$nombreclase.'</strong><br></td>
	   </tr>
	  
	  
	  <tr>
		 <td align="center">
		 
			<table width="100%" border="0">
			  <tr>
				<td width="70%" align="left"><strong>PROVEEDOR:</strong> '.$contratista.'</td>
				<td width="30%" align="left"><strong>&nbsp;C.C./NIT:</strong> '.$identificacion.'</td>
			  </tr>
			  
			   <tr>
				<td width="70%" align="left"><strong>CORREO ELECTRONICO:</strong> '.$email.'</td>
				<td width="30%" align="left"><strong>&nbsp;FECHA:</strong> '.$fecha.'</td>
			  </tr>
			  
			  <tr>
				<td width="100%" align="left"><strong>CONTRATO/ORDEN:</strong> '.$tipo.' '.$numerocontrato.' DE '.$clase.' DE  '.$anio_contrato.'<br></td>
			  </tr>		  
			  
			 </table>
			
		 </td>
		</tr> 
	   
	   <tr>
		<td align="center"><strong>CRITERIOS DE EVALUACIÓN PARA PROVEEDORES DE '.$nombreclase.'</strong></td>
	   </tr>
	   
	
	   
	     <tr>
		 <td align="center">
		 
		  '; 
		     foreach($datacriterio as $rows){
			 $criterio = Evamodeloscriterios::model()->findByPk($rows["EMCE_ID"]);
			 $descriterio[] = $criterio->rel_criterios->EVCR_NOMBRE;
			 $idestado[] = $criterio->rel_estados->EVES_ID;
			 $desestado[] = $criterio->rel_estados->EVES_NOMBRE;
			 $despunto[] = $criterio->rel_criterios->EVCR_PUNTO;
			 }
				 
	$html .='
		 
		 <br>
		 
			<table width="99%" border="0">
			<tr>
	     	<td align="center">&nbsp;</td>
	       </tr>
		    </table>
			
			<table width="99%" border="0.7">  
			  <tr>
				<td width="18%" align="center">Tipo de Criterio</td>
				<td width="59%" align="center">Descripción</td>
				<td width="9%" align="center">¿Cumple?</td>
				<td width="7%" align="center">Max.</td>
				<td width="7%" align="center">Asig.</td>
			  </tr>
			  
			  ';
			  if($idestado[0]==1){
				  $valpunto=$despunto[0];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			  
			   <tr>
				<td rowspan="4" width="18%" align="center"><br><br><br><br>CALIDAD DEL SERVICIO</td>
				<td width="59%" align="justify">'.$descriterio[0].'</td>
				<td width="9%" align="center">'.$desestado[0].'</td>
				<td rowspan="4" width="7%" align="center"><br><br><br><br>60</td>
				<td width="7%" align="center">'.$valpunto.'</td>
			  </tr>
			  
			  ';
			  if($idestado[1]==1){
				  $valpunto=$despunto[1];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			  
			  <tr>
				<td width="59%" align="justify">'.$descriterio[1].'</td>
				<td width="9%" align="center">'.$desestado[1].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
			  </tr>
			  
			   ';
			  if($idestado[2]==1){
				  $valpunto=$despunto[2];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			  
			  <tr>
			    <td width="59%" align="justify">'.$descriterio[2].'</td>
				<td width="9%" align="center">'.$desestado[2].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[3]==1){
				  $valpunto=$despunto[3];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			    <td width="59%" align="justify">'.$descriterio[3].'</td>
				<td width="9%" align="center">'.$desestado[3].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[4]==1){
				  $valpunto=$despunto[4];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			    <td width="18%" align="center">CUMPLIMIENTO EN LOS TIEMPOS DE ENTREGA</td>
			    <td width="59%" align="justify">'.$descriterio[4].'</td>
				<td width="9%" align="center">'.$desestado[4].'</td>
				<td width="7%" align="center">10</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[5]==1){
				  $valpunto=$despunto[5];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			 	<td width="18%" align="center">CUMPLIMIENTO EN CANTIDADES</td>
			    <td width="59%" align="justify">'.$descriterio[5].'</td>
				<td width="9%" align="center">'.$desestado[5].'</td>
				<td width="7%" align="center">10</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[6]==1){
				  $valpunto=$despunto[6];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
				<td rowspan="2" width="18%" align="center">SERVICIO POSVENTA</td>
			    <td width="59%" align="justify">'.$descriterio[6].'</td>
				<td width="9%" align="center">'.$desestado[6].'</td>
				<td rowspan="2" width="7%" align="center">10</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[7]==1){
				  $valpunto=$despunto[7];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			    <td width="59%" align="justify">'.$descriterio[7].'</td>
				<td width="9%" align="center">'.$desestado[7].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[8]==1){
				  $valpunto=$despunto[8];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			  
			 </table>
			 
			 
			  <table width="99%" border="0">  
			  <tr>
				<td width="100%" align="center">&nbsp;</td>
			  </tr>
			 </table>
			 
			 <table width="99%" border="0">  
			  <tr>
				<td width="100%" align="right"><strong>RESULTADO:</strong> '.$resultado.' ('.$puntaje.' Puntos)<br></td>			 
			  </tr>
			 </table>
			 
			 <table width="99%" border="0.5">
			  <tr>
	     	  <td width="50%" align="justify"><strong>OBSERVACIONES:</strong>&nbsp;'.$observacion.'.</td>
			  <td width="50%" align="center"><br><br><br><br><strong>'.$nombresuper.'</strong><br>'.$cargosuper.'<br><strong>SUPERVISOR</strong></td>
	         </tr>
		    </table>
			
			<table width="100%" border="0">  
			  <tr>
				<td width="100%" align="center">&nbsp;</td>
			  </tr>
			 </table>
			
		 </td>
		</tr> 
	   
	   

	    <tr>
		<td align="center"><strong>CONVENCIONES</strong></td>
	   </tr>
	   
	   
	   	 <table width="100%" border="0.5">  
	   	
		<tr>
			<td rowspan="4" width="18%" align="center"><br><br><br>NIVELES DE CALIFICACIÓN</td>
			<td width="40%" align="justify">Mayor o igual a 90 puntos</td>
			<td width="42%" align="justify"><strong>Excelente:</strong> El contratista se mantiene en el listado de proveedores.</td>
		</tr>
			  
		<tr>
			<td width="40%" align="justify">Mayor o igual a 80 puntos  y Menor a 90 puntos</td>
			<td width="42%" align="justify"><strong>Bueno:</strong> El contratista queda en periodo de prueba.</td>
		</tr>
		
		<tr>
			<td width="40%" align="justify">Mayor o igual a 50 puntos  y Menor a 80 puntos</td>
			<td width="42%" align="justify"><strong>Aceptable:</strong> El contratista queda con 2da opción de compra.</td>
		</tr>
		
		<tr>
			<td width="40%" align="justify">Menor a igual a 50 puntos</td>
			<td width="42%" align="justify"><strong>Insatisfactorio:</strong> El contratista es retirado del listado de proveedores hasta nueva orden.</td>
		</tr>
		
			  		  
	   </table>
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	    
		
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   
	   
	   </table>
	
	   
	    <IMG SRC="/GUNIG/protected/extensions/tcpdf/tcpdf/images/eva_pie_serv-LIF31.png">

	   
	   
	   ';
  }elseif(($claseevaluacion)==2){
	 /*SI ES UNA EVALUACION DE BIENES */
    
	 
	  //***** AÑADIR PAGINA *****//
	  //$pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 10);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
	  
	   <tr>
		 <td align="center"><strong>INFORMACIÓN DE EVALUACIÓN DEL PROVEEDOR DE '.$nombreclase.'</strong><br></td>
	   </tr>
	  
	  
	  <tr>
		 <td align="center">
		 
			<table width="100%" border="0">
			  <tr>
				<td width="70%" align="left"><strong>PROVEEDOR:</strong> '.$contratista.'</td>
				<td width="30%" align="left"><strong>&nbsp;C.C./NIT:</strong> '.$identificacion.'</td>
			  </tr>
			  
			   <tr>
				<td width="70%" align="left"><strong>CORREO ELECTRONICO:</strong> '.$email.'</td>
				<td width="30%" align="left"><strong>&nbsp;FECHA:</strong> '.$fecha.'</td>
			  </tr>
			  
			  <tr>
				<td width="100%" align="left"><strong>CONTRATO/ORDEN:</strong> '.$tipo.' '.$numerocontrato.' DE '.$clase.' DE  '.$anio_contrato.'<br></td>
			  </tr>		  
			  
			 </table>
			
		 </td>
		</tr> 
	   
	   <tr>
		<td align="center"><strong>CRITERIOS DE EVALUACIÓN PARA PROVEEDORES DE '.$nombreclase.'</strong></td>
	   </tr>
	   
	
	   
	     <tr>
		 <td align="center">
		 
		  '; 
		     foreach($datacriterio as $rows){
			 $criterio = Evamodeloscriterios::model()->findByPk($rows["EMCE_ID"]);
			 $descriterio[] = $criterio->rel_criterios->EVCR_NOMBRE;
			 $idestado[] = $criterio->rel_estados->EVES_ID;
			 $desestado[] = $criterio->rel_estados->EVES_NOMBRE;
			 $despunto[] = $criterio->rel_criterios->EVCR_PUNTO;
			 }
				 
	$html .='
		 
		 <br>
		 
			<table width="99%" border="0">
			<tr>
	     	<td align="center">&nbsp;</td>
	       </tr>
		    </table>
			
			<table width="99%" border="0.7">  
			  <tr>
				<td width="18%" align="center">Tipo de Criterio</td>
				<td width="59%" align="center">Descripción</td>
				<td width="9%" align="center">¿Cumple?</td>
				<td width="7%" align="center">Max.</td>
				<td width="7%" align="center">Asig.</td>
			  </tr>
			  
			  ';
			  if($idestado[0]==1){
				  $valpunto=$despunto[0];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			  
			   <tr>
				<td rowspan="2" width="18%" align="center"><br><br>CALIDAD DEL SERVICIO</td>
				<td width="59%" align="justify">'.$descriterio[0].'</td>
				<td width="9%" align="center">'.$desestado[0].'</td>
				<td rowspan="2" width="7%" align="center"><br><br>60</td>
				<td width="7%" align="center">'.$valpunto.'</td>
			  </tr>
			  
			  ';
			  if($idestado[1]==1){
				  $valpunto=$despunto[1];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			  
			  <tr>
				<td width="59%" align="justify">'.$descriterio[1].'</td>
				<td width="9%" align="center">'.$desestado[1].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
			  </tr>
			  
			   ';
			  if($idestado[2]==1){
				  $valpunto=$despunto[2];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			  
			  <tr>
			  	<td width="18%" align="center">CUMPLIMIENTO EN LOS TIEMPOS DE ENTREGA</td>
			    <td width="59%" align="justify">'.$descriterio[2].'</td>
				<td width="9%" align="center">'.$desestado[2].'</td>
				<td width="7%" align="center">20</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[3]==1){
				  $valpunto=$despunto[3];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			    <td width="18%" align="center">CUMPLIMIENTO EN CANTIDADES</td>
			    <td width="59%" align="justify">'.$descriterio[3].'</td>
				<td width="9%" align="center">'.$desestado[3].'</td>
				<td width="7%" align="center">15</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[4]==1){
				  $valpunto=$despunto[4];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			    <td rowspan="3" width="18%" align="center"><br><br>SERVICIO POSVENTA</td>
			    <td width="59%" align="justify">'.$descriterio[4].'</td>
				<td width="9%" align="center">'.$desestado[4].'</td>
				<td rowspan="3" width="7%" align="center"><br><br>5</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[5]==1){
				  $valpunto=$despunto[5];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			    <td width="59%" align="justify">'.$descriterio[5].'</td>
				<td width="9%" align="center">'.$desestado[5].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  ';
			  if($idestado[6]==1){
				  $valpunto=$despunto[6];
				  }else {
					$valpunto="0";
					  }
			  $html .='
			 
			 <tr>
			    <td width="59%" align="justify">'.$descriterio[6].'</td>
				<td width="9%" align="center">'.$desestado[6].'</td>
				<td width="7%" align="center">'.$valpunto.'</td>
 			 </tr>
			 
			  
			  
			 </table>
			 
			 
			  <table width="99%" border="0">  
			  <tr>
				<td width="100%" align="center">&nbsp;</td>
			  </tr>
			 </table>
			 
			 <table width="99%" border="0">  
			  <tr>
				<td width="100%" align="right"><strong>RESULTADO:</strong> '.$resultado.' ('.$puntaje.' Puntos)<br></td>			 
			  </tr>
			 </table>
			 
			 <table width="99%" border="0.5">
			  <tr>
	     	  <td width="50%" align="justify"><strong>OBSERVACIONES:</strong>&nbsp;'.$observacion.'.</td>
			  <td width="50%" align="center"><br><br><br><br><strong>'.$nombresuper.'</strong><br>'.$cargosuper.'<br><strong>SUPERVISOR</strong></td>
	         </tr>
		    </table>
			
			<table width="100%" border="0">  
			  <tr>
				<td width="100%" align="center">&nbsp;</td>
			  </tr>
			 </table>
			
		 </td>
		</tr> 
	   
	   

	    <tr>
		<td align="center"><strong>CONVENCIONES</strong></td>
	   </tr>
	   
	   
	   	 <table width="100%" border="0.5">  
	   	
		<tr>
			<td rowspan="4" width="18%" align="center"><br><br><br>NIVELES DE CALIFICACIÓN</td>
			<td width="40%" align="justify">Mayor o igual a 90 puntos</td>
			<td width="42%" align="justify"><strong>Excelente:</strong> El contratista se mantiene en el listado de proveedores.</td>
		</tr>
			  
		<tr>
			<td width="40%" align="justify">Mayor o igual a 80 puntos  y Menor a 90 puntos</td>
			<td width="42%" align="justify"><strong>Bueno:</strong> El contratista queda en periodo de prueba.</td>
		</tr>
		
		<tr>
			<td width="40%" align="justify">Mayor o igual a 50 puntos  y Menor a 80 puntos</td>
			<td width="42%" align="justify"><strong>Aceptable:</strong> El contratista queda con 2da opción de compra.</td>
		</tr>
		
		<tr>
			<td width="40%" align="justify">Menor a igual a 50 puntos</td>
			<td width="42%" align="justify"><strong>Insatisfactorio:</strong> El contratista es retirado del listado de proveedores hasta nueva orden.</td>
		</tr>
		
			 </table>
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	    
		<tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	     <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	     <tr>
		<td width="100%" align="left">&nbsp;</td>
	   </tr> 
	   
	   
	   </table>
	
	   
	    <IMG SRC="/GUNIG/protected/extensions/tcpdf/tcpdf/images/eva_pie_bienes-LIF30.png">

	  
	  
	  
	   ';


  }
   
   
   $pdf->SetFont('times', 'K', 10);
   $pdf->writeHTML($html, true, 0, true, 0);
 }
 $pdf->Output("$NombreDocumento.pdf", 'D');  
    
  Yii::app()->end();
?>