<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'pt', 'Legal', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  $phpNumToLetterPath = Yii::getPathOfAlias('ext');
  include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
  $NumberToLetters = new EnLetras();
  
  
  $autor='ING. JESUS GABRIEL AREVALO AGUILAR - UNIVERSIDAD DE LA GUAJIRA';  
  $Numero = $Contratos->numOrden;     
  $titulo="MINUTA DE CONTRATO";
  $palabrasClaves='CONTRATO, ORDENES, CONTRATACION';
  $Sujeto='CONTRATOS EN GENERAL';
  $NombreDocumento=$titulo;
  $logo="tcpdf_logo2.jpg";
  
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
  $pdf->SetAutoPageBreak(TRUE, 10);
	
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
  
  $datainvitados = $Modeloordenes->invitados($id);
  $numeroinvitados =count($datainvitados);
  
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
	     $mesesPlazo = strtoupper($NumberToLetters->ValorEnLetras($mesesContrato,''))." (".$mesesContrato.") MES(ES)";
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

	$domiciliociudad=$Modeloordenes->rel_contrato->Persona->rel_municipios->MUNI_NOMBRE." (".$Modeloordenes->rel_contrato->Persona->rel_departamentos->DEPA_NOMBRE.")";
	$domicilio=" la ".$Modeloordenes->rel_contrato->Persona->PERS_DIRECCION.", en la ciudad de ".$domiciliociudad;
	$ContratistaContratos = "<strong>".$contratista."</strong> mayor de edad, identificado(a) con la cédula de ciudadanía No. ".$cedula." expedida en ".$luagraexpedicion." quien actúa en nombre propio, con domicilio en ".$domiciliociudad.", en adelante y para efectos del presente contrato se denominará <strong>EL CONTRATISTA</strong> y en consideración a:";

	$contratante= $Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES." ".$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS;
	$cedulacontratante=$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION;
	$lugarexpecontratante=$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD;
	$condicionrector=$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION;
	$designacion=$Modeloordenes->rel_contrato->rel_contratantes->rel_resoluciones->REAC_DESCRIPCION;
	
	$ContratanteContratos="Entre los suscritos a saber: <strong>".$contratante."</strong>, mayor de edad, identificado(a) con la cédula de ciudadanía No. ".$cedulacontratante." Expedida en ".$lugarexpecontratante." quien actúa en nombre y representación legal de LA UNIVERSIDAD DE LA GUAJIRA, identificada con el Nit. 892.115.029-4, en su condición de ".$condicionrector." ".$designacion." quien para los efectos del presente documento se denominará <strong>LA UNIVERSIDAD</strong>, por una parte y por la otra parte,";
	//ordenes
	$expe = $Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD;
  //$exp = ucfirst($expe);
  //$exp = ucwords(ucfirst($expe));
  $exp = "Expedida en ".($expe);
  $tipoDoc = strtolower($Modeloordenes->rel_contrato->Persona->rel_tipos_identificacion->TIID_NOMBRE);
  $tipoDocumento = ucwords(ucfirst($tipoDoc));
  $dire = $Modeloordenes->rel_contrato->Persona->PERS_DIRECCION;
  $dir =  $dire;
  
  
	
	}else{
		
	
	//si es una persona juridica
	$contratista=$html.=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.'';
	$nit= $Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.'';
	$r=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->PENA_NOMBRES.'
	'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->PENA_APELLIDOS;
	$condescon=$r."<br/> Representante Legal <br/>" .$contratista."<br/> Contratista";
	$cedula=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION;
	$luagraexpedicion=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_representante->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD;
	
	$domiciliociudad=$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas->rel_municipios->MUNI_NOMBRE." (".$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas->rel_departamentos->DEPA_NOMBRE.")";
	
	$domicilio=" la ".$Modeloordenes->rel_contrato->Persona->PERS_DIRECCION.", en la ciudad de ".$domiciliociudad;
	$ContratistaContratos = $r."  mayor de edad, identificado(a) con la cédula de ciudadanía No. ".$cedula." expedida en ".$luagraexpedicion." quien actúa en nombre y representación legal de la empresa <strong>".$contratista." identificada con NIT ".$nit."</strong>, con domicilio en ".$domiciliociudad.", en adelante y para efectos del presente contrato se denominará <strong>EL CONTRATISTA</strong> y en consideración a:";
	
	$contratante= $Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES." ".$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS;
	$cedulacontratante=$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION;
	$lugarexpecontratante=$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD;
	$condicionrector=$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION;
	$designacion=$Modeloordenes->rel_contrato->rel_contratantes->rel_resoluciones->REAC_DESCRIPCION;
	
	$ContratanteContratos="Entre los suscritos a saber: <strong>".$contratante."</strong>, mayor de edad, identificado(a) con la cédula de ciudadanía No. ".$cedulacontratante." Expedida en ".$lugarexpecontratante." quien actúa en nombre y representación legal de LA UNIVERSIDAD DE LA GUAJIRA, identificada con el Nit. 892.115.029-4, en su condición de ".$condicionrector." ".$designacion." quien para los efectos del presente documento se denominará <strong>LA UNIVERSIDAD</strong>, por una parte y por la otra parte,";
	
	//ordenes
	
	
  $tipoDoc = strtolower($Modeloordenes->rel_contrato->Persona->rel_tipos_identificacion->TIID_NOMBRE);
  $tipoDocumento = ucwords(ucfirst($tipoDoc));
  $dire = $Modeloordenes->rel_contrato->Persona->PERS_DIRECCION;
  $dir =  $dire;
	
	}
	 
	 
  /* OBTENIENDO EL NUMERO DE CONTRATO */	
  $numero = $Modeloordenes->rel_contrato->CONT_NUMORDEN;
  $numerocontrato = substr($numero, -3); 	
  $objeto= trim($Modeloordenes->MOOR_OBJETO); 
  
   /* OBTENIENDO EL TIPO Y LA CLASE DEL CONTRATO */	
  $tipo = $Modeloordenes->rel_contrato->tICO->TICO_NOMBRE;
  $clase = $Modeloordenes->rel_contrato->cLCO->CLCO_NOMBRE;		
  
  /* CONFIGURANDO LA FECHA Y CONTRATISTA */
  $dia_contrato = date("d",strtotime($Modeloordenes->rel_contrato->CONT_FECHAINICIO));
  $mes_contrato=NombreMes(date("m",strtotime($Modeloordenes->rel_contrato->CONT_FECHAINICIO)));
  $anio_contrato=$Modeloordenes->rel_contrato->CONT_ANIO;  
  $fecha = $dia_contrato." de ".$mes_contrato." de ".$anio_contrato;
  $fechacontratos = $dia_contrato." días del mes de ".$mes_contrato." de año ".$anio_contrato;
 
       
  
  $Contratos = Contratos::model()->findByPk($Modeloordenes->CONT_ID);
		
  $criteria = new CDbCriteria;
  $criteria->condition = 'CONT_ID = '.$Contratos->CONT_ID;		
  $Formcontratosformatos = Formcontratosformatos::model()->find($criteria);		
  $Formclasescontratos = Formclasescontratos::model()->findByPk($Formcontratosformatos->FCCO_ID);

 $formapago=ucfirst($Modeloordenes->rel_formadepago->FOPA_DESCRIPCION);
  
  
  /*A PARTIR DE AQUI SE COMIENZA A VINCULAR EL CONTRATO EN EL FORMATO CORRESPONDIENTE*/  
 if(($Formclasescontratos->FCCO_ID)==302){/*SI ES UNA ORDEN DE SUMINISTRO SIN POLIZA */
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
	  //$pdf->SetFont('times', 'B', '20', true);
	 $pdf->SetFont('times', 'K', 10);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' '.$numerocontrato.' DE '.$clase.' DE  '.$anio_contrato.' </strong></td>
	   </tr>
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
		 <td align="left">Señor (a):</td>
		</tr>
	    <tr>
		 <td align="left">
		<strong>'.$contratista.'</strong>
	   </td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.' / '.$domiciliociudad.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$Modeloordenes->rel_contrato->Persona->PERS_TELEFONO.'</td>
		</tr>
		<tr>
		 <td align="left">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="justify">'.$Formclasescontratos->FCCO_DESCRIPCION.'</td>
		</tr>
		
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[0].' - '.$descripcionClausula[0].'</u>:</strong> 
		 '.$partesDescripcionClausula[0][0].':<strong> '.$objeto.'.</strong> 
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		
			
		';
		if ($numeroproductos>0) {
		$html .='
					<tr>
					 <td>
					';
					$total=0; $vt=0;
					$i=0;
					$html .='
							<table width="100%" border="1">
					<tr>
					 <td width="46%" valign="middle"><p><strong>PRODUCTO</strong></p></td>
					 <td width="15%" valign="middle"><strong>CANTIDAD</strong></td>
					 <td width="21%"><strong>VALOR UNITARIO</strong></td>
					 <td width="18%"><strong>VALOR TOTAL</strong></td>
					</tr>
					';
					foreach($dataproductos as $rows){
					$Productos = Productos::model()->findByPk($rows["PROD_ID"]);
					$nombre[$i] = $Productos->PROD_NOMBRE;
					$cantidad[$i] = $Productos->PROD_CANTIDAD;
					$valor[$i] = $Productos->PROD_VALOR;
					$porcentajeiva[$i] = $Productos->PROD_IVA;
					$iva= ($valor[$i]*$cantidad[$i])*($porcentajeiva[$i]/100);
					$totaliva= $totaliva + $iva;
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt + $iva;
					//$numeroproductos
					 $html .='	
								<tr>
									<td align="left" width="46%">'.$nombre[$i].'</td>
									<td align="center" width="15%">'.number_format($cantidad[$i]).'</td>
									<td align="rigt" width="21%">'.number_format($valor[$i]).'</td>
									<td align="rigt" width="18%">'.number_format($vt).'</td>
								</tr>
					'; $i++;
					}		
					$html .='	
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>IVA</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($totaliva).'</strong></td>
					</tr>
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>VALOR TOTAL</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($total).'</strong></td>
					</tr>
					</table>
					
						</td>
					</tr>
	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
			';
		}
		$html .='		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[1].' - '.$descripcionClausula[1].'</u>:</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong> '.$formapago.'. 
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[2].' - '.$descripcionClausula[2].'</u>:</strong> 
		 <br/>'.$partesDescripcionClausula[2][0].'
		 </td>
		</tr>
		  
			  		  
		  
		<tr>
		 <td align="justify"><br/><strong><u>'.$nombreClausulas[3].' - '.$descripcionClausula[3].'</u>:</strong> 
         '.$partesDescripcionClausula[3][0].'
		  <strong>'.$dura.'</strong>, '.$partesDescripcionClausula[4][0].'
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[4].' - '.$descripcionClausula[4].'</u>:</strong>
		 '.$partesDescripcionClausula[5][0].':
	
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		 
		 		 
        
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[5].' - '.$descripcionClausula[5].'</u>:</strong> 
         '.$partesDescripcionClausula[6][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[6].' - '.$descripcionClausula[6].'</u>:</strong> 
         '.$partesDescripcionClausula[7][0].'.
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[7].' - '.$descripcionClausula[7].'</u>:</strong> 
          '.$partesDescripcionClausula[8][0].'
		  <strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
		  '.$partesDescripcionClausula[9][0].'.
		  </td>
		 </tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[8].' - '.$descripcionClausula[8].'</u>:</strong> 
          '.$partesDescripcionClausula[10][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[9].' - '.$descripcionClausula[9].'</u>:</strong> 
          '.$partesDescripcionClausula[11][0].'
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[10].' - '.$descripcionClausula[10].'</u>:</strong> 
          '.$partesDescripcionClausula[12][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[11].' - '.$descripcionClausula[11].'</u>:</strong> 
          '.$partesDescripcionClausula[13][0].'
		  </td>
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
		  <td>
					  <table width="100%" border="0">
					  <tr>
						<td width="52%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="52%" align="left">&nbsp;</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="52%" align="left">&nbsp;</td>
    					<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="right">ACEPTO: </td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">
						<strong>'.$condescon.'</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
					  </tr>
					 </table>
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  } 
  elseif(($Formclasescontratos->FCCO_ID)==301){/*SI ES UNA ORDEN DE SUMINISTRO CON POLIZA */
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
	  //$pdf->SetFont('times', 'B', '11', true);
	  $pdf->SetFont('times', 'K', 11, true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' '.$numerocontrato.' DE '.$clase.' DE '.$anio_contrato.' </strong></td>
	   </tr>
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
		 <td align="left">Señor (a):</td>
		</tr>
	    <tr>
		 <td align="left"><strong>'.$contratista.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.' / '.$domiciliociudad.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$Modeloordenes->rel_contrato->Persona->PERS_TELEFONO.'</td>
		</tr>
		<tr>
		 <td align="left">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="justify">'.$Formclasescontratos->FCCO_DESCRIPCION.'</td>
		</tr>
		
	     <tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[0].' - '.$descripcionClausula[0].'</u>:</strong> 
		 '.$partesDescripcionClausula[0][0].':<strong> '.$objeto.'.</strong> 
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		
		';
		if ($numeroproductos>0) {
		$html .='
					<tr>
					 <td>
					';
					$total=0; $vt=0;
					$i=0;
					$html .='
							<table width="100%" border="1">
					<tr>
					 <td width="46%" valign="middle"><p><strong>PRODUCTO</strong></p></td>
					 <td width="15%" valign="middle"><strong>CANTIDAD</strong></td>
					 <td width="21%"><strong>VALOR UNITARIO</strong></td>
					 <td width="18%"><strong>VALOR TOTAL</strong></td>
					</tr>
					';
					foreach($dataproductos as $rows){
					$Productos = Productos::model()->findByPk($rows["PROD_ID"]);
					$nombre[$i] = $Productos->PROD_NOMBRE;
					$cantidad[$i] = $Productos->PROD_CANTIDAD;
					$valor[$i] = $Productos->PROD_VALOR;
					$porcentajeiva[$i] = $Productos->PROD_IVA;
					$iva= ($valor[$i]*$cantidad[$i])*($porcentajeiva[$i]/100);
					$totaliva= $totaliva + $iva;
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt + $iva;
					//$numeroproductos
					 $html .='	
								<tr>
									<td align="left" width="46%">'.$nombre[$i].'</td>
									<td align="center" width="15%">'.number_format($cantidad[$i]).'</td>
									<td align="rigt" width="21%">'.number_format($valor[$i]).'</td>
									<td align="rigt" width="18%">'.number_format($vt).'</td>
								</tr>
					'; $i++;
					}		
					$html .='	
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>IVA</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($totaliva).'</strong></td>
					</tr>
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>VALOR TOTAL</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($total).'</strong></td>
					</tr>
					</table>
					
						</td>
					</tr>
	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
			';
		}
		$html .='		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[1].' - '.$descripcionClausula[1].'</u>:</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong> '.$formapago.'. 
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[2].' - '.$descripcionClausula[2].'</u>:</strong> 
		 <br/>'.$partesDescripcionClausula[2][0].'
		 </td>
		</tr>
		  

		<tr>
		 <td align="justify"><br/><strong><u>'.$nombreClausulas[3].' - '.$descripcionClausula[3].'</u>:</strong> 
         '.$partesDescripcionClausula[3][0].'
		  <strong>'.$dura.'</strong>, '.$partesDescripcionClausula[4][0].'
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[4].' - '.$descripcionClausula[4].'</u>:</strong>
		 '.$partesDescripcionClausula[5][0].':
	
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		 
		 		 
        
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[5].' - '.$descripcionClausula[5].'</u>:</strong> 
         '.$partesDescripcionClausula[6][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  	  
			    
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[6].' - '.$descripcionClausula[6].'.</u>:</strong> 
         '.$partesDescripcionClausula[7][0].'.
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		 
		  <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[7].' - '.$descripcionClausula[7].'</u>:</strong> 
          '.$partesDescripcionClausula[8][0].' 
		  '; 
		     foreach($datagarantias as $rows){
			 $Garantias = Garantias::model()->findByPk($rows["GARA_ID"]);
			 $desgarantia[] = $Garantias->GARA_DESCRIPCION;
			 //echo $Garantias->GARA_DESCRIPCION;
			 }
				 if ($numerogarantias==1) { 
					$html .='	
					 <strong>A '.$Garantias->GARA_DESCRIPCION.'</strong>
					        ';
				 } elseif($numerogarantias==2) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					        ';
				 } elseif($numerogarantias==3) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
					        ';
				 } elseif($numerogarantias==4) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					        ';
				 } elseif($numerogarantias==5) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					        ';
				 } elseif($numerogarantias==6) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					 <strong>F '.$desgarantia[5].'</strong>
					        ';
				 }    
	$html .='
		 
		  </td>
		</tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[8].' - '.$descripcionClausula[8].'</u>:</strong> 
		  '.$partesDescripcionClausula[9][0].'
		  	<strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
          '.$partesDescripcionClausula[10][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[9].' - '.$descripcionClausula[9].'</u>:</strong> 
          '.$partesDescripcionClausula[11][0].'.
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		<td align="justify"><strong><u>'.$nombreClausulas[10].' - '.$descripcionClausula[10].'</u>:</strong> 
          '.$partesDescripcionClausula[12][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[11].' - '.$descripcionClausula[11].'</u>:</strong> 
          '.$partesDescripcionClausula[13][0].'.
		  </td>
		 </tr>
		 	 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	  
		  
		  <tr>
		<td align="justify"><strong><u>'.$nombreClausulas[12].' - '.$descripcionClausula[12].'</u>:</strong> 
          '.$partesDescripcionClausula[14][0].'
		  </td>
		 </tr>
		 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  <tr>
		  <td align="center">&nbsp;</td>
		 </tr> 
		  
		 <tr>
		  <td>
					  <table width="100%" border="0">
					  <tr>
						<td width="52%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="52%" align="left">&nbsp;</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="52%" align="left">&nbsp;</td>
    					<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="right">ACEPTO: </td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">
						<strong>'.$condescon.' 
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
					  </tr>
					 </table>
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  } elseif(($Formclasescontratos->FCCO_ID)==202){/*SI ES UNA ORDEN DE PRESTACION DE SERVICIOS SIN POLIZA */
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
//	  $pdf->SetFont('times', 'B', '20', true);
		$pdf->SetFont('times', 'K', 10, true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' '.$numerocontrato.' DE '.$clase.' DE  '.$anio_contrato.' </strong></td>
	   </tr>
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
		 <td align="left">Señor (a):</td>
		</tr>
	    <tr>
		 <td align="left">
		<strong>'.$contratista.'</strong>
	   </td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.' / '.$domiciliociudad.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$Modeloordenes->rel_contrato->Persona->PERS_TELEFONO.'</td>
		</tr>
		<tr>
		 <td align="left">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="justify">'.$Formclasescontratos->FCCO_DESCRIPCION.'</td>
		</tr>
		
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[0].' - '.$descripcionClausula[0].'</u>:</strong> 
		 '.$partesDescripcionClausula[0][0].':<strong> '.$objeto.'.</strong> 
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		
				
		';
		if ($numeroproductos>0) {
		$html .='
					<tr>
					 <td>
					';
					$total=0; $vt=0;
					$i=0;
					$html .='
							<table width="100%" border="1">
					<tr>
					 <td width="46%" valign="middle"><p><strong>PRODUCTO</strong></p></td>
					 <td width="15%" valign="middle"><strong>CANTIDAD</strong></td>
					 <td width="21%"><strong>VALOR UNITARIO</strong></td>
					 <td width="18%"><strong>VALOR TOTAL</strong></td>
					</tr>
					';
					foreach($dataproductos as $rows){
					$Productos = Productos::model()->findByPk($rows["PROD_ID"]);
					$nombre[$i] = $Productos->PROD_NOMBRE;
					$cantidad[$i] = $Productos->PROD_CANTIDAD;
					$valor[$i] = $Productos->PROD_VALOR;
					$porcentajeiva[$i] = $Productos->PROD_IVA;
					$iva= ($valor[$i]*$cantidad[$i])*($porcentajeiva[$i]/100);
					$totaliva= $totaliva + $iva;
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt + $iva;
					//$numeroproductos
					 $html .='	
								<tr>
									<td align="left" width="46%">'.$nombre[$i].'</td>
									<td align="center" width="15%">'.number_format($cantidad[$i]).'</td>
									<td align="rigt" width="21%">'.number_format($valor[$i]).'</td>
									<td align="rigt" width="18%">'.number_format($vt).'</td>
								</tr>
					'; $i++;
					}		
					$html .='	
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>IVA</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($totaliva).'</strong></td>
					</tr>
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>VALOR TOTAL</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($total).'</strong></td>
					</tr>
					</table>
					
						</td>
					</tr>
	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
			';
		}
		$html .='		  		  
		  
		
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[1].' - '.$descripcionClausula[1].'</u>:</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong>
		 '.$formapago.'. 
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[2].' - '.$descripcionClausula[2].'</u>:</strong> 
		 <br/>'.$partesDescripcionClausula[2][0].'
		 </td>
		</tr>
		  
			  		  
		  
		<tr>
		 <td align="justify"><br/><strong><u>'.$nombreClausulas[3].' - '.$descripcionClausula[3].'</u>:</strong> 
         '.$partesDescripcionClausula[3][0].'
		  <strong>'.$dura.'</strong>, '.$partesDescripcionClausula[4][0].'
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[4].' - '.$descripcionClausula[4].'</u>:</strong>
		 '.$partesDescripcionClausula[5][0].':
	
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		 
		 		 
        
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[5].' - '.$descripcionClausula[5].'</u>:</strong> 
         '.$partesDescripcionClausula[6][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[6].' - '.$descripcionClausula[6].'</u>:</strong> 
         '.$partesDescripcionClausula[7][0].'.
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[7].' - '.$descripcionClausula[7].'</u>:</strong> 
          '.$partesDescripcionClausula[8][0].'
		  <strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
		  '.$partesDescripcionClausula[9][0].'.
		  </td>
		 </tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[8].' - '.$descripcionClausula[8].'</u>:</strong> 
          '.$partesDescripcionClausula[10][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[9].' - '.$descripcionClausula[9].'</u>:</strong> 
          '.$partesDescripcionClausula[11][0].'
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[10].' - '.$descripcionClausula[10].'</u>:</strong> 
          '.$partesDescripcionClausula[12][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[11].' - '.$descripcionClausula[11].'</u>:</strong> 
          '.$partesDescripcionClausula[13][0].'
		  </td>
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
		  <td>
					  <table width="100%" border="0">
					  <tr>
						<td width="52%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="52%" align="left">&nbsp;</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="52%" align="left">&nbsp;</td>
    					<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="right">ACEPTO: </td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">
						<strong>'.$condescon.' 
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
					  </tr>
					 </table>
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  } 
  
  elseif(($Formclasescontratos->FCCO_ID)==201){/*SI ES UNA ORDEN DE PRESTACION DE SERVICIOS CON POLIZA */
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
	 // $pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 10, true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' '.$numerocontrato.' DE '.$clase.' DE '.$anio_contrato.' </strong></td>
	   </tr>
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
		 <td align="left">Señor (a):</td>
		</tr>
	    <tr>
		 <td align="left"><strong>'.$contratista.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.' / '.$domiciliociudad.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$Modeloordenes->rel_contrato->Persona->PERS_TELEFONO.'</td>
		</tr>
		<tr>
		 <td align="left">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="justify">'.$Formclasescontratos->FCCO_DESCRIPCION.'</td>
		</tr>
		
	     <tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[0].' - '.$descripcionClausula[0].'</u>:</strong> 
		 '.$partesDescripcionClausula[0][0].':<strong> '.$objeto.'.</strong> 
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		
		
		';
		if ($numeroproductos>0) {
		$html .='
					<tr>
					 <td>
					';
					$total=0; $vt=0;
					$i=0;
					$html .='
							<table width="100%" border="1">
					<tr>
					 <td width="46%" valign="middle"><p><strong>PRODUCTO</strong></p></td>
					 <td width="15%" valign="middle"><strong>CANTIDAD</strong></td>
					 <td width="21%"><strong>VALOR UNITARIO</strong></td>
					 <td width="18%"><strong>VALOR TOTAL</strong></td>
					</tr>
					';
					foreach($dataproductos as $rows){
					$Productos = Productos::model()->findByPk($rows["PROD_ID"]);
					$nombre[$i] = $Productos->PROD_NOMBRE;
					$cantidad[$i] = $Productos->PROD_CANTIDAD;
					$valor[$i] = $Productos->PROD_VALOR;
					$porcentajeiva[$i] = $Productos->PROD_IVA;
					$iva= ($valor[$i]*$cantidad[$i])*($porcentajeiva[$i]/100);
					$totaliva= $totaliva + $iva;
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt + $iva;
					//$numeroproductos
					 $html .='	
								<tr>
									<td align="left" width="46%">'.$nombre[$i].'</td>
									<td align="center" width="15%">'.number_format($cantidad[$i]).'</td>
									<td align="rigt" width="21%">'.number_format($valor[$i]).'</td>
									<td align="rigt" width="18%">'.number_format($vt).'</td>
								</tr>
					'; $i++;
					}		
					$html .='	
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>IVA</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($totaliva).'</strong></td>
					</tr>
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>VALOR TOTAL</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($total).'</strong></td>
					</tr>
					</table>
					
						</td>
					</tr>
	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
			';
		}
		$html .='		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[1].' - '.$descripcionClausula[1].'</u>:</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong> '.$formapago.'. 
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[2].' - '.$descripcionClausula[2].'</u>:</strong> 
		 <br/>'.$partesDescripcionClausula[2][0].'
		 </td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><br/><strong><u>'.$nombreClausulas[3].' - '.$descripcionClausula[3].'</u>:</strong> 
         '.$partesDescripcionClausula[3][0].'
		  <strong>'.$dura.'</strong>, '.$partesDescripcionClausula[4][0].'
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[4].' - '.$descripcionClausula[4].'</u>:</strong>
		 '.$partesDescripcionClausula[5][0].':
	
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		 
		 		 
        
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[5].' - '.$descripcionClausula[5].'</u>:</strong> 
         '.$partesDescripcionClausula[6][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  	  
			    
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[6].' - '.$descripcionClausula[6].'.</u>:</strong> 
         '.$partesDescripcionClausula[7][0].'.
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		 
		  <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[7].' - '.$descripcionClausula[7].'</u>:</strong> 
          '.$partesDescripcionClausula[8][0].' 
		  '; 
		     foreach($datagarantias as $rows){
			 $Garantias = Garantias::model()->findByPk($rows["GARA_ID"]);
			 $desgarantia[] = $Garantias->GARA_DESCRIPCION;
			 //echo $Garantias->GARA_DESCRIPCION;
			 }
				 if ($numerogarantias==1) { 
					$html .='	
					 <strong>A '.$Garantias->GARA_DESCRIPCION.'</strong>
					        ';
				 } elseif($numerogarantias==2) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					        ';
				 } elseif($numerogarantias==3) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
					        ';
				 } elseif($numerogarantias==4) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					        ';
				 } elseif($numerogarantias==5) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					        ';
				 } elseif($numerogarantias==6) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					 <strong>F '.$desgarantia[5].'</strong>
					        ';
				 }    
	$html .='
		 
		  </td>
		</tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[8].' - '.$descripcionClausula[8].'</u>:</strong> 
		  '.$partesDescripcionClausula[9][0].'
		  	<strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
          '.$partesDescripcionClausula[10][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[9].' - '.$descripcionClausula[9].'</u>:</strong> 
          '.$partesDescripcionClausula[11][0].'.
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		<td align="justify"><strong><u>'.$nombreClausulas[10].' - '.$descripcionClausula[10].'</u>:</strong> 
          '.$partesDescripcionClausula[12][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[11].' - '.$descripcionClausula[11].'</u>:</strong> 
          '.$partesDescripcionClausula[13][0].'.
		  </td>
		 </tr>
		 	 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	  
		  
		  <tr>
		<td align="justify"><strong><u>'.$nombreClausulas[12].' - '.$descripcionClausula[12].'</u>:</strong> 
          '.$partesDescripcionClausula[14][0].'
		  </td>
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
		  <td>
					  <table width="100%" border="0">
					  <tr>
						<td width="52%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="52%" align="left">&nbsp;</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="52%" align="left">&nbsp;</td>
    					<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="right">ACEPTO: </td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">
						<strong>'.$condescon.' 
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
					  </tr>
					 </table>
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  }
  
  elseif(($Formclasescontratos->FCCO_ID)==402){/*SI ES UNA ORDEN DE COMPRAVENTA SIN POLIZA */
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
	  //$pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 10, true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' '.$numerocontrato.' DE '.$clase.' DE  '.$anio_contrato.' </strong></td>
	   </tr>
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
		 <td align="left">Señor (a):</td>
		</tr>
	    <tr>
		 <td align="left">
		<strong>'.$contratista.'</strong>
	   </td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.' / '.$domiciliociudad.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$Modeloordenes->rel_contrato->Persona->PERS_TELEFONO.'</td>
		</tr>
		<tr>
		 <td align="left">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="justify">'.$Formclasescontratos->FCCO_DESCRIPCION.'</td>
		</tr>
		
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[0].' - '.$descripcionClausula[0].'</u>:</strong> 
		 '.$partesDescripcionClausula[0][0].':<strong> '.$objeto.'.</strong> 
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		
			
		';
		if ($numeroproductos>0) {
		$html .='
					<tr>
					 <td>
					';
					$total=0; $vt=0;
					$i=0;
					$html .='
							<table width="100%" border="1">
					<tr>
					 <td width="46%" valign="middle"><p><strong>PRODUCTO</strong></p></td>
					 <td width="15%" valign="middle"><strong>CANTIDAD</strong></td>
					 <td width="21%"><strong>VALOR UNITARIO</strong></td>
					 <td width="18%"><strong>VALOR TOTAL</strong></td>
					</tr>
					';
					foreach($dataproductos as $rows){
					$Productos = Productos::model()->findByPk($rows["PROD_ID"]);
					$nombre[$i] = $Productos->PROD_NOMBRE;
					$cantidad[$i] = $Productos->PROD_CANTIDAD;
					$valor[$i] = $Productos->PROD_VALOR;
					$porcentajeiva[$i] = $Productos->PROD_IVA;
					$iva= ($valor[$i]*$cantidad[$i])*($porcentajeiva[$i]/100);
					$totaliva= $totaliva + $iva;
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt + $iva;
					//$numeroproductos
					 $html .='	
								<tr>
									<td align="left" width="46%">'.$nombre[$i].'</td>
									<td align="center" width="15%">'.number_format($cantidad[$i]).'</td>
									<td align="rigt" width="21%">'.number_format($valor[$i]).'</td>
									<td align="rigt" width="18%">'.number_format($vt).'</td>
								</tr>
					'; $i++;
					}		
					$html .='	
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>IVA</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($totaliva).'</strong></td>
					</tr>
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>VALOR TOTAL</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($total).'</strong></td>
					</tr>
					</table>
					
						</td>
					</tr>
	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
			';
		}
		$html .='		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[1].' - '.$descripcionClausula[1].'</u>:</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong> '.$formapago.'. 
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[2].' - '.$descripcionClausula[2].'</u>:</strong> 
		 <br/>'.$partesDescripcionClausula[2][0].'
		 </td>
		</tr>
		  
			  		  
		  
		<tr>
		 <td align="justify"><br/><strong><u>'.$nombreClausulas[3].' - '.$descripcionClausula[3].'</u>:</strong> 
         '.$partesDescripcionClausula[3][0].'
		  <strong>'.$dura.'</strong>, '.$partesDescripcionClausula[4][0].'
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[4].' - '.$descripcionClausula[4].'</u>:</strong>
		 '.$partesDescripcionClausula[5][0].':
	
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		 
		 		 
        
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[5].' - '.$descripcionClausula[5].'</u>:</strong> 
         '.$partesDescripcionClausula[6][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[6].' - '.$descripcionClausula[6].'</u>:</strong> 
         '.$partesDescripcionClausula[7][0].'.
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[7].' - '.$descripcionClausula[7].'</u>:</strong> 
          '.$partesDescripcionClausula[8][0].'
		  <strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
		  '.$partesDescripcionClausula[9][0].'.
		  </td>
		 </tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[8].' - '.$descripcionClausula[8].'</u>:</strong> 
          '.$partesDescripcionClausula[10][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[9].' - '.$descripcionClausula[9].'</u>:</strong> 
          '.$partesDescripcionClausula[11][0].'
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[10].' - '.$descripcionClausula[10].'</u>:</strong> 
          '.$partesDescripcionClausula[12][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[11].' - '.$descripcionClausula[11].'</u>:</strong> 
          '.$partesDescripcionClausula[13][0].'
		  </td>
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
		  <td>
					  <table width="100%" border="0">
					  <tr>
						<td width="52%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="52%" align="left">&nbsp;</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="52%" align="left">&nbsp;</td>
    					<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="right">ACEPTO: </td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">
						<strong>'.$condescon.' 
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
					  </tr>
					 </table>
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  } 
  
  elseif(($Formclasescontratos->FCCO_ID)==401){/*SI ES UNA ORDEN DE COMPRAVENTA CON POLIZA */
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
	 // $pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 10, true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' '.$numerocontrato.' DE '.$clase.' DE '.$anio_contrato.' </strong></td>
	   </tr>
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
		 <td align="left">Señor (a):</td>
		</tr>
	    <tr>
		 <td align="left"><strong>'.$contratista.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.' / '.$domiciliociudad.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$Modeloordenes->rel_contrato->Persona->PERS_TELEFONO.'</td>
		</tr>
		<tr>
		 <td align="left">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="justify">'.$Formclasescontratos->FCCO_DESCRIPCION.'</td>
		</tr>
		
	     <tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[0].' - '.$descripcionClausula[0].'</u>:</strong> 
		 '.$partesDescripcionClausula[0][0].':<strong> '.$objeto.'.</strong> 
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		
		
		';
		if ($numeroproductos>0) {
		$html .='
					<tr>
					 <td>
					';
					$total=0; $vt=0;
					$i=0;
					$html .='
							<table width="100%" border="1">
					<tr>
					 <td width="46%" valign="middle"><p><strong>PRODUCTO</strong></p></td>
					 <td width="15%" valign="middle"><strong>CANTIDAD</strong></td>
					 <td width="21%"><strong>VALOR UNITARIO</strong></td>
					 <td width="18%"><strong>VALOR TOTAL</strong></td>
					</tr>
					';
					foreach($dataproductos as $rows){
					$Productos = Productos::model()->findByPk($rows["PROD_ID"]);
					$nombre[$i] = $Productos->PROD_NOMBRE;
					$cantidad[$i] = $Productos->PROD_CANTIDAD;
					$valor[$i] = $Productos->PROD_VALOR;
					$porcentajeiva[$i] = $Productos->PROD_IVA;
					$iva= ($valor[$i]*$cantidad[$i])*($porcentajeiva[$i]/100);
					$totaliva= $totaliva + $iva;
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt + $iva;
					//$numeroproductos
					 $html .='	
								<tr>
									<td align="left" width="46%">'.$nombre[$i].'</td>
									<td align="center" width="15%">'.number_format($cantidad[$i]).'</td>
									<td align="rigt" width="21%">'.number_format($valor[$i]).'</td>
									<td align="rigt" width="18%">'.number_format($vt).'</td>
								</tr>
					'; $i++;
					}		
					$html .='	
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>IVA</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($totaliva).'</strong></td>
					</tr>
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>VALOR TOTAL</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($total).'</strong></td>
					</tr>
					</table>
					
						</td>
					</tr>
	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
			';
		}
		$html .='		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[1].' - '.$descripcionClausula[1].'</u>:</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong> '.$formapago.'. 
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[2].' - '.$descripcionClausula[2].'</u>:</strong> 
		 <br/>'.$partesDescripcionClausula[2][0].'
		 </td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><br/><strong><u>'.$nombreClausulas[3].' - '.$descripcionClausula[3].'</u>:</strong> 
         '.$partesDescripcionClausula[3][0].'
		  <strong>'.$dura.'</strong>, '.$partesDescripcionClausula[4][0].'
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[4].' - '.$descripcionClausula[4].'</u>:</strong>
		 '.$partesDescripcionClausula[5][0].':
	
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		 
		 		 
        
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[5].' - '.$descripcionClausula[5].'</u>:</strong> 
         '.$partesDescripcionClausula[6][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  	  
			    
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[6].' - '.$descripcionClausula[6].'.</u>:</strong> 
         '.$partesDescripcionClausula[7][0].'.
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		 
		  <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[7].' - '.$descripcionClausula[7].'</u>:</strong> 
          '.$partesDescripcionClausula[8][0].' 
		  '; 
		     foreach($datagarantias as $rows){
			 $Garantias = Garantias::model()->findByPk($rows["GARA_ID"]);
			 $desgarantia[] = $Garantias->GARA_DESCRIPCION;
			 //echo $Garantias->GARA_DESCRIPCION;
			 }
				 if ($numerogarantias==1) { 
					$html .='	
					 <strong>A '.$Garantias->GARA_DESCRIPCION.'</strong>
					        ';
				 } elseif($numerogarantias==2) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					        ';
				 } elseif($numerogarantias==3) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
					        ';
				 } elseif($numerogarantias==4) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					        ';
				 } elseif($numerogarantias==5) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					        ';
				 } elseif($numerogarantias==6) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					 <strong>F '.$desgarantia[5].'</strong>
					        ';
				 }    
	$html .='
		 
		  </td>
		</tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[8].' - '.$descripcionClausula[8].'</u>:</strong> 
		  '.$partesDescripcionClausula[9][0].'
		  	<strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
          '.$partesDescripcionClausula[10][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[9].' - '.$descripcionClausula[9].'</u>:</strong> 
          '.$partesDescripcionClausula[11][0].'.
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		<td align="justify"><strong><u>'.$nombreClausulas[10].' - '.$descripcionClausula[10].'</u>:</strong> 
          '.$partesDescripcionClausula[12][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[11].' - '.$descripcionClausula[11].'</u>:</strong> 
          '.$partesDescripcionClausula[13][0].'.
		  </td>
		 </tr>
		 	 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	  
		  
		  <tr>
		<td align="justify"><strong><u>'.$nombreClausulas[12].' - '.$descripcionClausula[12].'</u>:</strong> 
          '.$partesDescripcionClausula[14][0].'
		  </td>
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
		  <td>
					  <table width="100%" border="0">
					  <tr>
						<td width="52%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="52%" align="left">&nbsp;</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="52%" align="left">&nbsp;</td>
    					<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="right">ACEPTO: </td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">
						<strong>'.$condescon.' 
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
					  </tr>
					 </table>
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  }
  
  elseif(($Formclasescontratos->FCCO_ID)==502){/*SI ES UNA ORDEN DE TRABAJO SIN POLIZA */
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
	  //$pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 10, true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' '.$numerocontrato.' DE '.$clase.' DE  '.$anio_contrato.' </strong></td>
	   </tr>
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
		 <td align="left">Señor (a):</td>
		</tr>
	    <tr>
		 <td align="left">
		<strong>'.$contratista.'</strong>
	   </td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.' / '.$domiciliociudad.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$Modeloordenes->rel_contrato->Persona->PERS_TELEFONO.'</td>
		</tr>
		<tr>
		 <td align="left">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="justify">'.$Formclasescontratos->FCCO_DESCRIPCION.'</td>
		</tr>
		
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[0].' - '.$descripcionClausula[0].'</u>:</strong> 
		 '.$partesDescripcionClausula[0][0].':<strong> '.$objeto.'.</strong> 
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		
			
		';
		if ($numeroproductos>0) {
		$html .='
					<tr>
					 <td>
					';
					$total=0; $vt=0;
					$i=0;
					$html .='
							<table width="100%" border="1">
					<tr>
					 <td width="46%" valign="middle"><p><strong>PRODUCTO</strong></p></td>
					 <td width="15%" valign="middle"><strong>CANTIDAD</strong></td>
					 <td width="21%"><strong>VALOR UNITARIO</strong></td>
					 <td width="18%"><strong>VALOR TOTAL</strong></td>
					</tr>
					';
					foreach($dataproductos as $rows){
					$Productos = Productos::model()->findByPk($rows["PROD_ID"]);
					$nombre[$i] = $Productos->PROD_NOMBRE;
					$cantidad[$i] = $Productos->PROD_CANTIDAD;
					$valor[$i] = $Productos->PROD_VALOR;
					$porcentajeiva[$i] = $Productos->PROD_IVA;
					$iva= ($valor[$i]*$cantidad[$i])*($porcentajeiva[$i]/100);
					$totaliva= $totaliva + $iva;
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt + $iva;
					//$numeroproductos
					 $html .='	
								<tr>
									<td align="left" width="46%">'.$nombre[$i].'</td>
									<td align="center" width="15%">'.number_format($cantidad[$i]).'</td>
									<td align="rigt" width="21%">'.number_format($valor[$i]).'</td>
									<td align="rigt" width="18%">'.number_format($vt).'</td>
								</tr>
					'; $i++;
					}		
					$html .='	
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>IVA</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($totaliva).'</strong></td>
					</tr>
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>VALOR TOTAL</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($total).'</strong></td>
					</tr>
					</table>
					
						</td>
					</tr>
	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
			';
		}
		$html .='		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[1].' - '.$descripcionClausula[1].'</u>:</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong> '.$formapago.'. 
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[2].' - '.$descripcionClausula[2].'</u>:</strong> 
		 <br/>'.$partesDescripcionClausula[2][0].'
		 </td>
		</tr>
		  
			  		  
		  
		<tr>
		 <td align="justify"><br/><strong><u>'.$nombreClausulas[3].' - '.$descripcionClausula[3].'</u>:</strong> 
         '.$partesDescripcionClausula[3][0].'
		  <strong>'.$dura.'</strong>, '.$partesDescripcionClausula[4][0].'
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[4].' - '.$descripcionClausula[4].'</u>:</strong>
		 '.$partesDescripcionClausula[5][0].':
	
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		 
		 		 
        
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[5].' - '.$descripcionClausula[5].'</u>:</strong> 
         '.$partesDescripcionClausula[6][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[6].' - '.$descripcionClausula[6].'</u>:</strong> 
         '.$partesDescripcionClausula[7][0].'.
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[7].' - '.$descripcionClausula[7].'</u>:</strong> 
          '.$partesDescripcionClausula[8][0].'
		  <strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
		  '.$partesDescripcionClausula[9][0].'.
		  </td>
		 </tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[8].' - '.$descripcionClausula[8].'</u>:</strong> 
          '.$partesDescripcionClausula[10][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[9].' - '.$descripcionClausula[9].'</u>:</strong> 
          '.$partesDescripcionClausula[11][0].'
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[10].' - '.$descripcionClausula[10].'</u>:</strong> 
          '.$partesDescripcionClausula[12][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[11].' - '.$descripcionClausula[11].'</u>:</strong> 
          '.$partesDescripcionClausula[13][0].'
		  </td>
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
		  <td>
					  <table width="100%" border="0">
					  <tr>
						<td width="52%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="52%" align="left">&nbsp;</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="52%" align="left">&nbsp;</td>
    					<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="right">ACEPTO: </td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">
						<strong>'.$condescon.' 
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
					  </tr>
					 </table>
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  } 
  
  elseif(($Formclasescontratos->FCCO_ID)==501){/*SI ES UNA ORDEN DE TRABAJO CON POLIZA */
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
	  //$pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 10, true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' '.$numerocontrato.' DE '.$clase.' DE '.$anio_contrato.' </strong></td>
	   </tr>
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
		 <td align="left">Señor (a):</td>
		</tr>
	    <tr>
		 <td align="left"><strong>'.$contratista.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.' / '.$domiciliociudad.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$Modeloordenes->rel_contrato->Persona->PERS_TELEFONO.'</td>
		</tr>
		<tr>
		 <td align="left">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="justify">'.$Formclasescontratos->FCCO_DESCRIPCION.'</td>
		</tr>
		
	     <tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[0].' - '.$descripcionClausula[0].'</u>:</strong> 
		 '.$partesDescripcionClausula[0][0].':<strong> '.$objeto.'.</strong> 
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		
		
		';
		if ($numeroproductos>0) {
		$html .='
					<tr>
					 <td>
					';
					$total=0; $vt=0;
					$i=0;
					$html .='
							<table width="100%" border="1">
					<tr>
					 <td width="46%" valign="middle"><p><strong>PRODUCTO</strong></p></td>
					 <td width="15%" valign="middle"><strong>CANTIDAD</strong></td>
					 <td width="21%"><strong>VALOR UNITARIO</strong></td>
					 <td width="18%"><strong>VALOR TOTAL</strong></td>
					</tr>
					';
					foreach($dataproductos as $rows){
					$Productos = Productos::model()->findByPk($rows["PROD_ID"]);
					$nombre[$i] = $Productos->PROD_NOMBRE;
					$cantidad[$i] = $Productos->PROD_CANTIDAD;
					$valor[$i] = $Productos->PROD_VALOR;
					$porcentajeiva[$i] = $Productos->PROD_IVA;
					$iva= ($valor[$i]*$cantidad[$i])*($porcentajeiva[$i]/100);
					$totaliva= $totaliva + $iva;
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt + $iva;
					//$numeroproductos
					 $html .='	
								<tr>
									<td align="left" width="46%">'.$nombre[$i].'</td>
									<td align="center" width="15%">'.number_format($cantidad[$i]).'</td>
									<td align="rigt" width="21%">'.number_format($valor[$i]).'</td>
									<td align="rigt" width="18%">'.number_format($vt).'</td>
								</tr>
					'; $i++;
					}		
					$html .='	
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>IVA</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($totaliva).'</strong></td>
					</tr>
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>VALOR TOTAL</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($total).'</strong></td>
					</tr>
					</table>
					
						</td>
					</tr>
	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
			';
		}
		$html .='		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[1].' - '.$descripcionClausula[1].'</u>:</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong> '.$formapago.'. 
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[2].' - '.$descripcionClausula[2].'</u>:</strong> 
		 <br/>'.$partesDescripcionClausula[2][0].'
		 </td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><br/><strong><u>'.$nombreClausulas[3].' - '.$descripcionClausula[3].'</u>:</strong> 
         '.$partesDescripcionClausula[3][0].'
		  <strong>'.$dura.'</strong>, '.$partesDescripcionClausula[4][0].'
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[4].' - '.$descripcionClausula[4].'</u>:</strong>
		 '.$partesDescripcionClausula[5][0].':
	
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		 
		 		 
        
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[5].' - '.$descripcionClausula[5].'</u>:</strong> 
         '.$partesDescripcionClausula[6][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  	  
			    
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[6].' - '.$descripcionClausula[6].'.</u>:</strong> 
         '.$partesDescripcionClausula[7][0].'.
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		 
		  <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[7].' - '.$descripcionClausula[7].'</u>:</strong> 
          '.$partesDescripcionClausula[8][0].' 
		  '; 
		     foreach($datagarantias as $rows){
			 $Garantias = Garantias::model()->findByPk($rows["GARA_ID"]);
			 $desgarantia[] = $Garantias->GARA_DESCRIPCION;
			 //echo $Garantias->GARA_DESCRIPCION;
			 }
				 if ($numerogarantias==1) { 
					$html .='	
					 <strong>A '.$Garantias->GARA_DESCRIPCION.'</strong>
					        ';
				 } elseif($numerogarantias==2) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					        ';
				 } elseif($numerogarantias==3) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
					        ';
				 } elseif($numerogarantias==4) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					        ';
				 } elseif($numerogarantias==5) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					        ';
				 } elseif($numerogarantias==6) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					 <strong>F '.$desgarantia[5].'</strong>
					        ';
				 }    
	$html .='
		 
		  </td>
		</tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[8].' - '.$descripcionClausula[8].'</u>:</strong> 
		  '.$partesDescripcionClausula[9][0].'
		  	<strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
          '.$partesDescripcionClausula[10][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[9].' - '.$descripcionClausula[9].'</u>:</strong> 
          '.$partesDescripcionClausula[11][0].'.
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		<td align="justify"><strong><u>'.$nombreClausulas[10].' - '.$descripcionClausula[10].'</u>:</strong> 
          '.$partesDescripcionClausula[12][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[11].' - '.$descripcionClausula[11].'</u>:</strong> 
          '.$partesDescripcionClausula[13][0].'.
		  </td>
		 </tr>
		 	 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	  
		  
		  <tr>
		<td align="justify"><strong><u>'.$nombreClausulas[12].' - '.$descripcionClausula[12].'</u>:</strong> 
          '.$partesDescripcionClausula[14][0].'
		  </td>
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
		  <td>
					  <table width="100%" border="0">
					  <tr>
						<td width="52%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="52%" align="left">&nbsp;</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="52%" align="left">&nbsp;</td>
    					<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="right">ACEPTO: </td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">
						<strong>'.$condescon.' 
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
					  </tr>
					 </table>
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  }
  
  elseif(($Formclasescontratos->FCCO_ID)==602){/*SI ES UNA ORDEN DE ARRENDAMIENTO SIN POLIZA */
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
	  //$pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 10, true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' '.$numerocontrato.' DE '.$clase.' DE  '.$anio_contrato.' </strong></td>
	   </tr>
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
		 <td align="left">Señor (a):</td>
		</tr>
	    <tr>
		 <td align="left">
		<strong>'.$contratista.'</strong>
	   </td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.' / '.$domiciliociudad.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$Modeloordenes->rel_contrato->Persona->PERS_TELEFONO.'</td>
		</tr>
		<tr>
		 <td align="left">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="justify">'.$Formclasescontratos->FCCO_DESCRIPCION.'</td>
		</tr>
		
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[0].' - '.$descripcionClausula[0].'</u>:</strong> 
		 '.$partesDescripcionClausula[0][0].':<strong> '.$objeto.'.</strong> 
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		
			
		';
		if ($numeroproductos>0) {
		$html .='
					<tr>
					 <td>
					';
					$total=0; $vt=0;
					$i=0;
					$html .='
							<table width="100%" border="1">
					<tr>
					 <td width="46%" valign="middle"><p><strong>PRODUCTO</strong></p></td>
					 <td width="15%" valign="middle"><strong>CANTIDAD</strong></td>
					 <td width="21%"><strong>VALOR UNITARIO</strong></td>
					 <td width="18%"><strong>VALOR TOTAL</strong></td>
					</tr>
					';
					foreach($dataproductos as $rows){
					$Productos = Productos::model()->findByPk($rows["PROD_ID"]);
					$nombre[$i] = $Productos->PROD_NOMBRE;
					$cantidad[$i] = $Productos->PROD_CANTIDAD;
					$valor[$i] = $Productos->PROD_VALOR;
					$porcentajeiva[$i] = $Productos->PROD_IVA;
					$iva= ($valor[$i]*$cantidad[$i])*($porcentajeiva[$i]/100);
					$totaliva= $totaliva + $iva;
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt + $iva;
					//$numeroproductos
					 $html .='	
								<tr>
									<td align="left" width="46%">'.$nombre[$i].'</td>
									<td align="center" width="15%">'.number_format($cantidad[$i]).'</td>
									<td align="rigt" width="21%">'.number_format($valor[$i]).'</td>
									<td align="rigt" width="18%">'.number_format($vt).'</td>
								</tr>
					'; $i++;
					}		
					$html .='	
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>IVA</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($totaliva).'</strong></td>
					</tr>
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>VALOR TOTAL</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($total).'</strong></td>
					</tr>
					</table>
					
						</td>
					</tr>
	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
			';
		}
		$html .='		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[1].' - '.$descripcionClausula[1].'</u>:</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong> '.$formapago.'. 
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[2].' - '.$descripcionClausula[2].'</u>:</strong> 
		 <br/>'.$partesDescripcionClausula[2][0].'
		 </td>
		</tr>
		  
			  		  
		  
		<tr>
		 <td align="justify"><br/><strong><u>'.$nombreClausulas[3].' - '.$descripcionClausula[3].'</u>:</strong> 
         '.$partesDescripcionClausula[3][0].'
		  <strong>'.$dura.'</strong>, '.$partesDescripcionClausula[4][0].'
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[4].' - '.$descripcionClausula[4].'</u>:</strong>
		 '.$partesDescripcionClausula[5][0].':
	
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		 
		 		 
        
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[5].' - '.$descripcionClausula[5].'</u>:</strong> 
         '.$partesDescripcionClausula[6][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[6].' - '.$descripcionClausula[6].'</u>:</strong> 
         '.$partesDescripcionClausula[7][0].'.
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[7].' - '.$descripcionClausula[7].'</u>:</strong> 
          '.$partesDescripcionClausula[8][0].'
		  <strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
		  '.$partesDescripcionClausula[9][0].'.
		  </td>
		 </tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[8].' - '.$descripcionClausula[8].'</u>:</strong> 
          '.$partesDescripcionClausula[10][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[9].' - '.$descripcionClausula[9].'</u>:</strong> 
          '.$partesDescripcionClausula[11][0].'
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[10].' - '.$descripcionClausula[10].'</u>:</strong> 
          '.$partesDescripcionClausula[12][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[11].' - '.$descripcionClausula[11].'</u>:</strong> 
          '.$partesDescripcionClausula[13][0].'
		  </td>
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
		  <td>
					  <table width="100%" border="0">
					  <tr>
						<td width="52%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="52%" align="left">&nbsp;</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="52%" align="left">&nbsp;</td>
    					<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="right">ACEPTO: </td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">
						<strong>'.$condescon.' 
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
					  </tr>
					 </table>
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  } 
  
  elseif(($Formclasescontratos->FCCO_ID)==601){/*SI ES UNA ORDEN DE ARRENDAMIENTO CON POLIZA */
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
	 // $pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 10, true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' '.$numerocontrato.' DE '.$clase.' DE '.$anio_contrato.' </strong></td>
	   </tr>
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
		 <td align="left">Señor (a):</td>
		</tr>
	    <tr>
		 <td align="left"><strong>'.$contratista.'</strong></td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.' / '.$domiciliociudad.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$Modeloordenes->rel_contrato->Persona->PERS_TELEFONO.'</td>
		</tr>
		<tr>
		 <td align="left">&nbsp;</td>
		</tr>
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		<tr>
		 <td align="justify">'.$Formclasescontratos->FCCO_DESCRIPCION.'</td>
		</tr>
		
	     <tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[0].' - '.$descripcionClausula[0].'</u>:</strong> 
		 '.$partesDescripcionClausula[0][0].':<strong> '.$objeto.'.</strong> 
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		
		
		';
		if ($numeroproductos>0) {
		$html .='
					<tr>
					 <td>
					';
					$total=0; $vt=0;
					$i=0;
					$html .='
							<table width="100%" border="1">
					<tr>
					 <td width="46%" valign="middle"><p><strong>PRODUCTO</strong></p></td>
					 <td width="15%" valign="middle"><strong>CANTIDAD</strong></td>
					 <td width="21%"><strong>VALOR UNITARIO</strong></td>
					 <td width="18%"><strong>VALOR TOTAL</strong></td>
					</tr>
					';
					foreach($dataproductos as $rows){
					$Productos = Productos::model()->findByPk($rows["PROD_ID"]);
					$nombre[$i] = $Productos->PROD_NOMBRE;
					$cantidad[$i] = $Productos->PROD_CANTIDAD;
					$valor[$i] = $Productos->PROD_VALOR;
					$porcentajeiva[$i] = $Productos->PROD_IVA;
					$iva= ($valor[$i]*$cantidad[$i])*($porcentajeiva[$i]/100);
					$totaliva= $totaliva + $iva;
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt + $iva;
					//$numeroproductos
					 $html .='	
								<tr>
									<td align="left" width="46%">'.$nombre[$i].'</td>
									<td align="center" width="15%">'.number_format($cantidad[$i]).'</td>
									<td align="rigt" width="21%">'.number_format($valor[$i]).'</td>
									<td align="rigt" width="18%">'.number_format($vt).'</td>
								</tr>
					'; $i++;
					}		
					$html .='	
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>IVA</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($totaliva).'</strong></td>
					</tr>
					<tr>
					 <td colspan="3" align="center" width="82%"><strong>VALOR TOTAL</strong></td>
					 <td align="rigt" width="18%"><strong>'.number_format($total).'</strong></td>
					</tr>
					</table>
					
						</td>
					</tr>
	
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>
			';
		}
		$html .='		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[1].' - '.$descripcionClausula[1].'</u>:</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong> '.$formapago.'. 
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[2].' - '.$descripcionClausula[2].'</u>:</strong> 
		 <br/>'.$partesDescripcionClausula[2][0].'
		 </td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><br/><strong><u>'.$nombreClausulas[3].' - '.$descripcionClausula[3].'</u>:</strong> 
         '.$partesDescripcionClausula[3][0].'
		  <strong>'.$dura.'</strong>, '.$partesDescripcionClausula[4][0].'
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[4].' - '.$descripcionClausula[4].'</u>:</strong>
		 '.$partesDescripcionClausula[5][0].':
	
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		 
		 		 
        
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[5].' - '.$descripcionClausula[5].'</u>:</strong> 
         '.$partesDescripcionClausula[6][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  	  
			    
		<tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[6].' - '.$descripcionClausula[6].'.</u>:</strong> 
         '.$partesDescripcionClausula[7][0].'.
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>	
		 
		  <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[7].' - '.$descripcionClausula[7].'</u>:</strong> 
          '.$partesDescripcionClausula[8][0].' 
		  '; 
		     foreach($datagarantias as $rows){
			 $Garantias = Garantias::model()->findByPk($rows["GARA_ID"]);
			 $desgarantia[] = $Garantias->GARA_DESCRIPCION;
			 //echo $Garantias->GARA_DESCRIPCION;
			 }
				 if ($numerogarantias==1) { 
					$html .='	
					 <strong>A '.$Garantias->GARA_DESCRIPCION.'</strong>
					        ';
				 } elseif($numerogarantias==2) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					        ';
				 } elseif($numerogarantias==3) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
					        ';
				 } elseif($numerogarantias==4) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					        ';
				 } elseif($numerogarantias==5) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					        ';
				 } elseif($numerogarantias==6) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					 <strong>F '.$desgarantia[5].'</strong>
					        ';
				 }    
	$html .='
		 
		  </td>
		</tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[8].' - '.$descripcionClausula[8].'</u>:</strong> 
		  '.$partesDescripcionClausula[9][0].'
		  	<strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
          '.$partesDescripcionClausula[10][0].'.
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong><u>'.$nombreClausulas[9].' - '.$descripcionClausula[9].'</u>:</strong> 
          '.$partesDescripcionClausula[11][0].'.
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		<td align="justify"><strong><u>'.$nombreClausulas[10].' - '.$descripcionClausula[10].'</u>:</strong> 
          '.$partesDescripcionClausula[12][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		 <td align="justify"><strong><u>'.$nombreClausulas[11].' - '.$descripcionClausula[11].'</u>:</strong> 
          '.$partesDescripcionClausula[13][0].'.
		  </td>
		 </tr>
		 	 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	  
		  
		  <tr>
		<td align="justify"><strong><u>'.$nombreClausulas[12].' - '.$descripcionClausula[12].'</u>:</strong> 
          '.$partesDescripcionClausula[14][0].'
		  </td>
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
		  <td>
					  <table width="100%" border="0">
					  <tr>
						<td width="52%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="52%" align="left">&nbsp;</td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="52%" align="left">&nbsp;</td>
    					<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="52%" align="right">ACEPTO: </td>
						<td width="1%" align="left">&nbsp;</td>
						<td width="47%" align="left">
						<strong>'.$condescon.' 
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left">&nbsp;</td>
						<td align="left">&nbsp;</td>
					  </tr>
					 </table>
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  }
  
  elseif(($Formclasescontratos->FCCO_ID)==801){/*SI ES UN CONTRATO DE PRESTACION DE SERVICIOS GENERALES*/
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
	  //$pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 11, true);
	  $pdf->AddPage();
	 
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		 <td align="center"><strong>'.$tipo.' No. '.$numerocontrato.' DE PRESTACIÓN DE SERVICIOS DE '.$anio_contrato.'</strong></td>
	   </tr>
	   <tr>
		 <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		 <td>
		 
		 <table width="100%" border="1">
		  <tr>
			<td align="left" width="20%">CONTRATANTE:</td>
			<td align="left" width="80%"><strong>UNIVERSIDAD DE LA GUAJIRA.</strong></td>
		 </tr>
		  <tr>
			<td align="left" width="20%">CONTRATISTA:</td>
			<td align="justify" width="80%"><strong>'.$contratista.'</strong></td>
		  </tr>
		  <tr>
			<td align="left" width="20%">VALOR:</td>
			<td align="justify" width="80%"><strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong></td>
		  </tr>
		  <tr>
			<td align="left" width="20%">OBJETO:</td>
			<td align="justify" width="80%"><strong>'.$objeto.'.</strong></td>
		  </tr>
		  <tr>
			<td align="left" width="20%">DURACIÓN:</td>
			<td align="justify" width="80%"><strong>'.$dura.'</strong></td>
		  </tr>
		</table>
		 
		 </td>
	  </tr>
	  
	  <tr>
		 <td align="center">&nbsp;</td>
	  </tr>
	  
	    <tr>
		<td align="justify">'.$ContratanteContratos.' '.$ContratistaContratos.'
		<strong>'.$descripcionClausula[0].'</strong> '.$partesDescripcionClausula[0][0].'. 
		<strong>'.$descripcionClausula[1].'</strong> '.$partesDescripcionClausula[1][0].'. 
		<strong>'.$descripcionClausula[2].'</strong> '.$partesDescripcionClausula[2][0].'. 
		<strong>'.$descripcionClausula[3].'</strong> '.$partesDescripcionClausula[3][0].'. 
		<strong>'.$descripcionClausula[4].'</strong> '.$partesDescripcionClausula[4][0].'. 
		<strong>'.$descripcionClausula[5].'</strong> '.$partesDescripcionClausula[5][0].'. 
		<strong>'.$descripcionClausula[6].'</strong> '.$partesDescripcionClausula[6][0].'. 
		<strong>'.$descripcionClausula[7].'</strong> '.$partesDescripcionClausula[7][0].'. 
		<strong>'.$descripcionClausula[8].'</strong> '.$partesDescripcionClausula[8][0].'. 
		
		<strong>'.$descripcionClausula[9].'</strong> '.$partesDescripcionClausula[9][0].' 
		'.$Modeloordenes->rel_necesidad->NECE_NOMBRE.'.
		
		<strong>'.$descripcionClausula[10].'</strong> '.$partesDescripcionClausula[10][0].':
		<strong>'.$contratista.'</strong> 
		
		'; 
		     foreach($datainvitados as $rows){
			 $invitados = Invitados::model()->findByPk($rows["INVI_ID"]);
			 $invitado[] = $invitados->INVI_NOMBRE;
			 }
				 if ($numeroinvitados==1) { 
					$html .='
					<strong>, '.$invitado[0].'.</strong> 
					        ';
				 } elseif($numeroinvitados==2) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].'.</strong>
					        ';
				 } elseif($numeroinvitados==3) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].', '.$invitado[2].'.</strong>
					        ';
				 } elseif($numeroinvitados==4) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].', '.$invitado[2].', '.$invitado[3].'.</strong>
					        ';
				 } elseif($numeroinvitados==5) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].', '.$invitado[2].', '.$invitado[3].', '.$invitado[4].'.</strong>
					        ';
				 } elseif($numeroinvitados==6) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].', '.$invitado[2].', '.$invitado[3].', '.$invitado[4].', '.$invitado[5].'.</strong>
					        ';
				 }    
	$html .='
		
		
		'.$partesDescripcionClausula[11][0].'.
		
		<strong> '.$descripcionClausula[11].'</strong> '.$partesDescripcionClausula[12][0].' el 
		<strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong> '.$partesDescripcionClausula[13][0].'. 	
		
		<strong>'.$descripcionClausula[12].'</strong> '.$partesDescripcionClausula[14][0].'.
		
		<strong><u>CLÁUSULA '.$nombreClausulas[13].' - '.$descripcionClausula[13].'</u></strong>: 
		'.$partesDescripcionClausula[15][0].'<strong>'.$objeto.'</strong> '.$partesDescripcionClausula[16][0].'.
		
		<strong><u>CLÁUSULA '.$nombreClausulas[14].' - '.$descripcionClausula[14].'</u></strong>: 
		'.$partesDescripcionClausula[17][0].' '.$valorContratoLetras.' 
		($'.number_format($valorContrato).') M/CTE. '.$partesDescripcionClausula[18][0].':<strong> 
		'.$Modeloordenes->rel_formadepago->FOPA_DESCRIPCION.'.</strong> '.$partesDescripcionClausula[19][0].'.
		
		<strong><u>CLÁUSULA '.$nombreClausulas[15].' - '.$descripcionClausula[15].'</u></strong>: '.$partesDescripcionClausula[20][0].''.$presupu.'
		
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		
		<strong><u>CLÁUSULA '.$nombreClausulas[16].' - '.$descripcionClausula[16].'</u></strong>: 
		'.$partesDescripcionClausula[21][0].' <strong>'.$dura.'</strong> '.$partesDescripcionClausula[22][0].'.
		
		<strong><u>CLÁUSULA '.$nombreClausulas[17].' - '.$descripcionClausula[17].'</u></strong>: '.$partesDescripcionClausula[23][0].'. 
		
		<strong><u>CLÁUSULA '.$nombreClausulas[18].' - '.$descripcionClausula[18].'</u></strong>: '.$partesDescripcionClausula[24][0].'
		'; 
		     foreach($datagarantias as $rows){
			 $Garantias = Garantias::model()->findByPk($rows["GARA_ID"]);
			 $desgarantia[] = $Garantias->GARA_DESCRIPCION;
			 //echo $Garantias->GARA_DESCRIPCION;
			 }
				 if ($numerogarantias==1) { 
					$html .='	
					 <strong>A '.$Garantias->GARA_DESCRIPCION.'</strong>
					        ';
				 } elseif($numerogarantias==2) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					        ';
				 } elseif($numerogarantias==3) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
					        ';
				 } elseif($numerogarantias==4) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					        ';
				 } elseif($numerogarantias==5) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					        ';
				 } elseif($numerogarantias==6) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					 <strong>F '.$desgarantia[5].'</strong>
					        ';
				 }    
	$html .='
		
		<strong><u>CLÁUSULA '.$nombreClausulas[19].' - '.$descripcionClausula[19].'</u></strong>: '.$partesDescripcionClausula[25][0].' <strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>'.$partesDescripcionClausula[26][0].'.
	
		<strong><u>CLÁUSULA '.$nombreClausulas[20].' - '.$descripcionClausula[20].'</u></strong>: '.$partesDescripcionClausula[27][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[21].' - '.$descripcionClausula[21].'</u></strong>: '.$partesDescripcionClausula[28][0].'.
	    <strong><u>CLÁUSULA '.$nombreClausulas[22].' - '.$descripcionClausula[22].'</u></strong>: '.$partesDescripcionClausula[29][0].'.
	    <strong><u>CLÁUSULA '.$nombreClausulas[23].' - '.$descripcionClausula[23].'</u></strong>: '.$partesDescripcionClausula[30][0].'. 
		<strong><u>CLÁUSULA '.$nombreClausulas[24].' - '.$descripcionClausula[24].'</u></strong>: '.$partesDescripcionClausula[31][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[25].' - '.$descripcionClausula[25].'</u></strong>: '.$partesDescripcionClausula[32][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[26].' - '.$descripcionClausula[26].'</u></strong>: '.$partesDescripcionClausula[33][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[27].' - '.$descripcionClausula[27].'</u></strong>: '.$partesDescripcionClausula[34][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[28].' - '.$descripcionClausula[28].'</u></strong>: '.$partesDescripcionClausula[35][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[29].' - '.$descripcionClausula[29].'</u></strong>: '.$partesDescripcionClausula[36][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[30].' - '.$descripcionClausula[30].'</u></strong>: '.$partesDescripcionClausula[37][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[31].' - '.$descripcionClausula[31].'</u></strong>: '.$partesDescripcionClausula[38][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[32].' - '.$descripcionClausula[32].'</u></strong>: '.$partesDescripcionClausula[39][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[33].' - '.$descripcionClausula[33].'</u></strong>: '.$partesDescripcionClausula[40][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[34].' - '.$descripcionClausula[34].'</u></strong>: '.$partesDescripcionClausula[41][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[35].' - '.$descripcionClausula[35].'</u></strong>: '.$partesDescripcionClausula[42][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[36].' - '.$descripcionClausula[36].'</u></strong>: '.$partesDescripcionClausula[43][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[37].' - '.$descripcionClausula[37].'</u></strong>: '.$partesDescripcionClausula[44][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[38].' - '.$descripcionClausula[38].'</u></strong>: '.$partesDescripcionClausula[45][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[39].' - '.$descripcionClausula[39].'</u></strong>: '.$partesDescripcionClausula[46][0].'
		en '.$domicilio.'.
		<strong><u>CLÁUSULA '.$nombreClausulas[40].' - '.$descripcionClausula[40].'</u></strong>: '.$partesDescripcionClausula[47][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[41].' - '.$descripcionClausula[41].'</u></strong>: '.$partesDescripcionClausula[48][0].'.
		Para constancia del presente acto se firma en Riohacha, Capital del Departamento de La Guajira, a los '.$fechacontratos.'.
		</td>
		</tr>
	
	   	<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="center">
		 
			<table width="100%" border="0">
			  <tr>
				<td width="50%" align="left"><strong>POR LA UNIVERSIDAD</strong></td>
				<td width="50%" align="left"><strong>POR EL CONTRATISTA</strong></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td align="left">
				<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'
				<br/>'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</strong>
				</td>
				<td align="left"><strong>'.$condescon.'</strong></td>
			  </tr>
			 </table>
			
		 </td>
		</tr>
	   </table>
	   ';
  } 
  
    elseif(($Formclasescontratos->FCCO_ID)==901){/*SI ES UN CONTRATO DE SUMINISTRO CON SUPERVISIÓN*/
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
	  //$pdf->SetFont('times', 'B', '20', true);
	  $pdf->SetFont('times', 'K', 11, true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		 <td align="center"><strong>'.$tipo.' No. '.$numerocontrato.' DE SUMINISTRO DE '.$anio_contrato.'</strong></td>
	   </tr>
	   <tr>
		 <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		 <td>
		 
		 <table width="100%" border="1">
		  <tr>
			<td align="left" width="20%">CONTRATANTE:</td>
			<td align="left" width="80%"><strong>UNIVERSIDAD DE LA GUAJIRA.</strong></td>
		 </tr>
		  <tr>
			<td align="left" width="20%">CONTRATISTA:</td>
			<td align="justify" width="80%"><strong>'.$contratista.'.</strong></td>
		  </tr>
		  <tr>
			<td align="left" width="20%">VALOR:</td>
			<td align="justify" width="80%"><strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong></td>
		  </tr>
		  <tr>
			<td align="left" width="20%">OBJETO:</td>
			<td align="justify" width="80%"><strong>'.$objeto.'.</strong></td>
		  </tr>
		  <tr>
			<td align="left" width="20%">DURACIÓN:</td>
			<td align="justify" width="80%"><strong>'.$dura.'.</strong></td>
		  </tr>
		</table>
		 
		 </td>
	  </tr>
	  
	  <tr>
		 <td align="center">&nbsp;</td>
	  </tr>
	  
	    <tr>
		<td align="justify">'.$ContratanteContratos.' '.$ContratistaContratos.'
		<strong>'.$descripcionClausula[0].'</strong> '.$partesDescripcionClausula[0][0].'. 
		<strong>'.$descripcionClausula[1].'</strong> '.$partesDescripcionClausula[1][0].'. 
		<strong>'.$descripcionClausula[2].'</strong> '.$partesDescripcionClausula[2][0].'. 
		<strong>'.$descripcionClausula[3].'</strong> '.$partesDescripcionClausula[3][0].'. 
		<strong>'.$descripcionClausula[4].'</strong> '.$partesDescripcionClausula[4][0].'. 
		<strong>'.$descripcionClausula[5].'</strong> '.$partesDescripcionClausula[5][0].'. 
		<strong>'.$descripcionClausula[6].'</strong> '.$partesDescripcionClausula[6][0].'. 
		<strong>'.$descripcionClausula[7].'</strong> '.$partesDescripcionClausula[7][0].'. 
		<strong>'.$descripcionClausula[8].'</strong> '.$partesDescripcionClausula[8][0].' '.$Modeloordenes->rel_necesidad->NECE_NOMBRE.'. 
		<strong>'.$descripcionClausula[9].'</strong> '.$partesDescripcionClausula[9][0].'. 
		<strong>'.$descripcionClausula[10].'</strong> '.$partesDescripcionClausula[10][0].' <strong>'.$contratista.'</strong>
		
		
		 '; 
		     foreach($datainvitados as $rows){
			 $invitados = Invitados::model()->findByPk($rows["INVI_ID"]);
			 $invitado[] = $invitados->INVI_NOMBRE;
			 }
				 if ($numeroinvitados==1) { 
					$html .='
					<strong>, '.$invitado[0].'.</strong> 
					        ';
				 } elseif($numeroinvitados==2) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].'.</strong>
					        ';
				 } elseif($numeroinvitados==3) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].', '.$invitado[2].'.</strong>
					        ';
				 } elseif($numeroinvitados==4) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].', '.$invitado[2].', '.$invitado[3].'.</strong>
					        ';
				 } elseif($numeroinvitados==5) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].', '.$invitado[2].', '.$invitado[3].', '.$invitado[4].'.</strong>
					        ';
				 } elseif($numeroinvitados==6) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].', '.$invitado[2].', '.$invitado[3].', '.$invitado[4].', '.$invitado[5].'.</strong>
					        ';
				 }    
	$html .='
		
		<strong> '.$descripcionClausula[11].'</strong> '.$partesDescripcionClausula[11][0].' <strong>'.$contratista.'</strong>'.$partesDescripcionClausula[12][0].' 
			
		<strong><u>CLÁUSULA '.$nombreClausulas[13].' - '.$descripcionClausula[13].'</u></strong>: 
		'.$partesDescripcionClausula[13][0].'<strong>'.$objeto.'</strong> '.$partesDescripcionClausula[14][0].'.
		
		<strong><u>CLÁUSULA '.$nombreClausulas[14].' - '.$descripcionClausula[14].'</u></strong>: 
		'.$partesDescripcionClausula[15][0].' '.$valorContratoLetras.' 
		($'.number_format($valorContrato).') M/CTE. '.$partesDescripcionClausula[16][0].':<strong> 
		'.$Modeloordenes->rel_formadepago->FOPA_DESCRIPCION.'.</strong> '.$partesDescripcionClausula[17][0].'.
		
		<strong><u>CLÁUSULA '.$nombreClausulas[15].' - '.$descripcionClausula[15].'</u></strong>: '.$partesDescripcionClausula[18][0].''.$presupu.'
		
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		
		<strong><u>CLÁUSULA '.$nombreClausulas[16].' - '.$descripcionClausula[16].'</u></strong>: 
		'.$partesDescripcionClausula[19][0].' <strong>'.$dura.'</strong> '.$partesDescripcionClausula[20][0].'.
		
		<strong><u>CLÁUSULA '.$nombreClausulas[17].' - '.$descripcionClausula[17].'</u></strong>: '.$partesDescripcionClausula[21][0].'. 
		<strong><u>CLÁUSULA '.$nombreClausulas[18].' - '.$descripcionClausula[18].'</u></strong>: '.$partesDescripcionClausula[22][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[19].' - '.$descripcionClausula[19].'</u></strong>: '.$partesDescripcionClausula[23][0].'.
	
		<strong><u>CLÁUSULA '.$nombreClausulas[20].' - '.$descripcionClausula[20].'</u></strong>: '.$partesDescripcionClausula[24][0].'
		
		'; 
		     foreach($datagarantias as $rows){
			 $Garantias = Garantias::model()->findByPk($rows["GARA_ID"]);
			 $desgarantia[] = $Garantias->GARA_DESCRIPCION;
			 //echo $Garantias->GARA_DESCRIPCION;
			 }
				 if ($numerogarantias==1) { 
					$html .='	
					 <strong>A '.$Garantias->GARA_DESCRIPCION.'</strong>
					        ';
				 } elseif($numerogarantias==2) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					        ';
				 } elseif($numerogarantias==3) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
					        ';
				 } elseif($numerogarantias==4) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					        ';
				 } elseif($numerogarantias==5) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					        ';
				 } elseif($numerogarantias==6) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					 <strong>F '.$desgarantia[5].'</strong>
					        ';
				 }    
	$html .='
		
		
		
		<strong><u>CLÁUSULA '.$nombreClausulas[21].' - '.$descripcionClausula[21].'</u></strong>: '.$partesDescripcionClausula[25][0].' <strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>'.$partesDescripcionClausula[26][0].'
		
	    <strong><u>CLÁUSULA '.$nombreClausulas[22].' - '.$descripcionClausula[22].'</u></strong>: '.$partesDescripcionClausula[27][0].'.
	    <strong><u>CLÁUSULA '.$nombreClausulas[23].' - '.$descripcionClausula[23].'</u></strong>: '.$partesDescripcionClausula[28][0].'. 
		<strong><u>CLÁUSULA '.$nombreClausulas[24].' - '.$descripcionClausula[24].'</u></strong>: '.$partesDescripcionClausula[29][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[25].' - '.$descripcionClausula[25].'</u></strong>: '.$partesDescripcionClausula[30][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[26].' - '.$descripcionClausula[26].'</u></strong>: '.$partesDescripcionClausula[31][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[27].' - '.$descripcionClausula[27].'</u></strong>: '.$partesDescripcionClausula[32][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[28].' - '.$descripcionClausula[28].'</u></strong>: '.$partesDescripcionClausula[33][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[29].' - '.$descripcionClausula[29].'</u></strong>: '.$partesDescripcionClausula[34][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[30].' - '.$descripcionClausula[30].'</u></strong>: '.$partesDescripcionClausula[35][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[31].' - '.$descripcionClausula[31].'</u></strong>: '.$partesDescripcionClausula[36][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[32].' - '.$descripcionClausula[32].'</u></strong>: '.$partesDescripcionClausula[37][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[33].' - '.$descripcionClausula[33].'</u></strong>: '.$partesDescripcionClausula[38][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[34].' - '.$descripcionClausula[34].'</u></strong>: '.$partesDescripcionClausula[39][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[35].' - '.$descripcionClausula[35].'</u></strong>: '.$partesDescripcionClausula[40][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[36].' - '.$descripcionClausula[36].'</u></strong>: '.$partesDescripcionClausula[41][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[37].' - '.$descripcionClausula[37].'</u></strong>: '.$partesDescripcionClausula[42][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[38].' - '.$descripcionClausula[38].'</u></strong>: '.$partesDescripcionClausula[43][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[39].' - '.$descripcionClausula[39].'</u></strong>: '.$partesDescripcionClausula[44][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[40].' - '.$descripcionClausula[40].'</u></strong>: '.$partesDescripcionClausula[45][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[41].' - '.$descripcionClausula[41].'</u></strong>: '.$partesDescripcionClausula[46][0].' 
		en '.$domicilio.'.
		<strong><u>CLÁUSULA '.$nombreClausulas[42].' - '.$descripcionClausula[42].'</u></strong>: '.$partesDescripcionClausula[47][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[43].' - '.$descripcionClausula[43].'</u></strong>: '.$partesDescripcionClausula[48][0].'.
		Para constancia del presente acto se firma en Riohacha, Capital del Departamento de La Guajira, a los '.$fechacontratos.'.
		</td>
		</tr>
	
	   	<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="center">
		 
			<table width="100%" border="0">
			  <tr>
				<td width="50%" align="left"><strong>POR LA UNIVERSIDAD</strong></td>
				<td width="50%" align="left"><strong>POR EL CONTRATISTA</strong></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td align="left">
				<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'
				<br/>'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</strong>
				</td>
				<td align="left"><strong>'.$condescon.'</strong></td>
			  </tr>
			 </table>
			
		 </td>
		</tr>
	   </table>
	   ';
  }

   elseif(($Formclasescontratos->FCCO_ID)==1401){/*SI ES UN CONTRATO DE OBRA*/
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
	  //$pdf->SetFont('times', 'B', '11', true);
	  $pdf->SetFont('times', 'K', 11, true);
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">		
		<tr>
		 <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		 <td align="center"><strong>'.$tipo.' No. '.$numerocontrato.' DE OBRA DE '.$anio_contrato.'</strong></td>
	   </tr>
	   <tr>
		 <td align="center">&nbsp;</td>
	   </tr>
	   <tr>
		 <td>
		 
		 <table width="100%" border="1">
		  <tr>
			<td align="left" width="20%">CONTRATANTE:</td>
			<td align="left" width="80%"><strong>UNIVERSIDAD DE LA GUAJIRA.</strong></td>
		 </tr>
		  <tr>
			<td align="left" width="20%">CONTRATISTA:</td>
			<td align="justify" width="80%"><strong>'.$contratista.'</strong></td>
		  </tr>
		  <tr>
			<td align="left" width="20%">VALOR:</td>
			<td align="justify" width="80%"><strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') M/CTE.</strong></td>
		  </tr>
		  <tr>
			<td align="left" width="20%">OBJETO:</td>
			<td align="justify" width="80%"><strong>'.$objeto.'.</strong></td>
		  </tr>
		  <tr>
			<td align="left" width="20%">DURACIÓN:</td>
			<td align="justify" width="80%"><strong>'.$dura.'</strong></td>
		  </tr>
		</table>
		 
		 </td>
	  </tr>
	  
	  <tr>
		 <td align="center">&nbsp;</td>
	  </tr>
	  
	    <tr>
		<td align="justify">'.$ContratanteContratos.' '.$ContratistaContratos.'
		<strong>'.$descripcionClausula[0].'</strong> '.$partesDescripcionClausula[0][0].'. 
		<strong>'.$descripcionClausula[1].'</strong> '.$partesDescripcionClausula[1][0].'. 
		<strong>'.$descripcionClausula[2].'</strong> '.$partesDescripcionClausula[2][0].'. 
		<strong>'.$descripcionClausula[3].'</strong> '.$partesDescripcionClausula[3][0].'. 
		<strong>'.$descripcionClausula[4].'</strong> '.$partesDescripcionClausula[4][0].'. 
		<strong>'.$descripcionClausula[5].'</strong> '.$partesDescripcionClausula[5][0].'. 
		<strong>'.$descripcionClausula[6].'</strong> '.$partesDescripcionClausula[6][0].'. 
		<strong>'.$descripcionClausula[7].'</strong> '.$partesDescripcionClausula[7][0].'. 
		<strong>'.$descripcionClausula[8].'</strong> '.$partesDescripcionClausula[8][0].'. 
		<strong>'.$descripcionClausula[9].'</strong> '.$partesDescripcionClausula[9][0].' 
		
		<strong>'.$descripcionClausula[10].'</strong> '.$partesDescripcionClausula[10][0].' 
		'.$Modeloordenes->rel_necesidad->NECE_NOMBRE.'.
		
		
		<strong>'.$descripcionClausula[11].'</strong> '.$partesDescripcionClausula[11][0].':
		<strong>'.$contratista.'</strong>
		
		 '; 
		     foreach($datainvitados as $rows){
			 $invitados = Invitados::model()->findByPk($rows["INVI_ID"]);
			 $invitado[] = $invitados->INVI_NOMBRE;
			 }
				 if ($numeroinvitados==1) { 
					$html .='
					<strong>, '.$invitado[0].'.</strong> 
					        ';
				 } elseif($numeroinvitados==2) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].'.</strong>
					        ';
				 } elseif($numeroinvitados==3) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].', '.$invitado[2].'.</strong>
					        ';
				 } elseif($numeroinvitados==4) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].', '.$invitado[2].', '.$invitado[3].'.</strong>
					        ';
				 } elseif($numeroinvitados==5) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].', '.$invitado[2].', '.$invitado[3].', '.$invitado[4].'.</strong>
					        ';
				 } elseif($numeroinvitados==6) { 
					 $html .='
					 <strong>, '.$invitado[0].', '.$invitado[1].', '.$invitado[2].', '.$invitado[3].', '.$invitado[4].', '.$invitado[5].'.</strong>
					        ';
				 }    
	$html .=' '.$partesDescripcionClausula[12][0].' <strong>'.$objeto.'.</strong> './*$partesDescripcionClausula[13][0]*/$N=''.'
		
		
		
		<strong> '.$descripcionClausula[12].'</strong> '.$partesDescripcionClausula[14][0].' <strong>'.$contratista.'</strong>.
		<strong> '.$descripcionClausula[13].'</strong> '.$partesDescripcionClausula[15][0].'
		
		<strong><u>CLÁUSULA '.$nombreClausulas[15].' - '.$descripcionClausula[15].'</u></strong>: '.$partesDescripcionClausula[16][0].'
		<strong>'.$objeto.'.</strong>, '.$partesDescripcionClausula[17][0].'.
		
		<strong><u>CLÁUSULA '.$nombreClausulas[16].' - '.$descripcionClausula[16].'</u></strong>: '.$partesDescripcionClausula[18][0].'.
		
		<strong><u>CLÁUSULA '.$nombreClausulas[17].' - '.$descripcionClausula[17].'</u></strong>: 
		'.$partesDescripcionClausula[19][0].' '.$valorContratoLetras.' 
		($'.number_format($valorContrato).') M/CTE. '.$partesDescripcionClausula[20][0].':<strong> 
		'.$Modeloordenes->rel_formadepago->FOPA_DESCRIPCION.'.</strong> '.$partesDescripcionClausula[21][0].'.
		
		<strong><u>CLÁUSULA '.$nombreClausulas[18].' - '.$descripcionClausula[18].'</u></strong>: '.$partesDescripcionClausula[22][0].''.$presupu.'
		
		 '; 
		     foreach($datacdp as $rows){
			 $Cdp = Presupuestos::model()->findByPk($rows["PRES_ID"]);
			 $descdp[] = $Cdp->PRES_NOMBRE;
			 }
				 if ($numerocdp==1) { 
					$html .='	
					 <strong> '.$descdp[0].'.</strong> 
					        ';
				 } elseif($numerocdp==2) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'.</strong>
					        ';
				 } elseif($numerocdp==3) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'.</strong>
					        ';
				 } elseif($numerocdp==4) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'.</strong>
					        ';
				 } elseif($numerocdp==5) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'.</strong>
					        ';
				 } elseif($numerocdp==6) { 
					 $html .='	
					 <strong> '.$descdp[0].'; '.$descdp[1].'; '.$descdp[2].'; '.$descdp[3].'; '.$descdp[4].'; '.$descdp[5].'.</strong>
					        ';
				 }    
	$html .='
		
		<strong><u>CLÁUSULA '.$nombreClausulas[19].' - '.$descripcionClausula[19].'</u></strong>: 
		'.$partesDescripcionClausula[23][0].' <strong>'.$dura.'</strong> '.$partesDescripcionClausula[24][0].'.
		
		<strong><u>CLÁUSULA '.$nombreClausulas[20].' - '.$descripcionClausula[20].'</u></strong>: '.$partesDescripcionClausula[25][0].'. 
		
		<strong><u>CLÁUSULA '.$nombreClausulas[21].' - '.$descripcionClausula[21].'</u></strong>: '.$partesDescripcionClausula[26][0].'
		'; 
		     foreach($datagarantias as $rows){
			 $Garantias = Garantias::model()->findByPk($rows["GARA_ID"]);
			 $desgarantia[] = $Garantias->GARA_DESCRIPCION;
			 //echo $Garantias->GARA_DESCRIPCION;
			 }
				 if ($numerogarantias==1) { 
					$html .='	
					 <strong>A '.$Garantias->GARA_DESCRIPCION.'</strong>
					        ';
				 } elseif($numerogarantias==2) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					        ';
				 } elseif($numerogarantias==3) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
					        ';
				 } elseif($numerogarantias==4) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					        ';
				 } elseif($numerogarantias==5) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					        ';
				 } elseif($numerogarantias==6) { 
					 $html .='	
					 <strong>A '.$desgarantia[0].'</strong>
					 <strong>B '.$desgarantia[1].'</strong>
					 <strong>C '.$desgarantia[2].'</strong>
   					 <strong>D '.$desgarantia[3].'</strong>
					 <strong>E '.$desgarantia[4].'</strong>
					 <strong>F '.$desgarantia[5].'</strong>
					        ';
				 }    
	$html .='
		


		<strong><u>CLÁUSULA '.$nombreClausulas[22].' - '.$descripcionClausula[22].'</u></strong>: '.$partesDescripcionClausula[27][0].' <strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>'.$partesDescripcionClausula[28][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[23].' - '.$descripcionClausula[23].'</u></strong>: '.$partesDescripcionClausula[29][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[24].' - '.$descripcionClausula[24].'</u></strong>: '.$partesDescripcionClausula[30][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[25].' - '.$descripcionClausula[25].'</u></strong>: '.$partesDescripcionClausula[31][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[26].' - '.$descripcionClausula[26].'</u></strong>: '.$partesDescripcionClausula[32][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[27].' - '.$descripcionClausula[27].'</u></strong>: '.$partesDescripcionClausula[33][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[28].' - '.$descripcionClausula[28].'</u></strong>: '.$partesDescripcionClausula[34][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[29].' - '.$descripcionClausula[29].'</u></strong>: '.$partesDescripcionClausula[35][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[30].' - '.$descripcionClausula[30].'</u></strong>: '.$partesDescripcionClausula[36][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[31].' - '.$descripcionClausula[31].'</u></strong>: '.$partesDescripcionClausula[37][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[32].' - '.$descripcionClausula[32].'</u></strong>: '.$partesDescripcionClausula[38][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[33].' - '.$descripcionClausula[33].'</u></strong>: '.$partesDescripcionClausula[39][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[34].' - '.$descripcionClausula[34].'</u></strong>: '.$partesDescripcionClausula[40][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[35].' - '.$descripcionClausula[35].'</u></strong>: '.$partesDescripcionClausula[41][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[36].' - '.$descripcionClausula[36].'</u></strong>: '.$partesDescripcionClausula[42][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[37].' - '.$descripcionClausula[37].'</u></strong>: '.$partesDescripcionClausula[43][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[38].' - '.$descripcionClausula[38].'</u></strong>: '.$partesDescripcionClausula[44][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[39].' - '.$descripcionClausula[39].'</u></strong>: '.$partesDescripcionClausula[45][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[40].' - '.$descripcionClausula[40].'</u></strong>: '.$partesDescripcionClausula[46][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[41].' - '.$descripcionClausula[41].'</u></strong>: '.$partesDescripcionClausula[47][0].'
		en '.$domicilio.'.
		<strong><u>CLÁUSULA '.$nombreClausulas[42].' - '.$descripcionClausula[42].'</u></strong>: '.$partesDescripcionClausula[48][0].'.
		<strong><u>CLÁUSULA '.$nombreClausulas[43].' - '.$descripcionClausula[43].'</u></strong>: '.$partesDescripcionClausula[49][0].'.
		Para constancia del presente acto se firma en Riohacha, Capital del Departamento de La Guajira, a los '.$fechacontratos.'.
		</td>
		</tr>
	
	   	<tr>
		 <td align="center">&nbsp;</td>
		</tr>
		
		<tr>
		 <td align="center">
		 
			<table width="100%" border="0">
			  <tr>
				<td width="50%" align="left"><strong>POR LA UNIVERSIDAD</strong></td>
				<td width="50%" align="left"><strong>POR EL CONTRATISTA</strong></td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			  </tr>
			  <tr>
				<td align="left">
				<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'
				<br/>'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</strong>
				</td>
				<td align="left"><strong>'.$condescon.'</strong></td>
			  </tr>
			 </table>
			
		 </td>
		</tr>
	   </table>
	   ';
  }
   
   
   $pdf->SetFont('times', 'K', 10);
   $pdf->writeHTML($html, true, 0, true, 0);
  }
 $pdf->Output("$NombreDocumento.pdf", 'D');  
    
  Yii::app()->end();
?>