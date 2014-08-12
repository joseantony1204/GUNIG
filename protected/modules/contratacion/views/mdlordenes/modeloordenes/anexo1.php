<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'pt', 'A4', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  $phpNumToLetterPath = Yii::getPathOfAlias('ext');
  include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
  $NumberToLetters = new EnLetras();
  
  
  $autor='ING. JESUS GABRIEL AREVALO AGUILAR - UNIVERSIDAD DE LA GUAJIRA';  
  $Numero = $Contratos->numOrden;     
  $titulo="DESIGNACION";
  $palabrasClaves='CONTRATO, ORDENES, CONTRATACION';
  $Sujeto='ORDENES';
  $NombreDocumento=$titulo;
  $logo="tcpdf_logo2.jpg";
  
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
 
  $data = $Modeloordenes->downloadContratos($id);
  
  $dataproductos = $Modeloordenes->productos($id);
  $numeroproductos =count($dataproductos);
  
  $datagarantias = $Modeloordenes->garantias($id);
  $numerogarantias =count($datagarantias);
  
  $datacdp= $Modeloordenes->cdp($id);
  $numerocdp =count($datacdp);
  
  $datacontratista = $Modeloordenes->contratista($id);
 
  foreach($data as $rows){
  $Modeloordenes = Modeloordenes::model()->findByPk($rows["MOOR_ID"]);
  //$Contratos->generarContratos();  
  
  /* OBTENIENDO EL VALOR DEL CONTRATO */
  $valorContrato = $Modeloordenes->MOOR_VALOR;  
  $valorContratoLetras = strtoupper($NumberToLetters->ValorEnLetras($valorContrato,"PESOS"));
  $valorContratoCon4xMil = (($valorContrato)+($valorContrato*4/1000));
  
  /* CONFIGURANDO LA DURACION DEL CONTRATO */
  $mesesContrato = $Modeloordenes->MOOR_MESES;
  $mesesContratoLetras = $NumberToLetters->ValorEnLetras($mesesContrato,'');
  $diasContrato = $Modeloordenes->MOOR_DIAS;
  $diasContratoLetras = $NumberToLetters->ValorEnLetras($diasContrato,'');
  $aniosContrato = $Modeloordenes->MOOR_ANIOS;
  $aniosContratoLetras = $NumberToLetters->ValorEnLetras($aniosContrato,'');
   
  if(($mesesContrato>0) & $diasContrato>0 & $aniosContrato>0){
   $anioPlazo =strtoupper($NumberToLetters->ValorEnLetras($anioPlazo,''))." (".$anioPlazo.") AÑO(S)";
   $mesesPlazo = " y ".strtoupper($NumberToLetters->ValorEnLetras($mesesContrato,''))." (".$mesesContrato.") MES(ES)";
   $diaPlazo = " y ".strtoupper($NumberToLetters->ValorEnLetras($diasContrato,''))." (".$diasContrato.") DIA(S)";
   $dura=$anioPlazo.''.$mesesPlazo.''.$diaPlazo;
  }else{
	 if(($mesesContrato>0) & $diasContrato>0 & $aniosContrato==0){
	 $mesesPlazo = strtoupper($NumberToLetters->ValorEnLetras($mesesContrato,''))." (".$mesesContrato.") MES(ES)";
	 $diaPlazo = " y ".strtoupper($NumberToLetters->ValorEnLetras($diasContrato,''))." (".$diasContrato.") DIA(S)";	   
	 $anioPlazo = "";
	 $dura=$mesesPlazo.''.$diaPlazo;
	  }else{
		 if(($mesesContrato>0) & $diasContrato==0 & $aniosContrato==0){
	     $mesesPlazo = strtoupper($NumberToLetters->ValorEnLetras($mesesContrato,''))." (".$mesesContrato.") MES(S)";
		 $diaPlazo ="";
		 $anioPlazo = "";
		  $dura=$mesesPlazo;
		    }else{
			 if(($mesesContrato==0) & $diasContrato>0 & $aniosContrato==0){
			 $diaPlazo = strtoupper($NumberToLetters->ValorEnLetras($diasContrato,''))." (".$diasContrato.") DIA(S)";	
			 $mesesPlazo ="";
			 $anioPlazo = "";
			 $dura=$diaPlazo;
				 }			    			   
			   }
	   		}
	   }

  /* OBTENIENDO EL NOMBRE DEL CONTRATISTA - RECTOR - EMPRESA */	
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

	$contratante= $Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES." ".$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS;
	$cedulacontratante=$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION;
	$lugarexpecontratante=$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD;
	$condicionrector=$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION;
	$designacion=$Modeloordenes->rel_contrato->rel_contratantes->rel_resoluciones->REAC_DESCRIPCION;
	
	$ContratanteContratos="Entre los suscritos a saber: <strong>".$contratante."</strong>, mayor de edad, identificado(a) con la cédula de ciudadanía No. ".$cedulacontratante." Expedida en ".$lugarexpecontratante." quien actúa en nombre y representación legal de LA UNIVERSIDAD DE LA GUAJIRA, identificada con el Nit. 892.115.029-4, en su condición de ".$condicionrector." designado(a) mediante ".$designacion." quien para los efectos del presente documento se denominará <strong>LA UNIVERSIDAD</strong>, por una parte y por la otra parte,";
	
	}else{
	
	//si es una persona juridica
	$contratista=$html.=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.''; 
	$r=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->PENA_NOMBRES.'
	'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->PENA_APELLIDOS;
	$condescon=$r."<br/> Representante Legal <br/>" .$contratista."<br/> Contratista";
	$cedula=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION;
	$luagraexpedicion=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD;
	$domicilio=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas->rel_municipios->MUNI_NOMBRE." (".$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas->rel_departamentos->DEPA_NOMBRE.")";
	
	$ContratistaContratos = $r."  mayor de edad, identificado(a) con la cédula de ciudadanía No. ".$cedula." expedida en ".$luagraexpedicion." quien actúa en nombre  quien actúa en nombre y representación legal de la empresa <strong>".$contratista."</strong>, con domicilio en ".$domicilio.", en adelante y para efectos del presente contrato se denominará <strong>EL CONTRATISTA</strong> y en consideración a:";
	
	$contratante= $Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES." ".$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS;
	$cedulacontratante=$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION;
	$lugarexpecontratante=$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD;
	$condicionrector=$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION;
	$designacion=$Modeloordenes->rel_contrato->rel_contratantes->rel_resoluciones->REAC_DESCRIPCION;
	
	$ContratanteContratos="Entre los suscritos a saber: <strong>".$contratante."</strong>, mayor de edad, identificado(a) con la cédula de ciudadanía No. ".$cedulacontratante." Expedida en ".$lugarexpecontratante." quien actúa en nombre y representación legal de LA UNIVERSIDAD DE LA GUAJIRA, identificada con el Nit. 892.115.029-4, en su condición de ".$condicionrector." designado(a) mediante ".$designacion." quien para los efectos del presente documento se denominará <strong>LA UNIVERSIDAD</strong>, por una parte y por la otra parte,";
	
	
	}
	 
  /* OBTENIENDO EL NUMERO DE CONTRATO */	
  $numero = $Modeloordenes->rel_contrato->CONT_NUMORDEN;
  $numerocontrato = substr($numero, -3); 		
  
   /* OBTENIENDO EL TIPO Y LA CLASE DEL CONTRATO */	
  $tipo = $Modeloordenes->rel_contrato->tICO->TICO_NOMBRE;
  $clase = $Modeloordenes->rel_contrato->cLCO->CLCO_NOMBRE;		
  
  /* CONFIGURANDO LA FECHA Y CONTRATISTA */
  $dia_contrato = date("d",strtotime($Modeloordenes->rel_contrato->CONT_FECHAINICIO));
  $mes_contrato=NombreMes(date("m",strtotime($Modeloordenes->rel_contrato->CONT_FECHAINICIO)));
  $anio_contrato=$Modeloordenes->rel_contrato->CONT_ANIO;  
  $fecha = $dia_contrato." de ".$mes_contrato." de ".$anio_contrato;
  $fechacontratos = $dia_contrato." días del mes de ".$mes_contrato." de año ".$anio_contrato;
 
  $expe = strtolower($Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD);
  //$exp = ucfirst($expe);
  $exp = ucwords(ucfirst($expe));
  $tipoDoc = strtolower($Modeloordenes->rel_contrato->Persona->rel_tipos_identificacion->TIID_NOMBRE);
  $tipoDocumento = ucwords(ucfirst($tipoDoc));
    
  $dire = strtolower($Modeloordenes->rel_contrato->Persona->PERS_DIRECCION);
  $dir = ucwords ($dire);	     
  
  $Contratos = Contratos::model()->findByPk($Modeloordenes->CONT_ID);
		
  $criteria = new CDbCriteria;
  $criteria->condition = 'CONT_ID = '.$Contratos->CONT_ID;		
  $Formcontratosformatos = Formcontratosformatos::model()->find($criteria);		
  $Formclasescontratos = Formclasescontratos::model()->findByPk($Formcontratosformatos->FCCO_ID);
	
  $objeto= trim($Modeloordenes->MOOR_OBJETO);
  
  
  
  /*A PARTIR DE AQUI SE COMIENZA A VINCULAR EL CONTRATO EN EL FORMATO CORRESPONDIENTE*/  
 if( 
     ($Formclasescontratos->FCCO_ID==202) or 
	 ($Formclasescontratos->FCCO_ID==201) or 
	 ($Formclasescontratos->FCCO_ID==302) or 
	 ($Formclasescontratos->FCCO_ID==301) or 
	 ($Formclasescontratos->FCCO_ID==402) or 
	 ($Formclasescontratos->FCCO_ID==401) or 
	 ($Formclasescontratos->FCCO_ID==502) or 
	 ($Formclasescontratos->FCCO_ID==501) or 
	 ($Formclasescontratos->FCCO_ID==602) or 
	 ($Formclasescontratos->FCCO_ID==601) or 
	 ($Formclasescontratos->FCCO_ID==702) or 
	 ($Formclasescontratos->FCCO_ID==701) or 
	 ($Formclasescontratos->FCCO_ID==802) or 
 	 ($Formclasescontratos->FCCO_ID==801) or 
	 ($Formclasescontratos->FCCO_ID==901) or 
	 ($Formclasescontratos->FCCO_ID==902) or 
	 ($Formclasescontratos->FCCO_ID==803) or 
	 ($Formclasescontratos->FCCO_ID==1001) or 
	 ($Formclasescontratos->FCCO_ID==1002) or 
	 ($Formclasescontratos->FCCO_ID==1101) or 
	 ($Formclasescontratos->FCCO_ID==1102) or 
	 ($Formclasescontratos->FCCO_ID==1201) or 
	 ($Formclasescontratos->FCCO_ID==1202) or 
	 ($Formclasescontratos->FCCO_ID==1203) or 
	 ($Formclasescontratos->FCCO_ID==1301) or 
	 ($Formclasescontratos->FCCO_ID==1302) or 
	 ($Formclasescontratos->FCCO_ID==1401) or 
	 ($Formclasescontratos->FCCO_ID==1501)or 
	 ($Formclasescontratos->FCCO_ID==1701) or 
	 ($Formclasescontratos->FCCO_ID==1801) or 
	 ($Formclasescontratos->FCCO_ID==1802) or 
	 ($Formclasescontratos->FCCO_ID==5)
	 
	 
	 )
		
	{
     //echo $Formclasescontratos->FCCO_ID;
	  /* CARGANDO EL FORMATO DEL CONTRATO */  
	  $criteria = new CDbCriteria;
	  $criteria->condition = 'FCCO_ID = '.$Formclasescontratos->FCCO_ID;
	  $Formdescripcionclausulas = Formdescripcionclausulas::model()->findAll($criteria);
	  $numeroClausulas = count($Formdescripcionclausulas);
	  
	  /*OBTENIENDO REGISTROS DE LA TABLA TBL_FORMDESCRIPCIONCLAUSULAS*/
	  /*OBTENIENDO LAS DESCRIPCIONES DE LAS CLAUSULAS Y DEMAS CAMPOS*/
	  foreach($Formdescripcionclausulas as $data){
	   $idDescipcionClausula[] = $data->FDCL_ID;
	   $descripcionClausula[] = $data->FDCL_NOMBRE;	  
	  
	  /* OBTENIENDO LOS NOMBRES DE LA CLAUSULAS*/
	  $Formnombresclausulas = Formnombresclausulas::model()->findByPk($data->FNCL_ID);
	  $nombreClausulas[]  = $Formnombresclausulas->FNCL_NOMBRE;
	  
	  $criteria = new CDbCriteria;
	  $criteria->condition = 'FDCL_ID = '.$data->FDCL_ID;
	  $Formpartesdescripcionclaus = Formpartesdescripcionclaus::model()->findAll($criteria);
	   
	   /*OBTENIENDO LAS PARTES DE LA DESCRIPCION CLAUSULAS*/
	   foreach($Formpartesdescripcionclaus as $partes){
	    $idPartesDescripcionClausula[][] = $partes->FPDC_ID;
	    $partesDescripcionClausula[][] = $partes->FPDC_DESCRIPCION;
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
		 <td align="left">
		<strong>'.$Modeloordenes->rel_contrato->Supervisor->rel_persona->rel_personas_naturales->PENA_NOMBRES.' 
		'.$Modeloordenes->rel_contrato->Supervisor->rel_persona->rel_personas_naturales->PENA_APELLIDOS.'
		</strong>
	   </td>
		</tr>
		 <tr>
		  <td align="justify"><strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.'</strong>  </td>
		 </tr>
		<tr>
		 <td align="left">UNIVERSIDAD DE LA GUAJIRA</td>
		</tr>
		<tr>
		 <td align="left">Ciudad.- </td>
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
						<td align="left"><strong>&nbsp;REF.- &nbsp;DESIGNACIÓN DE SUPERVISOR - '.$tipo.' '.$numerocontrato.' DE '.$clase.' DE '.$anio_contrato.'</strong></td>
					  </tr>
					</table>
					
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		
		
		 
		 
		<tr>
		 <td align="justify">De manera atenta me permito designarlo como Supervisor dentro de la '.$tipo.' '.$numerocontrato.' DE '.$clase.' cuyo objeto es: <strong>'.$objeto.'</strong>, por lo tanto deberá verificar el cumplimiento de los requisitos de perfeccionamiento y ejecución del Contrato, será obligación principal del Supervisor elaborar y suscribir las respectivas Actas de Inicio, Terminación y Liquidación y demás actas conforme lo establece el Estatuto de Contratación de la Universidad de La Guajira en su Artículo 43 y en lo pertinente lo que establece el Decreto 1474 de 2011. </td>
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
		 <td align="left"><strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
		</tr>
		

	   </table>
	   ';
      
  } 

   $pdf->SetFont('times', 'K', 12);
   $pdf->writeHTML($html, true, 0, true, 0);
  }
 $pdf->Output("$NombreDocumento.pdf", 'D');  
    
  Yii::app()->end();
?>