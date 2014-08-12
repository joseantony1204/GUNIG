<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'pt', 'A4', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  $phpNumToLetterPath = Yii::getPathOfAlias('ext');
  include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
  $NumberToLetters = new EnLetras();
  
  
  $autor='ING. JOSE ANTONIO GONZALEZ LIÑAN - UNIVERSIDAD DE LA GUAJIRA';  
 // $Numero = $Contratos->numOrden;     
  $titulo="REPORTE DE CONTRATOS OPS";
  $palabrasClaves='CONTRATO, OPS, TALENTO HUMANO';
  $Sujeto='CONTRATO OPS';
  $NombreDocumento=$titulo;
  
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $pdf->SetHeaderData(PDF_HEADER_LOGO, 160, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);
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
 
  $id = "";  $sede = "";  $dependencia = ""; $opcion = "";
  
  if(($_REQUEST["id"]) or ($_REQUEST["sede"]) or ($_REQUEST["dependencia"])) {
   $id = $_REQUEST["id"];
   $sede = $_REQUEST["sede"];
   $dependencia = $_REQUEST["dependencia"];
   $data = $Opscontratos->downloadContratos($id,$sede,$dependencia);
  }else{   
		if($_REQUEST["opcion"]=='true'){
		 $data = $Registros;
		}
       }
 
  $Salariosminimos = new Salariosminimos;
  
  foreach($data as $rows){
  $Opscontratos = Opscontratos::model()->findByPk($rows["OPCO_ID"]);
  //$Contratos->generarContratos();
  
  /* OBTENIENDO EL VALOR DEL CONTRATO */
  $valorContrato =round(($Opscontratos->OPCO_VALOR_MENSUAL*$Opscontratos->OPCO_MESES)+
  (($Opscontratos->OPCO_VALOR_MENSUAL/30)*($Opscontratos->OPCO_DIAS)));  
  $valorContratoLetras = strtoupper($NumberToLetters->ValorEnLetras($valorContrato,"PESOS"));
  $valorContratoCon4xMil = (($valorContrato)+($valorContrato*4/1000));
  
  /* CONFIGURANDO FORMA DE PAGO */
  $valorMensual = $Opscontratos->OPCO_VALOR_MENSUAL;
  $mesesContrato = $Opscontratos->OPCO_MESES;
  $mesesContratoLetras = $NumberToLetters->ValorEnLetras($mesesContrato,'');
  $diasContrato = $Opscontratos->OPCO_DIAS;
  
  if(($mesesContrato>0) & $diasContrato>0){
   $cuotas = strtoupper($mesesContratoLetras)." cuotas por ".strtoupper($NumberToLetters->ValorEnLetras($valorMensual,'PESOS'))."
   ($".number_format($valorMensual).") M/CTE ";
  
   $mesesPlazo = strtoupper($NumberToLetters->ValorEnLetras($mesesContrato,''))." (".$mesesContrato.") mes(es)";
  
   $valorDiario =  $valorMensual/30;
   $valorAdicional = round(($valorDiario*$diasContrato));
   $cuotaAdicional = " y UNA cuota final de ".strtoupper($NumberToLetters->ValorEnLetras($valorAdicional,'PESOS'))."   
   ($".number_format($valorAdicional).") M/CTE ";
   
   $diaPlazo = " y ".strtoupper($NumberToLetters->ValorEnLetras($diasContrato,''))." (".$diasContrato.") dia(s)";
  	
  }else{
	     if(($mesesContrato>0) & $diasContrato==0){
		   $cuotas = strtoupper($mesesContratoLetras)." cuotas por ".strtoupper($NumberToLetters->ValorEnLetras($valorMensual,'PESOS'))."
		   ($".number_format($valorMensual).") M/CTE ";
		  
		   $mesesPlazo = strtoupper($NumberToLetters->ValorEnLetras($mesesContrato,''))." (".$mesesContrato.") mes(es)";
		  
		   $valorDiario =  "";
		   $valorAdicional = "";
		   $cuotaAdicional = "";
		   
		   $diaPlazo = "";
			
		  }else{
				 if(($mesesContrato==0) & $diasContrato>0){
				   $cuotas ="";
				   $mesesPlazo ="";
				  
				   $valorDiario =  $valorMensual/30;
				   $valorAdicional = round(($valorDiario*$diasContrato));
				   $cuotaAdicional = " UNA cuota de ".strtoupper($NumberToLetters->ValorEnLetras($valorAdicional,'PESOS'))." 
				   ($".number_format($valorAdicional).") M/CTE ";
				   
				   $diaPlazo = " ".strtoupper($NumberToLetters->ValorEnLetras($diasContrato,''))." (".$diasContrato.") dia(s)";
					
				  }			   
		       
			   }
	   
	   
	   }
	
  $numero = $Opscontratos->rel_contrato->CONT_NUMORDEN;	
  $dia_contrato = date("d",strtotime($Opscontratos->rel_contrato->CONT_FECHAPROCESO));
  $mes_contrato=NombreMes(date("m",strtotime($Opscontratos->rel_contrato->CONT_FECHAPROCESO)));
  $anio_contrato=$Opscontratos->rel_contrato->CONT_ANIO;  
  $fecha = ''; //$dia_contrato." de ".$mes_contrato." de ".$anio_contrato;
  
  $expe = strtolower($Opscontratos->rel_contrato->Persona->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD);
  $exp = ucfirst($expe);
  $tipoDoc = strtolower($Opscontratos->rel_contrato->Persona->rel_tipos_identificacion->TIID_NOMBRE);
  $tipoDocumento = ucwords(ucfirst($tipoDoc));
  
  $dire = strtolower($Opscontratos->rel_contrato->Persona->PERS_DIRECCION);
  $dir = ucwords ($dire);	     
  
  $Contratos = Contratos::model()->findByPk($Opscontratos->CONT_ID);
		
  $criteria = new CDbCriteria;
  $criteria->condition = 'CONT_ID = '.$Contratos->CONT_ID;		
  $Formcontratosformatos = Formcontratosformatos::model()->find($criteria);		
  $Formclasescontratos = Formclasescontratos::model()->findByPk($Formcontratosformatos->FCCO_ID);
  
  /*A PARTIR DE AQUI SE COMIENZA A VINCULAR EL CONTRATO EN EL FORMATO CORRESPONDIENTE*/  
  if(($Formclasescontratos->FCCO_ID)==8){/*SI ES UNA ORDEN DE PRESTACION DE SERVICIOS PROFESIONALES SIN POLIZA */
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
	  $pdf->SetFont('times', 'k', '10', true);
	  $pdf->startPageGroup();
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   <tr>
		<td align="center"><strong>ORDEN  DE PRESTACION DE SERVICIOS No. '.$numero.'  DE  '.$anio_contrato.' </strong></td>
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
		 $Opscontratos->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' '.
		 $Opscontratos->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong>    </td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.number_format($Opscontratos->rel_contrato->Persona->PERS_IDENTIFICACION).' de '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$Opscontratos->rel_contrato->Persona->PERS_TELEFONO.'</td>
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
		 '.$partesDescripcionClausula[0][0].'
		 <strong>'.strtoupper($Opscontratos->rel_objeto->rel_objetos->OBJE_NOMBRE).'</strong>
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$Opscontratos->rel_dependencia->DEPE_NOMBRE.'.</strong>
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[1].' - '.$descripcionClausula[1].':</strong> 
		 '.$partesDescripcionClausula[2][0].'
		 <strong>'.$valorContratoLetras.' M/CTE ($'.number_format($valorContrato).').</strong>
		 '.$partesDescripcionClausula[3][0].'
		 <strong>'.$cuotas.' '.$cuotaAdicional.'.</strong>
		 '.$partesDescripcionClausula[4][0].'
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[2].' - '.$descripcionClausula[2].':</strong> 
		 '.$partesDescripcionClausula[5][0].'
		 <strong>'.$mesesPlazo.' '.$diaPlazo.',</strong>
		 '.$partesDescripcionClausula[6][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[3].' - '.$descripcionClausula[3].':</strong> 
         '.$partesDescripcionClausula[7][0].'
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[4].' - '.$descripcionClausula[4].':</strong> 
         '.$partesDescripcionClausula[8][0].'
		 <strong>'.$Opscontratos->rel_presupuesto->Presupuesto->PRES_NOMBRE.'</strong>
		 '.$partesDescripcionClausula[9][0].'
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[5].' - '.$descripcionClausula[5].':</strong> 
         '.$partesDescripcionClausula[10][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[6].' - '.$descripcionClausula[6].':</strong> 
         '.$partesDescripcionClausula[11][0].'
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[7].' - '.$descripcionClausula[7].':</strong> 
          '.$partesDescripcionClausula[12][0].'
		  <strong>'.$Opscontratos->rel_dependencia->rel_jefes_dependencias->JEDE_DESCRIPCION.'</strong>
		  '.$partesDescripcionClausula[13][0].'
		  '.$partesDescripcionClausula[14][0].'
		  </td>
		 </tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[8].' - '.$descripcionClausula[8].':</strong> 
          '.$partesDescripcionClausula[15][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[9].' - '.$descripcionClausula[9].':</strong> 
          '.$partesDescripcionClausula[16][0].'
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[10].' - '.$descripcionClausula[10].':</strong> 
          '.$partesDescripcionClausula[17][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[11].' - '.$descripcionClausula[11].':</strong> 
          '.$partesDescripcionClausula[18][0].'
		  </td>
		 </tr>
		 	 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>
		 
		 <tr>
		  <td align="left">
		  <strong>'.$Opscontratos->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  '.$Opscontratos->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'
		  </strong>					
		  </td>
		 </tr>
		 <tr>
		  <td align="left">
		  '.$Opscontratos->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
		 </tr>
		 <tr>
		  <td align="left">&nbsp;</td>
		 </tr>
		 <tr>
		  <td align="left">
		  ACEPTO: 
		  <strong>
		  '.$Opscontratos->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
		  '.$Opscontratos->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'
		  </strong>
		  </td>
		 </tr>
		 <tr>
		  <td align="left">
		  Contratista
		  </td>
		 </tr>
		 <tr>
		  <td align="left">&nbsp;</td>
		 </tr>
		 
		 <tr>
		  <td align="left">
			<table width="100%" border="0" align="center">
			 <tr>
			  <td width="15%" align="center">&nbsp;</td>
			  <td width="53%" align="left">UNIGUAJIRA</td>
			  <td width="32%" align="center">&nbsp;</td>
			 </tr>
			 <tr>
			  <td align="center">&nbsp;</td>
			  <td align="left">SECCIÓN: 
			  <u>Sección '.$Opscontratos->rel_presupuesto->Presupuesto->PRES_SECCION.'  
			  Código '.$Opscontratos->rel_presupuesto->Presupuesto->PRES_CODIGO.'
			  </u>
			  </td>
			  <td align="center">&nbsp;</td>
			 </tr>
			 <tr>
			  <td align="center"><p>&nbsp;</p></td>
			  <td align="left">VALOR:  <u> '.number_format($valorContratoCon4xMil).' </u></td>
			  <td align="center">&nbsp;</td>
			 </tr>
			 <tr>
			  <td align="center"><p>&nbsp;</p></td>
			  <td align="left">FECHA: ________________________</td>
			  <td align="center">&nbsp;</td>
			 </tr>
			 <tr>
			  <td align="center">&nbsp;</td>
			  <td align="left">REGISTRO: ____________________</td>
			  <td align="center">&nbsp;</td>
			 </tr>
			</table>					
		   </td>
		  </tr>		
			
	   </table>
	   ';
  
  }elseif(($Formclasescontratos->FCCO_ID)==7){ /*SI ES UNA ORDEN DE PRESTACION DE SERVICIOS PROFESIONALES CON POLIZA */
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
	  $pdf->SetFont('times', 'k', '10', true);
	  $pdf->startPageGroup();
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
       $html ='
	   <table width="100%" border="0" align="center">
	   <tr>
		<td align="center"><strong>ORDEN  DE PRESTACION DE SERVICIOS No. '.$numero.'  DE  '.$anio_contrato.' </strong></td>
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
		 $Opscontratos->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' '.
		 $Opscontratos->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong>    </td>
		</tr>
		<tr>
		 <td align="left">'.$tipoDocumento.': '.number_format($Opscontratos->rel_contrato->Persona->PERS_IDENTIFICACION).' de '.$exp.'</td>
		</tr>
		<tr>
		 <td align="left">Dirección: '.$dir.'</td>
		</tr>
		<tr>
		 <td align="left">Teléfono: '.$Opscontratos->rel_contrato->Persona->PERS_TELEFONO.'</td>
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
		 '.$partesDescripcionClausula[0][0].'
		 <strong>'.strtoupper($Opscontratos->rel_objeto->rel_objetos->OBJE_NOMBRE).'</strong>
		 '.$partesDescripcionClausula[1][0].'
		 <strong>'.$Opscontratos->rel_dependencia->DEPE_NOMBRE.'.</strong>
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[1].' - '.$descripcionClausula[1].':</strong> 
		 '.$partesDescripcionClausula[2][0].'
		 <strong>'.$valorContratoLetras.' M/CTE ($'.number_format($valorContrato).').</strong>
		 '.$partesDescripcionClausula[3][0].'
		 <strong>'.$cuotas.' '.$cuotaAdicional.'.</strong>
		 '.$partesDescripcionClausula[4][0].'
		</td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[2].' - '.$descripcionClausula[2].':</strong> 
		 '.$partesDescripcionClausula[5][0].'
		 <strong>'.$mesesPlazo.' '.$diaPlazo.',</strong>
		 '.$partesDescripcionClausula[6][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[3].' - '.$descripcionClausula[3].':</strong> 
         '.$partesDescripcionClausula[7][0].'
		 </td>
		</tr>
	
	    <tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[4].' - '.$descripcionClausula[4].':</strong> 
         '.$partesDescripcionClausula[8][0].'
		 <strong>'.$Opscontratos->rel_presupuesto->Presupuesto->PRES_NOMBRE.'</strong>
		 '.$partesDescripcionClausula[9][0].'
		</td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[5].' - '.$descripcionClausula[5].':</strong> 
         '.$partesDescripcionClausula[10][0].'
		 </td>
		</tr>
		  
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		<tr>
		 <td align="justify"><strong>'.$nombreClausulas[6].' - '.$descripcionClausula[6].':</strong> 
         '.$partesDescripcionClausula[11][0].'
		 </td>
		</tr>
		
		<tr>
		 <td align="center">&nbsp;</td>
		</tr>		  		  
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[7].' - '.$descripcionClausula[7].':</strong> 
          '.$partesDescripcionClausula[12][0].'
		  </td>
		 </tr>
		 		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[8].' - '.$descripcionClausula[8].':</strong> 
          '.$partesDescripcionClausula[13][0].'
		   <strong>'.$Opscontratos->rel_dependencia->rel_jefes_dependencias->JEDE_DESCRIPCION.'</strong>
		  '.$partesDescripcionClausula[14][0].'
		  '.$partesDescripcionClausula[15][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>

		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[9].' - '.$descripcionClausula[9].':</strong> 
          '.$partesDescripcionClausula[16][0].'
		 </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[10].' - '.$descripcionClausula[10].':</strong> 
          '.$partesDescripcionClausula[17][0].'
		  </td>
		 </tr>
		  
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[11].' - '.$descripcionClausula[11].':</strong> 
          '.$partesDescripcionClausula[18][0].'
		  </td>
		 </tr>
		 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>	
		  
		 <tr>
		  <td align="justify"><strong>'.$nombreClausulas[12].' - '.$descripcionClausula[12].':</strong> 
          '.$partesDescripcionClausula[19][0].'
		  </td>
		 </tr>
		 	 
		 <tr>
		  <td align="center">&nbsp;</td>
		 </tr>
		 
		 <tr>
		  <td align="left">
		  <strong>'.$Opscontratos->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
		  '.$Opscontratos->rel_contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'
		  </strong>					
		  </td>
		 </tr>
		 <tr>
		  <td align="left">
		  '.$Opscontratos->rel_contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
		 </tr>
		 <tr>
		  <td align="left">&nbsp;</td>
		 </tr>
		 <tr>
		  <td align="left">
		  ACEPTO: 
		  <strong>
		  '.$Opscontratos->rel_contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
		  '.$Opscontratos->rel_contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'
		  </strong>
		  </td>
		 </tr>
		 <tr>
		  <td align="left">
		  Contratista
		  </td>
		 </tr>
		 <tr>
		  <td align="left">&nbsp;</td>
		 </tr>
		 
		 <tr>
		  <td align="left">
			<table width="100%" border="0" align="center">
			 <tr>
			  <td width="15%" align="center">&nbsp;</td>
			  <td width="53%" align="left">UNIGUAJIRA</td>
			  <td width="32%" align="center">&nbsp;</td>
			 </tr>
			 <tr>
			  <td align="center">&nbsp;</td>
			  <td align="left">SECCIÓN: 
			  <u>Sección '.$Opscontratos->rel_presupuesto->Presupuesto->PRES_SECCION.'  
			  Código '.$Opscontratos->rel_presupuesto->Presupuesto->PRES_CODIGO.'
			  </u>
			  </td>
			  <td align="center">&nbsp;</td>
			 </tr>
			 <tr>
			  <td align="center"><p>&nbsp;</p></td>
			  <td align="left">VALOR:  <u> '.number_format($valorContratoCon4xMil).' </u></td>
			  <td align="center">&nbsp;</td>
			 </tr>
			 <tr>
			  <td align="center"><p>&nbsp;</p></td>
			  <td align="left">FECHA: ________________________</td>
			  <td align="center">&nbsp;</td>
			 </tr>
			 <tr>
			  <td align="center">&nbsp;</td>
			  <td align="left">REGISTRO: ____________________</td>
			  <td align="center">&nbsp;</td>
			 </tr>
			</table>					
		   </td>
		  </tr>		
			
	   </table>
	   ';  
  }
   $pdf->writeHTML($html, true, 0, true, 0);
  }  
 $pdf->Output("$NombreDocumento.pdf", 'D');      
  Yii::app()->end();
  
?>