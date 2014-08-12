<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'pt', 'A4', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  $phpNumToLetterPath = Yii::getPathOfAlias('ext');
  include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
  $NumberToLetters = new EnLetras();
  
  
  $autor='ING. JESUS GABRIEL AREVALO AGUILAR - UNIVERSIDAD DE LA GUAJIRA';  
  $Numero = $Contratos->numOrden;     
  $titulo="ANEXOS-INVITACION";
  $palabrasClaves='CONTRATO, ORDENES, CONTRATACION';
  $Sujeto='ORDENES';
  $NombreDocumento=$titulo;
  $logo="tcpdf_logo.jpg";
  
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
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
  $pdf->setPrintFooter(true);
	
  // Saltos de página automáticos.
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
  // Establecer el ratio para las imagenes que se puedan utilizar
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
   function NombreMes($m){
   switch ($m){
    case 1: return "Enero";
    case 2: return "Febrero";
    case 3: return "Marzo";
    case 4: return "Abril";
    case 5: return "Mayo";
    case 6: return "Junio";
    case 7: return "Julio";
    case 8: return "Agosto";
    case 9: return "Septiembre";
    case 10: return "Octubre";
    case 11: return "Noviembre";
    case 12: return "Diciembre";
   }
  }
 
  $id = "";
  if($_REQUEST["id"]){
   $id = $_REQUEST["id"];
  }

	$data = $Modeloordenes->downloadInvitados($id,$Invitaciones);
	$datacontratista = $Modeloordenes->contratista($id);
	$datarector = $Modeloordenes->rectorinvitacion($id,$Invitaciones);
	
	
	$datainvitados = $Modeloordenes->invitados($id);
    $numeroinvitados =count($datainvitados);
   

//    $datacontratista = $Modeloordenes->contratista($id);
 
	foreach($data as $rows){
	  /* CONFIGURANDO LA FECHA Y PRESUPUESTO (FORMULARIO INVITACION) */
	  $dia_contrato = date("d",strtotime($Invitaciones->CONT_FECHAINVITACION));
	  $mes_contrato=NombreMes(date("m",strtotime($Invitaciones->CONT_FECHAINVITACION)));
	  $anio_contrato= date("Y",strtotime($Invitaciones->CONT_FECHAINVITACION)); 
	  $fecha = $dia_contrato." de ".$mes_contrato." de ".$anio_contrato;
	  $presupuestooficial=$Invitaciones->CONT_PRESUPUESTOOFICIAL; 
 	  $presuoficialtoLetras = strtoupper($NumberToLetters->ValorEnLetras($presupuestooficial,"PESOS"));
	  $presuoficial=number_format($presupuestooficial);
  
  $criteria = new CDbCriteria;
  $criteria->condition = 'MOOR_ID = '.$Modeloordenes->MOOR_ID;		
 // $Modeloordenes = Modeloordenes::model()->findByPk($criteria);	
 $Modeloordenes = Modeloordenes::model()->findByPk($rows["MOOR_ID"]);
  
 
  $dire = strtolower($Modeloordenes->rel_contrato->Persona->PERS_DIRECCION);
  $dir = ucwords ($dire);
  $telefono =$Modeloordenes->rel_contrato->Persona->PERS_TELEFONO;
  $objeto= trim($Modeloordenes->MOOR_OBJETO); 	
		
	
   /* OBTENIENDO EL TIPO Y LA CLASE DEL CONTRATO */	
  $tipo = $Modeloordenes->rel_contrato->tICO->TICO_ID;	
  
  if($tipo==1){
	  $tipocontrato ="del respectivo contrato";
	  }elseif($tipo==2){
		  $tipocontrato ="de la respectiva orden";
		  }
		  
		  
	//OBTENIENDO EL RECTOR EN LA FECHA 
	$rectorvalida=$datarector["PENA_ID"];
	if($rectorvalida==NULL){
	$rector="CARLOS ARTURO ROBLES JULIO";
	$conrector="Rector";
	}elseif($rectorvalida!=NULL){
		$rector=$datarector["PENA_NOMBRES"].' '.$datarector["PENA_APELLIDOS"];
		$conrector=$datarector["PECO_DESCRIPCION"];
		}
	
	if($datarector==100000){
	$criteria = new CDbCriteria;
  	$criteria->condition = 'CONT_ID = '.$Modeloordenes->MOOR_ID;		
 	$ModeloordenesContratante = Modeloordenes::model()->findByPk($rows["MOOR_ID"]);
	
	//$rector = '<strong>'.$ModeloordenesContratante->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		//  				'.$ModeloordenesContratante->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>'; 
	$conrector = $ModeloordenesContratante->rel_contrato->rel_contratantes->PECO_DESCRIPCION;
	}
  
  
  /* OBTENIENDO EL NOMBRE DEL CONTRATISTA - EMPRESA */	
if ($datacontratista>0) {
	//si es una persona natural
	$contratista = $html.=$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
	'.$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'
	';
	$condescon=$contratista." <br/>Contratista";
	$cedula=$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION;
	$luagraexpedicion=$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD;
	$domicilio=$Modeloordenes->rel_contrato->Persona->rel_municipios->MUNI_NOMBRE."(".$Modeloordenes->rel_contrato->Persona->rel_departamentos->DEPA_NOMBRE.")";
	$ContratistaContratos = "<strong>".$contratista."</strong> mayor de edad, identificado(a) con la cédula de ciudadanía No. ".$cedula." expedida en ".$luagraexpedicion." quien actúa en nombre propio, con domicilio en ".$domicilio.", en adelante y para efectos del presente contrato se denominará <strong>EL CONTRATISTA</strong> y en consideración a:";

	$ContristaInvitacion="<strong>".$contratista."</strong> <br/> CC: ".$cedula.", Expedida en ".$luagraexpedicion."<br/>Dirección: ".$dir." / ".$domicilio."<br/>Telefono: ".$telefono."<br/>E.   S.	M.";
	
	}else{
		
	//si es una persona juridica
	$contratista=$html.=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.''; 
	$r=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->PENA_NOMBRES.'
	'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->PENA_APELLIDOS;
	$nit=$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION;
	$cedula=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION;
	$luagraexpedicion=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD;
	$domicilio=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas->rel_municipios->MUNI_NOMBRE." (".$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas->rel_departamentos->DEPA_NOMBRE.")";
	
		$ContristaInvitacion="<strong>".$r."</strong> <br/> Representante Legal <br/> <strong>".$contratista."</strong> <br/>NIT: ".$nit."<br/> Dirección: ".$dir." / ".$domicilio."<br/>Telefono: ".$telefono."<br/>E.   S.	M.";
	
	
	}

	
  }
 
 

	//***** AÑADIR PAGINA *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
	    <tr>
		 <td align="left">'.$ContristaInvitacion.'
	    </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
			
		 
	   </table>
	   ';
	
	
	
$pdf->SetFont('times', 'K', 11);
$pdf->writeHTML($html, true, 0, true, 0);
  	
	 foreach($datainvitados as $rows){
			 $invitados = Invitados::model()->findByPk($rows["INVI_ID"]);
			 $invitado[] = $invitados->INVI_NOMBRE;
			 $invitadodir[] = $invitados->INVI_DIRECCION;
			 $invitadolugar[] = $invitados->INVI_LUGAR;
			 $invitadotel[] = $invitados->INVI_TELEFONO;
			 
			 }
				 if ($numeroinvitados==1) { 
					$ini1=$invitado[0];									 
					$inidir1=$invitadodir[0];				
					$inilugar1=$invitadolugar[0];			
					$initel1=$invitadotel[0];
					
					
									//***** AÑADIR PAGINA DE INVITADOS 1 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini1.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir1.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar1.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel1.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
	
	
  
   $pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
   
					
												
				 } elseif($numeroinvitados==2) { 
					$ini1=$invitado[0];
					$ini2=$invitado[1];
					 
					$inidir1=$invitadodir[0];
					$inidir2=$invitadodir[1];
										
					$inilugar1=$invitadolugar[0];
					$inilugar2=$invitadolugar[1];
										
					$initel1=$invitadotel[0];
					$initel2=$invitadotel[1];
					
					
						//***** AÑADIR PAGINA DE INVITADOS 1 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini1.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir1.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar1.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel1.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
	
	
	
	
  
   $pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
   
   
   //***** AÑADIR PAGINA DE INVITADOS 2 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini2.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir2.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar2.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel2.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
		$pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
	
	

									 
				 } elseif($numeroinvitados==3) { 
					$ini1=$invitado[0];
					$ini2=$invitado[1];
					$ini3=$invitado[2];
					
					$inidir1=$invitadodir[0];
					$inidir2=$invitadodir[1];
					$inidir3=$invitadodir[2];
					
					$inilugar1=$invitadolugar[0];
					$inilugar2=$invitadolugar[1];
					$inilugar3=$invitadolugar[2];
					
					$initel1=$invitadotel[0];
					$initel2=$invitadotel[1];
					$initel3=$invitadotel[2];
					
					
						//***** AÑADIR PAGINA DE INVITADOS 1 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini1.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir1.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar1.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel1.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
	
	
	
	
  
   $pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
   
   
   //***** AÑADIR PAGINA DE INVITADOS 2 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini2.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir2.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar2.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel2.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
	
	
	
	
   $pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
   
   
   //***** AÑADIR PAGINA DE INVITADOS 3 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini3.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir3.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar3.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel3.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
  	
	 $pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);

					
					
				 } elseif($numeroinvitados==4) { 
					$ini1=$invitado[0];
					$ini2=$invitado[1];
					$ini3=$invitado[2];
					$ini4=$invitado[3];
					
					$inidir1=$invitadodir[0];
					$inidir2=$invitadodir[1];
					$inidir3=$invitadodir[2];
					$inidir4=$invitadodir[3];
					
					$inilugar1=$invitadolugar[0];
					$inilugar2=$invitadolugar[1];
					$inilugar3=$invitadolugar[2];
					$inilugar4=$invitadolugar[3];
					
					$initel1=$invitadotel[0];
					$initel2=$invitadotel[1];
					$initel3=$invitadotel[2];
					$initel4=$invitadotel[3];
					
					//***** AÑADIR PAGINA DE INVITADOS 1 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini1.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir1.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar1.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel1.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
	
	
	
	
  
   $pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
   
   
   //***** AÑADIR PAGINA DE INVITADOS 2 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini2.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir2.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar2.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel2.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
	
	
	
	
   $pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
   
   
   //***** AÑADIR PAGINA DE INVITADOS 3 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini3.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir3.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar3.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel3.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
  	
	
	 $pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
   
   //***** AÑADIR PAGINA DE INVITADOS 4 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini4.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir4.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar4.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel4.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
		$pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
								
				 } elseif($numeroinvitados==5) { 
					$ini1=$invitado[0];
					$ini2=$invitado[1];
					$ini3=$invitado[2];
					$ini4=$invitado[3];
					$ini5=$invitado[4];
					 
					$inidir1=$invitadodir[0];
					$inidir2=$invitadodir[1];
					$inidir3=$invitadodir[2];
					$inidir4=$invitadodir[3];
					$inidir5=$invitadodir[4];
										
					$inilugar1=$invitadolugar[0];
					$inilugar2=$invitadolugar[1];
					$inilugar3=$invitadolugar[2];
					$inilugar4=$invitadolugar[3];
					$inilugar5=$invitadolugar[4];
										
					$initel1=$invitadotel[0];
					$initel2=$invitadotel[1];
					$initel3=$invitadotel[2];
					$initel4=$invitadotel[3];
					$initel5=$invitadotel[4];
										 
					 		//***** AÑADIR PAGINA DE INVITADOS 1 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini1.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir1.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar1.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel1.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
	
	
	
	
  
   $pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
   
   
   //***** AÑADIR PAGINA DE INVITADOS 2 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini2.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir2.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar2.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel2.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
	
	
	
	
   $pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
   
   
   //***** AÑADIR PAGINA DE INVITADOS 3 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini3.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir3.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar3.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel3.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
  	
	
	 $pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
   
   //***** AÑADIR PAGINA DE INVITADOS 4 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini4.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir4.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar4.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel4.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
				
				
				 $pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);
   
   //***** AÑADIR PAGINA DE INVITADOS 5 DE 5 *****//
	  $pdf->SetFont('times', 'B', '20', true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   	<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		
		<td align="center">&nbsp;</td>
	   </tr>
		<tr>
		 <td align="left">Riohacha, '.$fecha.' </td>
		</tr>
		<tr>
	    <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		<td align="center">&nbsp;</td>
	   </tr>	
		<tr>
		 <td align="left">Señor (a):</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$ini5.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$inidir5.'</td>
		</tr>
		<tr>
		 <td align="left">'.$inilugar5.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$initel5.'</td>
		</tr>
		<tr>
		 <td align="left">E.&nbsp;S.&nbsp;M.</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"></td>
		</tr>
		
					<table width="100%" border="1">
					  <tr>
						<td align="left"><strong>&nbsp;REF.- &nbsp;INVITACIÓN A PRESENTAR PROPUESTA </strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		 
		<tr>
		 <td align="justify">De manera atenta me permito solicitar se sirva presentar una propuesta para: <strong>'.$objeto.'</strong>. De conformidad a las especificaciones de la solicitud de trámite de contrato, la cual puede ser consultada en la Oficina de Contratación de la Universidad de La Guajira, bloque administrativo piso 2. Presupuesto oficial: '.$presuoficialtoLetras.' ($'.$presuoficial.').</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="justify">Solicito a usted presentar junto con la propuesta los documentos requisitos establecidos en la ley para la elaboración '.$tipocontrato.'.</td>
		</tr>
			  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left">Atentamente, </td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="left"><strong>'.$rector.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$conrector.'</td>
		</tr>
		
		
		</table>
		';
				 
			$pdf->SetFont('times', 'K', 11);
   $pdf->writeHTML($html, true, 0, true, 0);		 
					 
				 } 
				 
				 
				/* elseif($numeroinvitados==6) { 
					$ini1=$invitado[0];
					$ini2=$invitado[1];
					$ini3=$invitado[2];
					$ini4=$invitado[3];
					$ini5=$invitado[4];
					$ini6=$invitado[5];
					
					$inidir1=$invitadodir[0];
					$inidir2=$invitadodir[1];
					$inidir3=$invitadodir[2];
					$inidir4=$invitadodir[3];
					$inidir5=$invitadodir[4];
					$inidir6=$invitadodir[5];
					
					$inilugar1=$invitadolugar[0];
					$inilugar2=$invitadolugar[1];
					$inilugar3=$invitadolugar[2];
					$inilugar4=$invitadolugar[3];
					$inilugar5=$invitadolugar[4];
					$inilugar6=$invitadolugar[5];
					
					$initel1=$invitadotel[0];
					$initel2=$invitadotel[1];
					$initel3=$invitadotel[2];
					$initel4=$invitadotel[3];
					$initel5=$invitadotel[4];
					$initel6=$invitadotel[5];
					
	
				 }    */

		
		
	
	
 $pdf->Output("$NombreDocumento.pdf", 'D');  
    
  Yii::app()->end();
?>