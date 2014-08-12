<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'pt', 'Legal', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  $phpNumToLetterPath = Yii::getPathOfAlias('ext');
  include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
  $NumberToLetters = new EnLetras();
  
  
  $autor='ING. JESUS GABRIEL AREVALO AGUILAR - UNIVERSIDAD DE LA GUAJIRA';  
  $Numero = $Contratos->numOrden;     
  $titulo="ADICIONAL";
  $palabrasClaves='CONTRATO, ORDENES, CONTRATACION';
  $Sujeto='CONTRATOS EN GENERAL';
  $NombreDocumento=$titulo;
  $logo="tcpdf_logo.jpg";
  
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', true);
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
  $pdf->SetAutoPageBreak(TRUE, 12);
	
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
 
  //Contratosadicionales

  $data = $Contratosadicionales->downloadContratos($id);
  
  $datacontratista = $Contratosadicionales->contratista($id);
 
  foreach($data as $rows){
  $Contratosadicionales = Contratosadicionales::model()->findByPk($rows["COAD_ID"]);
   
   
  /* CONFIGURANDO LA DURACION DEL CONTRATO */
  $mesesContrato = $Contratosadicionales->COAD_MESES;
  $mesesContratoLetras = $NumberToLetters->ValorEnLetras($mesesContrato,'');
  $diasContrato = $Contratosadicionales->COAD_DIAS;
  $diasContratoLetras = $NumberToLetters->ValorEnLetras($diasContrato,'');

  if(($mesesContrato>0) & $diasContrato>0){
   $mesesPlazo = strtoupper($NumberToLetters->ValorEnLetras($mesesContrato,''))." (".$mesesContrato.") MES(ES)";
   $diaPlazo = " y ".strtoupper($NumberToLetters->ValorEnLetras($diasContrato,''))." (".$diasContrato.") DIA(S)";
   $dura=$mesesPlazo.''.$diaPlazo;
  }else{
	 if($mesesContrato>0 & $diasContrato==0){
	 $mesesPlazo = strtoupper($NumberToLetters->ValorEnLetras($mesesContrato,''))." (".$mesesContrato.") MES(ES)";   
	 $dura=$mesesPlazo;
	  }else{
		 if($diasContrato>0){
		 $diaPlazo = strtoupper($NumberToLetters->ValorEnLetras($diasContrato,''))." (".$diasContrato.") DIA(S)";
		 $dura=$diaPlazo;
		    }
	   	}
	 }
	 
	 
  /* OBTENIENDO EL TIEMPO DEL ADICIONAL*/
  $tiempo= ($mesesContrato*30)+($diasContrato);
  /* OBTENIENDO EL VALOR DEL ADICIONAL*/
  $valorContrato = $Contratosadicionales->COAD_VALOR;  
  $valorAdicional= ($valorContrato/30)*$tiempo;
  $valorAdicionalLetras = strtoupper($NumberToLetters->ValorEnLetras($valorAdicional,"PESOS"));
  //$valorAdicionalCon4xMil = (($valoradicional)+($valoradicional*4/1000));
	 
	/* CONFIGURANDO LA FECHA Y CONTRATISTA */
  $dia_contrato = date("d",strtotime($Contratosadicionales->COAD_FECHAELABORACION));
  $mes_contrato=NombreMes(date("m",strtotime($Contratosadicionales->COAD_FECHAELABORACION)));
  $anio_contrato= date("Y",strtotime($Contratosadicionales->COAD_FECHAELABORACION));
  $fecha = $dia_contrato." de ".$mes_contrato." de ".$anio_contrato;
  $fechaadicional = $dia_contrato." días del mes de ".$mes_contrato." de año ".$anio_contrato;
  
  $dia_ante = "01";
  $mes_ante= "Agosto";
  $anio_ante= "2013";
  $fechadelcontrato = $dia_ante." del mes de ".$mes_ante." de año ".$anio_ante;
  
  $cdp = $Contratosadicionales->aDPR->Presupuesto->PRES_NOMBRE;
  
  $Contratosadicionales->COAD_FECHAELABORACION;
	 
 /* OBTENIENDO DATOS DEL CONTRATO*/	
  $numero = $Contratosadicionales->rel_contrato->CONT_NUMORDEN;
  $numerocontrato = substr($numero, -3); 	
  //$objeto= trim($Contratosadicionales->MOOR_OBJETO); 
  $objeto = "xxxxxxxx";
  
  $numadicional = $Contratosadicionales->COAD_NUMADICIONAL;
  $tipo = $Contratosadicionales->rel_contrato->tICO->TICO_NOMBRE;
  $clase = $Contratosadicionales->rel_contrato->cLCO->CLCO_NOMBRE;	
  
  $tipoclase=$Contratosadicionales->rel_contrato->CLCO_ID;
  
  if ($tipoclase=14){
	  $titulo1 = "ADICIONAL No. ".$numadicional." A LA ".$tipo." ".$numerocontrato." DE PRESTACION DE SERVICIOS DE  ".$anio_contrato."";
	  $titulo2 = "LA ".$tipo." ".$numerocontrato." DE PRESTACION DE SERVICIOS DE ".$anio_contrato.""; 
	  //$tipoadicion ="el valor y el plazo  de  ejecución  y  vigencia";
	  }
	  
  
  /* OBTENIENDO EL NOMBRE DEL CONTRATISTA - RECTOR - EMPRESA */	
	if ($datacontratista>0) {
	//si es una persona natural
	$contratista = $html.=$Contratosadicionales->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
	'.$Contratosadicionales->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'';
	$condescon=$contratista." <br/>Contratista";
	$cedula=$Contratosadicionales->rel_contrato->Persona->PERS_IDENTIFICACION;
	$luagraexpedicion=$Contratosadicionales->rel_contrato->Persona->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD;

	$contratante= $Contratosadicionales->rel_contratantes->rel_personas_naturales->PENA_NOMBRES." ".$Contratosadicionales->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS;
	$cedulacontratante=$Contratosadicionales->rel_contratantes->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION;
	$lugarexpecontratante=$Contratosadicionales->rel_contratantes->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD;
	$condicionrector=$Contratosadicionales->rel_contratantes->PECO_DESCRIPCION;
	$designacion=$Contratosadicionales->rel_contratantes->rel_resoluciones->REAC_DESCRIPCION;
	
$texto1="Entre los suscritos a saber: <strong>".$contratante."</strong>, mayor de edad, identificado(a) con la cédula de ciudadanía No. ".$cedulacontratante." Expedida en ".$lugarexpecontratante." quien actúa en nombre y representación legal de LA UNIVERSIDAD DE LA GUAJIRA, identificada con el Nit. 892.115.029-4, en su condición de ".$condicionrector." ".$designacion.", quien obra en el presente acto en calidad de Representante Legal de la UNIVERSIDAD DE LA GUAJIRA, ente universitario identificado con NIT. 892.115.029-4, reconocido como tal mediante Resolución No. 1770 del 24 de junio de 1995 expedida por el Ministerio de Educación Nacional, como ente universitario autónomo del orden departamental, con domicilio en la ciudad de Riohacha, que goza de autonomía académica y administrativa, personería jurídica y patrimonio propio e independiente, se orienta por el régimen especial para la educación superior y vinculado al Ministerio de Educación Nacional en lo que se refiere a las políticas y la planeación educativa según la Ley 30 de 1992, el Acuerdo 014 de 2011 o Estatuto General de la Universidad y el Acuerdo 005 de 2006 o Estatuto Profesoral, expedidos por el Consejo Superior de la Universidad, en adelante se denominará <strong>LA UNIVERSIDAD</strong>, por una parte y por la otra parte <strong>".$contratista.",</strong> mayor de edad, identificado con la Cédula de Ciudadanía No. ".$cedula." Expedida en ".$luagraexpedicion.", quien para los efectos legales de este instrumento en adelante se denominará  <strong>EL CONTRATISTA</strong>, hemos acordado en celebrar el presente ".$titulo1.", previas las siguientes consideraciones: <strong>a)</strong> Que el Artículo 44 del Estatuto de Contratación de la Universidad, establece la posibilidad de modificar los Contratos de común acuerdo entre las partes a fin de adicionarlos. <strong>b)</strong> Que el día ".$fechadelcontrato.", La Universidad y el Contratista suscribierón ".$titulo2.". <strong>c)</strong> Que el objeto de la orden es ".$objeto.". <strong>d)</strong> Que en razón a las necesidades del servicio y atendiendo a que la entidad no cuenta con el personal de planta requerido para realizar las actividades objeto del presente contrato, las partes acuerdan adicionar el valor y el plazo  de  ejecución  y  vigencia de ".$titulo2.".";


	}else{

	//si es una persona juridica
	$contratista=$html.=$Contratosadicionales->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.'';
	$nit= $Contratosadicionales->rel_contrato->Persona->PERS_IDENTIFICACION.'';
	$r=$Contratosadicionales->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->PENA_NOMBRES.'
	'.$Contratosadicionales->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->PENA_APELLIDOS;
	$condescon=$r."<br/> Representante Legal <br/>" .$contratista."<br/> Contratista";
	$cedula=$Contratosadicionales->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION;
	$luagraexpedicion=$Contratosadicionales->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD;
	
	}
	 
	 
 if(($Contratosadicionales->TIAD_ID)==1){
	 /*SI ES UN ADICIONAL DE TIEMPO Y VALOR */

	  //***** AÑADIR PAGINA *****//
	  //$pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 10);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center"><strong>'.$titulo1.'</strong></td>
	   </tr>
	   <tr>
		 <td align="center"></td>
	   </tr>
	   <tr>
		 <td align="left"> 
			 <table width="100%" border="1">
			  <tr>
				<td width="40%">CONTRATANTE</td>
				<td width="60%">: UNIVERSIDAD DE LA GUAJIRA</td>
			  </tr>
			  <tr>
				<td width="40%">CONTRATISTA</td>
				<td width="60%">: '.$contratista.'</td>
			  </tr>
			</table>
		 
		 </td>
	  </tr>
	  
	   <tr>
		 <td align="center"></td>
	   </tr>
	   
	   <tr>
	    <td align="justify">
		'.$texto1.'
		 <strong><u>CLAUSULA PRIMERA - ADICION VALOR:</u></strong>
		 Adicionar el valor del contrato principal en la suma de
		  <strong>'.$valorAdicionalLetras.'($'.number_format($valorAdicional).')</strong>. 
		  Según Certificado de Disponibilidad Presupuestal '.$cdp.'.
		 
		 <strong><u>CLAUSULA SEGUNDA - ADICION PLAZO:</u></strong>
		 Adicionar el  plazo  de  ejecución,  es  decir,  el  tiempo durante  el   cual   EL   CONTRATISTA   se   compromete   a   prestar   a   entera   satisfacción   de   la UNIVERSIDAD el servicio objeto del contrato, en
		 <strong>'.$dura.'</strong>
		 contados a partir  del vencimiento del plazo inicialmente pactado.
		 
		 <strong><u>CLAUSULA TERCERA - INALTERABILIDAD DE LAS CLÁUSULAS PACTADAS:</u></strong>
		 Las demás cláusulas de 
		 '.$titulo2.', 
		 no sufren modificación alguna.
		 
		 <strong><u>CLAUSULA CUARTA - PERFECCIONAMIENTO Y EJECUCIÓN:</u></strong>
		 El presente adicional se perfecciona con la firma de las partes y para su ejecución se requiere el registro presupuestal. Para constancia se firma en la ciudad de Riohacha, capital del departamento de La Guajira, a los '.$fechaadicional.'.
		 
		</td>
	   </tr>
	   
	   <tr>
		 <td align="left"> 
			 <table width="100%" border="0">
			  <tr>
				<td width="50%"></td>
				<td width="50%"></td>
			  </tr>
			  <tr>
				<td width="50%">LA UNIVERSIDAD</td>
				<td width="50%">EL CONTRATISTA</td>
			  </tr>
			   <tr>
				<td width="50%"></td>
				<td width="50%"></td>
			  </tr>
			   <tr>
				<td width="50%"></td>
				<td width="50%"></td>
			  </tr>
			  <tr>
				<td width="50%"><strong>'.$contratante.'</strong></td>
				<td width="50%"><strong>'.$contratista.'</strong></td>
			  </tr>
			  <tr>
				<td width="50%">'.$condicionrector.'</td>
				<td width="50%">Contratista</td>
			  </tr>
			</table>
		 
		 </td>
	  </tr>
	   
</table>
 <br/> <br/> 
<IMG SRC="/GUNIG/protected/extensions/tcpdf/tcpdf/images/rp.png"> 
	   ';
	      $pdf->SetFont('times', 'K', 10);
   $pdf->writeHTML($html, true, 0, true, 0);  
      
  } 
 
   
   
   //$pdf->SetFont('times', 'K', 10);
   //$pdf->writeHTML($html, true, 0, true, 0);
  }
 $pdf->Output("$NombreDocumento.pdf", 'D');  
    
  Yii::app()->end();
?>