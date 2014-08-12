<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'pt', 'A4', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  $phpNumToLetterPath = Yii::getPathOfAlias('ext');
  include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
  $NumberToLetters = new EnLetras();
  
  
  $autor='ING. JESUS GABRIEL AREVALO AGUILAR - UNIVERSIDAD DE LA GUAJIRA';  
  $Numero = $Contratos->numOrden;     
  $titulo="REPORTE DE ORDENES";
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
  }else{
	 if(($mesesContrato>0) & $diasContrato>0 & $aniosContrato==0){
	 $mesesPlazo = strtoupper($NumberToLetters->ValorEnLetras($mesesContrato,''))." (".$mesesContrato.") MES(ES)";
	 $diaPlazo = " y ".strtoupper($NumberToLetters->ValorEnLetras($diasContrato,''))." (".$diasContrato.") DIA(S)";	   
	 $anioPlazo = "";
	  }else{
		 if(($mesesContrato>0) & $diasContrato==0 & $aniosContrato==0){
	     $mesesPlazo = strtoupper($NumberToLetters->ValorEnLetras($mesesContrato,''))." (".$mesesContrato.") MES(S)";
		 $diaPlazo ="";
		 $anioPlazo = "";
		    }else{
			 if(($mesesContrato==0) & $diasContrato>0 & $aniosContrato==0){
			 $diaPlazo = strtoupper($NumberToLetters->ValorEnLetras($diasContrato,''))." (".$diasContrato.") DIA(S)";	
			 $mesesPlazo ="";
			 $anioPlazo = "";
				 }			    			   
			   }
	   		}
	   }

	   
	
  /* OBTENIENDO EL NUMERO DE CONTRATO */	
  $numero = $Modeloordenes->rel_contrato->CONT_NUM_ORDEN;	
  
   /* OBTENIENDO EL TIPO Y LA CLASE DEL CONTRATO */	
  $tipo = $Modeloordenes->rel_contrato->tICO->TICO_NOMBRE;
  $clase = $Modeloordenes->rel_contrato->cLCO->CLCO_NOMBRE;		
  
  /* CONFIGURANDO LA FECHA Y CONTRATISTA */
  $dia_contrato = date("d",strtotime($Modeloordenes->rel_contrato->CONT_FECHA_PROCESO));
  $mes_contrato=NombreMes(date("m",strtotime($Modeloordenes->rel_contrato->CONT_FECHA_PROCESO)));
  $anio_contrato=$Modeloordenes->rel_contrato->CONT_ANIO;  
  $fecha = $dia_contrato." de ".$mes_contrato." de ".$anio_contrato;
 
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
    
  
  
  /*A PARTIR DE AQUI SE COMIENZA A VINCULAR EL CONTRATO EN EL FORMATO CORRESPONDIENTE*/  
  if(($Formclasescontratos->FCCO_ID)==2){/*SI ES UNA ORDEN DE SUMINISTRO SIN POLIZA */
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
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' DE '.$clase.' '.$numero.'  DE  '.$anio_contrato.' </strong></td>
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
		 <td align="left"><strong>'.
		 $Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.' '.
		 $Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' '.
		 $Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong>    </td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.'</td>
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
		 <td align="justify"><strong>'.$nombreClausulas[0].' - '.$descripcionClausula[0].':</strong> 
		 '.$partesDescripcionClausula[0][0].'<strong> '.$Modeloordenes->MOOR_OBJETO.'.</strong> 
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
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt;
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
		 <td align="justify"><strong>'.$nombreClausulas[1].' - '.$descripcionClausula[1].':</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') '.$partesDescripcionClausula[2][0].'</strong>
		 <strong> '.$Modeloordenes->rel_formadepago->FOPA_DESCRIPCION.'.</strong> 
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[2].' - '.$descripcionClausula[2].':</strong> 
		 '.$partesDescripcionClausula[3][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[3].' - '.$descripcionClausula[3].':</strong> 
         '.$partesDescripcionClausula[4][0].'
		  <strong>'.$anioPlazo.' '.$mesesPlazo.' '.$diaPlazo.', '.$partesDescripcionClausula[5][0].'.</strong>
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[4].' - '.$descripcionClausula[4].':</strong> 
         '.$partesDescripcionClausula[6][0].' 
		  <strong> '.$Modeloordenes->rel_presupuesto->Presupuestoordenes->PRES_NOMBRE.'.</strong> 
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[5].' - '.$descripcionClausula[5].':</strong> 
         '.$partesDescripcionClausula[7][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[6].' - '.$descripcionClausula[6].':</strong> 
         '.$partesDescripcionClausula[8][0].'
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[7].' - '.$descripcionClausula[7].':</strong> 
          '.$partesDescripcionClausula[9][0].'
		  <strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
		  '.$partesDescripcionClausula[10][0].'
		  </td>
		 </tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[8].' - '.$descripcionClausula[8].':</strong> 
          '.$partesDescripcionClausula[11][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[9].' - '.$descripcionClausula[9].':</strong> 
          '.$partesDescripcionClausula[12][0].'
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[10].' - '.$descripcionClausula[10].':</strong> 
          '.$partesDescripcionClausula[13][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[11].' - '.$descripcionClausula[11].':</strong> 
          '.$partesDescripcionClausula[14][0].'
		  </td>
		 </tr>
		 	 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	  
		  
		  
		 <tr>
		  <td>
					  <table width="100%" border="0">
					  <tr>
						<td width="50%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="50%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="50%" align="left">&nbsp;</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="50%" align="left">&nbsp;</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="50%" align="right">ACEPTO: </td>
						<td width="50%" align="left">
						<strong>
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas_naturales->PENA_NOMBRES.' 
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas_naturales->PENA_APELLIDOS.'
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.' 
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left"> Contratista</td>
					  </tr>
					 </table>	 
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  } 
  
  elseif(($Formclasescontratos->FCCO_ID)==1){/*SI ES UNA ORDEN DE SUMINISTRO CON POLIZA */
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
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' DE '.$clase.' '.$numero.'  DE  '.$anio_contrato.' </strong></td>
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
		 <td align="left"><strong>'.
		 $Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.' '.
		 $Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' '.
		 $Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong>    </td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.'</td>
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
		 <td align="justify"><strong>'.$nombreClausulas[0].' - '.$descripcionClausula[0].':</strong> 
		 '.$partesDescripcionClausula[0][0].'<strong> '.$Modeloordenes->MOOR_OBJETO.'.</strong> 
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
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt;
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
		 <td align="justify"><strong>'.$nombreClausulas[1].' - '.$descripcionClausula[1].':</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') '.$partesDescripcionClausula[2][0].'</strong>
		 <strong> '.$Modeloordenes->rel_formadepago->FOPA_DESCRIPCION.'.</strong>  
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[2].' - '.$descripcionClausula[2].':</strong> 
		 '.$partesDescripcionClausula[3][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[3].' - '.$descripcionClausula[3].':</strong> 
         '.$partesDescripcionClausula[4][0].'
		  <strong>'.$anioPlazo.' '.$mesesPlazo.' '.$diaPlazo.', '.$partesDescripcionClausula[5][0].'.</strong>
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[4].' - '.$descripcionClausula[4].':</strong> 
         '.$partesDescripcionClausula[6][0].' 
		  <strong> '.$Modeloordenes->rel_presupuesto->Presupuestoordenes->PRES_NOMBRE.'.</strong> 
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[5].' - '.$descripcionClausula[5].':</strong> 
         '.$partesDescripcionClausula[7][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  	  
			    
			<tr>
			 <td align="justify"><strong>'.$nombreClausulas[6].' - '.$descripcionClausula[6].':</strong> 
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
		  <td align="justify"><strong>'.$nombreClausulas[7].' - '.$descripcionClausula[7].':</strong> 
          '.$partesDescripcionClausula[9][0].'
		  </td>
		 </tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[8].' - '.$descripcionClausula[8].':</strong> 
		  '.$partesDescripcionClausula[10][0].'
		  	<strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
          '.$partesDescripcionClausula[11][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[9].' - '.$descripcionClausula[9].':</strong> 
          '.$partesDescripcionClausula[12][0].'
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[10].' - '.$descripcionClausula[10].':</strong> 
          '.$partesDescripcionClausula[13][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[11].' - '.$descripcionClausula[11].':</strong> 
          '.$partesDescripcionClausula[14][0].'
		  </td>
		 </tr>
		 	 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	  
		  
		  <tr>
		  <td align="justify"><strong>'.$nombreClausulas[12].' - '.$descripcionClausula[12].':</strong> 
          '.$partesDescripcionClausula[15][0].'
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
						<td width="50%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="50%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="50%" align="left">&nbsp;</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="50%" align="left">&nbsp;</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="50%" align="right">ACEPTO: </td>
						<td width="50%" align="left">
						<strong>
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas_naturales->PENA_NOMBRES.' 
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas_naturales->PENA_APELLIDOS.'
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.' 
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left"> Contratista</td>
					  </tr>
					 </table>	 
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  }
    elseif(($Formclasescontratos->FCCO_ID)==3){/*SI ES UNA ORDEN DE PRESTACION DE SERVICIOS CON POLIZA */
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
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' DE '.$clase.' '.$numero.'  DE  '.$anio_contrato.' </strong></td>
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
		 <td align="left"><strong>'.
		 $Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.' '.
		 $Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' '.
		 $Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong>    </td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.'</td>
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
		 <td align="justify"><strong>'.$nombreClausulas[0].' - '.$descripcionClausula[0].':</strong> 
		 '.$partesDescripcionClausula[0][0].'<strong> '.$Modeloordenes->MOOR_OBJETO.'.</strong> 
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
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt;
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
		 <td align="justify"><strong>'.$nombreClausulas[1].' - '.$descripcionClausula[1].':</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') '.$partesDescripcionClausula[2][0].'</strong>
	 	 <strong> '.$Modeloordenes->rel_formadepago->FOPA_DESCRIPCION.'.</strong> 
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[2].' - '.$descripcionClausula[2].':</strong> 
		 '.$partesDescripcionClausula[3][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[3].' - '.$descripcionClausula[3].':</strong> 
         '.$partesDescripcionClausula[4][0].'
		  <strong>'.$anioPlazo.' '.$mesesPlazo.' '.$diaPlazo.', '.$partesDescripcionClausula[5][0].'.</strong>
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[4].' - '.$descripcionClausula[4].':</strong> 
         '.$partesDescripcionClausula[6][0].' 
		  <strong> '.$Modeloordenes->rel_presupuesto->Presupuestoordenes->PRES_NOMBRE.'.</strong> 
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[5].' - '.$descripcionClausula[5].':</strong> 
         '.$partesDescripcionClausula[7][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
	<tr>
			 <td align="justify"><strong>'.$nombreClausulas[6].' - '.$descripcionClausula[6].':</strong> 
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
		  <td align="justify"><strong>'.$nombreClausulas[7].' - '.$descripcionClausula[7].':</strong> 
          '.$partesDescripcionClausula[9][0].'
		  </td>
		 </tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[8].' - '.$descripcionClausula[8].':</strong> 
		  '.$partesDescripcionClausula[10][0].'
		  	<strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
          '.$partesDescripcionClausula[11][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[9].' - '.$descripcionClausula[9].':</strong> 
          '.$partesDescripcionClausula[12][0].'
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[10].' - '.$descripcionClausula[10].':</strong> 
          '.$partesDescripcionClausula[13][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[11].' - '.$descripcionClausula[11].':</strong> 
          '.$partesDescripcionClausula[14][0].'
		  </td>
		 </tr>
		 	 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	  
		  
		  <tr>
		  <td align="justify"><strong>'.$nombreClausulas[12].' - '.$descripcionClausula[12].':</strong> 
          '.$partesDescripcionClausula[15][0].'
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
						<td width="50%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="50%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="50%" align="left">&nbsp;</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="50%" align="left">&nbsp;</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="50%" align="right">ACEPTO: </td>
						<td width="50%" align="left">
						<strong>
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas_naturales->PENA_NOMBRES.' 
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas_naturales->PENA_APELLIDOS.'
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.' 
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left"> Contratista</td>
					  </tr>
					 </table>	 
		  </td>
		 </tr>
		 
	   </table>
	   ';
      
  }
  
   elseif(($Formclasescontratos->FCCO_ID)==4){/*SI ES UNA ORDEN DE PRESTACION DE SERVICIOS SIN POLIZA */
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
		 <td align="center"><strong>UNIVERSIDAD DE LA GUAJIRA</strong></td>
	   </tr>
	   <tr>
		 <td align="center"><strong>RECTORIA</strong></td>
	  </tr>
	  
	   <tr>
		 <td align="center"><strong>'.$tipo.' DE '.$clase.' '.$numero.'  DE  '.$anio_contrato.' </strong></td>
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
		 <td align="left"><strong>'.
		 $Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.' '.
		 $Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' '.
		 $Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong>    </td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.$Modeloordenes->rel_contrato->Persona->PERS_IDENTIFICACION.' '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.'</td>
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
		 <td align="justify"><strong>'.$nombreClausulas[0].' - '.$descripcionClausula[0].':</strong> 
		 '.$partesDescripcionClausula[0][0].'<strong> '.$Modeloordenes->MOOR_OBJETO.'.</strong> 
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
					$vt=$valor[$i]*$cantidad[$i];
					$total= $total + $vt;
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
		 <td align="justify"><strong>'.$nombreClausulas[1].' - '.$descripcionClausula[1].':</strong> 
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$valorContratoLetras.' ($'.number_format($valorContrato).') '.$partesDescripcionClausula[2][0].'</strong>
		 <strong> '.$Modeloordenes->rel_formadepago->FOPA_DESCRIPCION.'.</strong> 
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[2].' - '.$descripcionClausula[2].':</strong> 
		 '.$partesDescripcionClausula[3][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[3].' - '.$descripcionClausula[3].':</strong> 
         '.$partesDescripcionClausula[4][0].'
		  <strong>'.$anioPlazo.' '.$mesesPlazo.' '.$diaPlazo.', '.$partesDescripcionClausula[5][0].'.</strong>
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[4].' - '.$descripcionClausula[4].':</strong> 
         '.$partesDescripcionClausula[6][0].' 
		  <strong> '.$Modeloordenes->rel_presupuesto->Presupuestoordenes->PRES_NOMBRE.'.</strong> 
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[5].' - '.$descripcionClausula[5].':</strong> 
         '.$partesDescripcionClausula[7][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[6].' - '.$descripcionClausula[6].':</strong> 
         '.$partesDescripcionClausula[8][0].'
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[7].' - '.$descripcionClausula[7].':</strong> 
          '.$partesDescripcionClausula[9][0].'
		  <strong>'.$Modeloordenes->rel_contrato->Supervisor->Cargo->CARG_NOMBRE.' </strong>
		  '.$partesDescripcionClausula[10][0].'
		  </td>
		 </tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[8].' - '.$descripcionClausula[8].':</strong> 
          '.$partesDescripcionClausula[11][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[9].' - '.$descripcionClausula[9].':</strong> 
          '.$partesDescripcionClausula[12][0].'
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[10].' - '.$descripcionClausula[10].':</strong> 
          '.$partesDescripcionClausula[13][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[11].' - '.$descripcionClausula[11].':</strong> 
          '.$partesDescripcionClausula[14][0].'
		  </td>
		 </tr>
		 	 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	  
		  
		  
		 <tr>
		  <td>
					  <table width="100%" border="0">
					  <tr>
						<td width="50%" align="left">	
						<strong>'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  				'.$Modeloordenes->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong>
						</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="50%" align="left">'.$Modeloordenes->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
						<tr>
						<td width="50%" align="left">&nbsp;</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
					    <tr>
    					<td width="50%" align="left">&nbsp;</td>
						<td width="50%" align="left">&nbsp;</td>
					  </tr>
					  <tr>
						<td width="50%" align="right">ACEPTO: </td>
						<td width="50%" align="left">
						<strong>
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas_naturales->PENA_NOMBRES.' 
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->rel_personas_naturales->PENA_APELLIDOS.'
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_juridicas->PEJU_NOMBRE.' 
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
						'.$Modeloordenes->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'
						</strong>
						</td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td align="left"> Contratista</td>
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