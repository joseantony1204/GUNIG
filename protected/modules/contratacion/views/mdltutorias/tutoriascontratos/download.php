<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'cm', 'A4', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  $phpNumToLetterPath = Yii::getPathOfAlias('ext');
  include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
  $NumberToLetters = new EnLetras();
  
  
  $autor='ING. JOSE ANTONIO GONZALEZ LIÑAN - UNIVERSIDAD DE LA GUAJIRA';  
 // $Numero = $Contratos->numOrden;     
  $titulo="REPORTE DE CONTRATOS DOCENTES TUTORES";
  $palabrasClaves='CONTRATO, TUTORIAS, TALENTO HUMANO';
  $Sujeto='CONTRATO TUTORIAS';
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
  //$pdf->setPrintFooter(false);
	
  // Saltos de página automáticos.
  $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
  // Establecer el ratio para las imagenes que se puedan utilizar
  $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
  $pdf->SetFont('times', 'K', 11);
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
 
  $id = "";  $sede = "";  $sprograma = "";
  
   if(($_REQUEST["id"]) or ($_REQUEST["sede"]) or ($_REQUEST["sbp"])) {
   $id = $_REQUEST["id"];
   $sede = $_REQUEST["sede"];
   $sprograma = $_REQUEST["sbp"];
   $data = $Tutoriascontratos->downloadContratos($id,$sede,$sprograma);
  }else{   
		if($_REQUEST["opcion"]=='true'){
		 $data = $Registros;
		}
       }
  
  
  foreach($data as $rows){
  $Contratos = Tutoriascontratos::model()->findByPk($rows["TUCO_ID"]);
  $Contratos->generarContratos();
  
  $criteria = new CDbCriteria;
  $criteria->condition = 'TUCO_ID = '.$Contratos->TUCO_ID;
  $Tutorias = Tutorias::model()->find($criteria);
  $programa = $Tutorias->Subprograma->rel_programas->TUPR_NOMBRE;
  
  /* CARGANDO EL FORMATO DEL GONTRATO */  

  $formatoContrato = Tutoriasformatoscontratos::model()->findByPk($Contratos->TUFC_ID);
  $criteria = new CDbCriteria;
  $criteria->condition = 'TUFC_ID = '.$formatoContrato->TUFC_ID;
  
  $clausulasFormatoContrato = Tutoriasclausulascontratos::model()->findAll($criteria);
  $numeroClausulas = count($clausulasFormatoContrato);
  
   foreach($clausulasFormatoContrato as $data){
	  $idClausulas[] = $data->TUCC_ID;
	  $criteria = new CDbCriteria;
	  $criteria->condition = 'TUCC_ID = '.$data->TUCC_ID;
	  $partesClausulasContrato = Tutoriaspartescontratos::model()->findAll($criteria);
	  foreach($partesClausulasContrato as $partes){
	   $idPartesClausulas[][] = $partes->TUPC_ID;
	   $descripcionPartesClausulas[][] = $partes->TUPC_DESCRIPCION;
	  }
	  $nombreClausulas[] = $data->TUCC_NOMBRE;
	  $descripcionClausulas[] = $data->TUCC_DESCRIPCION;
	  }
  
  
  /* OBTENIENDO EL VALOR DEL CONTRATO */
  $valorContrato = (($Contratos->TUTORIAS_INTENS)*($Contratos->TUCO_VALORHORA));
  $valorContratoLetras = strtoupper($NumberToLetters->ValorEnLetras($valorContrato,"PESOS"));
  $valorCuotaAdicional = $Contratos->TUCO_CUOTAADICIONAL;
  $valorContratoCon4xMil = (($valorContrato+$valorCuotaAdicional)+(($valorCuotaAdicional+$valorContrato)*4/1000));
  $numero = $Contratos->Contrato->CONT_NUMORDEN;
 
  $dia_contrato = date("d",strtotime($Contratos->Contrato->CONT_FECHAPROCESO));
  $mes_contrato=NombreMes(date("m",strtotime($Contratos->Contrato->CONT_FECHAPROCESO)));
  $anio_contrato=$Contratos->Contrato->CONT_ANIO;  
  $fecha = '';// $dia_contrato." de ".$mes_contrato." de ".$anio_contrato;
   
  $sedemin = strtolower($Contratos->TUTORIAS_LIST_SEDES);
  $sede = ucfirst($sedemin);
  $sedeInf = explode(",",$sede);
  $sedeInfEsc = implode("  ",$sedeInf);
  
  $expe = strtolower($Contratos->Contrato->Persona->rel_personas_naturales->PENA_LUGAREXPIDENTIDAD);
  $exp = ucfirst($expe);
  $tipoDoc = strtolower($Contratos->Contrato->Persona->rel_tipos_identificacion->TIID_NOMBRE);
  $tipoDocumento = ucfirst($tipoDoc);
  
  $tipoIdentificacion = $Contratos->Contrato->Persona->rel_tipos_identificacion->TIID_DESCRIPCION;  
  $identificacion = $Contratos->Contrato->Persona->PERS_IDENTIFICACION;
  
  $dire = strtolower($Contratos->Contrato->Persona->PERS_DIRECCION);
  $dir = ucwords ($dire);
  
      if(($Contratos->TUFC_ID)==1){
	  
	  //***** AÑADIR PAGINA *****//
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
	  $html ='
	  <table width="100%" border="0" align="center">
	   <tr>
		<td>
		
		<table width="100%" border="0" align="center">
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>	  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
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
		 $Contratos->Contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' '.
		 $Contratos->Contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong>    </td>
		  </tr>
		  <tr>
			<td align="left">'.$tipoDocumento.' : '.number_format($Contratos->Contrato->Persona->PERS_IDENTIFICACION).' de '.$exp.'</td>
		  </tr>
		  <tr>
			<td align="left">Direccion: '.$dir.'</td>
		  </tr>
		  <tr>
			<td align="left">Telefono: '.$Contratos->Contrato->Persona->PERS_TELEFONO.'</td>
		  </tr>
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		 
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">'.$formatoContrato->TUFC_DESCRIPCION.'</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[0].' - '.$descripcionClausulas[0].' : </strong> 
			'.$descripcionPartesClausulas[0][0].' <strong>'.$Contratos->TUTORIAS_LISTADO_MODULOS.'</strong>. 
			'.$descripcionPartesClausulas[1][0].' <strong>'.$Contratos->TUTORIAS_LIST_PROG.'</strong> 
			'.$descripcionPartesClausulas[2][0].' <strong>'.$Contratos->TUTORIAS_LIST_SEDES.'</strong>  
			'.$descripcionPartesClausulas[3][0].' (<strong>'.$Contratos->TUTORIAS_INTENS.'</strong>) 
			'.$descripcionPartesClausulas[4][0].' (<strong>$'.number_format($Contratos->TUCO_VALORHORA).'</strong>).
			</td>
		  </tr>
		  
		  <tr>
           <td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[1].' - '.$descripcionClausulas[1].' : </strong>  
			'.$descripcionPartesClausulas[5][0].' <strong>'.$valorContratoLetras.' M/C ($'.number_format($valorContrato).').</strong>  
			'.$descripcionPartesClausulas[6][0].'
			</td>
		  </tr>
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		   <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[2].' - '.$descripcionClausulas[2].' : </strong>
			 '.$descripcionPartesClausulas[7][0].'
			 <strong>'.$Contratos->TUTORIAS_PLAZO.'</strong>.
			</td>
		  </tr>		  

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[3].' - '.$descripcionClausulas[3].' : </strong>
			'.$descripcionPartesClausulas[8][0].'
			</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[4].' - '.$descripcionClausulas[4].' : </strong>
			'.$descripcionPartesClausulas[9][0].' <strong>'.$Contratos->TUTORIAS_PRES.'</strong> 
			'.$descripcionPartesClausulas[10][0].'</td>
		  </tr>
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[5].' - '.$descripcionClausulas[5].' : </strong>
			'.$descripcionPartesClausulas[11][0].'
			</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[6].' - '.$descripcionClausulas[6].' : </strong>
			'.$descripcionPartesClausulas[12][0].' 
			</td>
		  </tr>
	
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[7].' - '.$descripcionClausulas[7].' : </strong>
			'.$descripcionPartesClausulas[13][0].'
			<strong>'.$Contratos->TUTORIAS_SUPERV.'</strong> 
			'.$descripcionPartesClausulas[14][0].'
			</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[8].' - '.$descripcionClausulas[8].' : </strong> 
			'.$descripcionPartesClausulas[15][0].'
			</td>
		  </tr>
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[9].' - '.$descripcionClausulas[9].' : </strong> 
			'.$descripcionPartesClausulas[16][0].'</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left">
			<strong>'.$Contratos->Contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
					'.$Contratos->Contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong></td>
		  </tr>
		  <tr>
			<td align="left">'.$Contratos->Contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
		  </tr>
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left"> ACEPTO : 
			 <strong>
			 '.$Contratos->Contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
			 '.$Contratos->Contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong></td>
		  </tr>
		  	  
		  <tr>
			<td align="left">Contratista</td>
		  </tr>
		  
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  
		  <table width="100%" border="0" align="center">
		  <tr>
			<td width="15%" align="center">&nbsp;</td>
			<td width="53%" align="left">UNIGUAJIRA</td>
			<td width="32%" align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
			<td align="left">SECCIÓN: <u> Sección '.$Contratos->TUTORIAS_PRES_SECCION.'  Código '.$Contratos->TUTORIAS_PRES_CODIGO.'</u></td>
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
		  
		 </table>
		 
		</td>
	   </tr>
	  </table>';
		   }else{
	if(($Contratos->TUFC_ID)==6){			 
	$cuotaAdicionalEnLetras = strtoupper($NumberToLetters->ValorEnLetras($Contratos->TUCO_CUOTAADICIONAL,"PESOS"));
	  //***** AÑADIR PAGINA *****//
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///
	  $html ='
	  <table width="100%" border="0" align="center">
	   <tr>
		<td>
		
		<table width="100%" border="0" align="center">
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>	  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
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
		 $Contratos->Contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' '.
		 $Contratos->Contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong>    </td>
		  </tr>
		  <tr>
			<td align="left">'.$tipoDocumento.' : '.number_format($Contratos->Contrato->Persona->PERS_IDENTIFICACION).' de '.$exp.'</td>
		  </tr>
		  <tr>
			<td align="left">Direccion: '.$dir.'</td>
		  </tr>
		  <tr>
			<td align="left">Telefono: '.$Contratos->Contrato->Persona->PERS_TELEFONO.'</td>
		  </tr>
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		 
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">'.$formatoContrato->TUFC_DESCRIPCION.'</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[0].' - '.$descripcionClausulas[0].' : </strong> 
			'.$descripcionPartesClausulas[0][0].' <strong>'.$Contratos->TUTORIAS_LISTADO_MODULOS.'</strong>. 
			'.$descripcionPartesClausulas[1][0].' <strong>'.$Contratos->TUTORIAS_LIST_PROG.'</strong> 
			'.$descripcionPartesClausulas[2][0].' <strong>'.$Contratos->TUTORIAS_LIST_SEDES.'</strong>  
			'.$descripcionPartesClausulas[3][0].' (<strong>'.$Contratos->TUTORIAS_INTENS.'</strong>) 
			'.$descripcionPartesClausulas[4][0].' (<strong>$'.number_format($Contratos->TUCO_VALORHORA).'</strong>).

			</td>
		  </tr>
		  
		  <tr>
           <td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[1].' - '.$descripcionClausulas[1].' : </strong>  
			'.$descripcionPartesClausulas[5][0].' <strong>'.$valorContratoLetras.' M/C ($'.number_format($valorContrato).').</strong>  
			'.$descripcionPartesClausulas[6][0].'
			</td>
		  </tr>
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		   <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[2].' - '.$descripcionClausulas[2].' : </strong>
			 '.$descripcionPartesClausulas[7][0].'
			 <strong>'.$cuotaAdicionalEnLetras.' ($'.number_format($Contratos->TUCO_CUOTAADICIONAL).')</strong>.
			</td>
		  </tr>	
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		   <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[3].' - '.$descripcionClausulas[3].' : </strong>
			 '.$descripcionPartesClausulas[8][0].'
			 <strong>'.$Contratos->TUTORIAS_PLAZO.'</strong>.
			</td>
		  </tr>		  

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[4].' - '.$descripcionClausulas[4].' : </strong>
			'.$descripcionPartesClausulas[9][0].'
			</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[5].' - '.$descripcionClausulas[5].' : </strong>
			'.$descripcionPartesClausulas[10][0].' <strong>'.$Contratos->TUTORIAS_PRES.'</strong> 
			'.$descripcionPartesClausulas[11][0].'</td>
		  </tr>
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[6].' - '.$descripcionClausulas[6].' : </strong>
			'.$descripcionPartesClausulas[12][0].'
			</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[7].' - '.$descripcionClausulas[7].' : </strong>
			'.$descripcionPartesClausulas[13][0].' 
			</td>
		  </tr>
	
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[8].' - '.$descripcionClausulas[8].' : </strong>
			'.$descripcionPartesClausulas[14][0].'
			<strong>'.$Contratos->TUTORIAS_SUPERV.'</strong> 
			'.$descripcionPartesClausulas[15][0].'
			</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[9].' - '.$descripcionClausulas[9].' : </strong> 
			'.$descripcionPartesClausulas[16][0].'
			</td>
		  </tr>
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[10].' - '.$descripcionClausulas[10].' : </strong> 
			'.$descripcionPartesClausulas[17][0].'</td>
		  </tr>
          <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left">
			<strong>'.$Contratos->Contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
					'.$Contratos->Contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'
			</strong>
			</td>
		  </tr>
		  <tr>
			<td align="left">'.$Contratos->Contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
		  </tr>
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left"> ACEPTO : 
			 <strong>
			 '.$Contratos->Contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
			 '.$Contratos->Contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'
			 </strong>
			 </td>
		  </tr>
		  	  
		  <tr>
			<td align="left">Contratista</td>
		  </tr>
		  
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  
		  <table width="100%" border="0" align="center">
		  <tr>
			<td width="15%" align="center">&nbsp;</td>
			<td width="53%" align="left">UNIGUAJIRA</td>
			<td width="32%" align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
			<td align="left">SECCIÓN: <u> Sección '.$Contratos->TUTORIAS_PRES_SECCION.'  Código '.$Contratos->TUTORIAS_PRES_CODIGO.'</u></td>
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
		  
		 </table>
		 
		</td>
	   </tr>
	  </table>';
	  		   
				}else{
	if(($Contratos->TUFC_ID)==3){
	  
	  //***** AÑADIR PAGINA *****//
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///	
	   $html ='
	  <table width="100%" border="0" align="center">
	   <tr>
		<td>
		
		<table width="100%" border="0" align="center">
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>	  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
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
		 $Contratos->Contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' '.
		 $Contratos->Contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong>    </td>
		  </tr>
		  <tr>
			<td align="left">'.$tipoDocumento.' : '.number_format($Contratos->Contrato->Persona->PERS_IDENTIFICACION).' de '.$exp.'</td>
		  </tr>
		  <tr>
			<td align="left">Direccion: '.$dir.'</td>
		  </tr>
		  <tr>
			<td align="left">Telefono: '.$Contratos->Contrato->Persona->PERS_TELEFONO.'</td>
		  </tr>
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		 
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">'.$formatoContrato->TUFC_DESCRIPCION.'</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[0].' - '.$descripcionClausulas[0].' : </strong> 
			'.$descripcionPartesClausulas[0][0].' <strong>'.$Contratos->TUTORIAS_LISTADO_MODULOS.'</strong>. 
			'.$descripcionPartesClausulas[1][0].' <strong>'.$Contratos->TUTORIAS_LIST_PROG.'</strong> 
			'.$descripcionPartesClausulas[2][0].' <strong>'.$Contratos->TUTORIAS_LIST_SEDES.'</strong>  
			'.$descripcionPartesClausulas[3][0].' (<strong>'.$Contratos->TUTORIAS_INTENS.'</strong>) 
			'.$descripcionPartesClausulas[4][0].' (<strong>$'.number_format($Contratos->TUCO_VALORHORA).'M/L</strong>).
			</td>
		  </tr>
		  
		  <tr>
           <td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[1].' - '.$descripcionClausulas[1].' : </strong>  
			'.$descripcionPartesClausulas[5][0].' <strong>'.$valorContratoLetras.' M/C ($'.number_format($valorContrato).').</strong>  
			'.$descripcionPartesClausulas[6][0].'
			</td>
		  </tr>
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		   <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[2].' - '.$descripcionClausulas[2].' : </strong>
			 '.$descripcionPartesClausulas[7][0].'
			 <strong>'.$Contratos->TUTORIAS_PLAZO.'</strong>.
			</td>
		  </tr>		  

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[3].' - '.$descripcionClausulas[3].' : </strong>
			'.$descripcionPartesClausulas[8][0].'
			</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[4].' - '.$descripcionClausulas[4].' : </strong>
			'.$descripcionPartesClausulas[9][0].' <strong>'.$Contratos->TUTORIAS_PRES.'</strong> 
			'.$descripcionPartesClausulas[10][0].'</td>
		  </tr>
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[5].' - '.$descripcionClausulas[5].' : </strong>
			'.$descripcionPartesClausulas[11][0].'
			</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[6].' - '.$descripcionClausulas[6].' : </strong>
			'.$descripcionPartesClausulas[12][0].' 
			</td>
		  </tr>
	
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[7].' - '.$descripcionClausulas[7].' : </strong>
			'.$descripcionPartesClausulas[13][0].'
			<strong>'.$Contratos->TUTORIAS_SUPERV.'</strong> 
			'.$descripcionPartesClausulas[14][0].'
			</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[8].' - '.$descripcionClausulas[8].' : </strong> 
			'.$descripcionPartesClausulas[15][0].'
			</td>
		  </tr>
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[9].' - '.$descripcionClausulas[9].' : </strong> 
			'.$descripcionPartesClausulas[16][0].'</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left">
			<strong>'.$Contratos->Contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
					'.$Contratos->Contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong></td>
		  </tr>
		  <tr>
			<td align="left">'.$Contratos->Contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
		  </tr>
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left"> ACEPTO : 
			 <strong>
			 '.$Contratos->Contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
			 '.$Contratos->Contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong></td>
		  </tr>
		  	  
		  <tr>
			<td align="left">Contratista</td>
		  </tr>
		  
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  
		  <table width="100%" border="0" align="center">
		  <tr>
			<td width="15%" align="center">&nbsp;</td>
			<td width="53%" align="left">UNIGUAJIRA</td>
			<td width="32%" align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
			<td align="left">SECCIÓN: <u> Sección '.$Contratos->TUTORIAS_PRES_SECCION.' Código '.$Contratos->TUTORIAS_PRES_CODIGO.'</u></td>
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
		  
		 </table>
		 
		</td>
	   </tr>
	  </table>';
	  			 
	}else{
	      if(($Contratos->TUFC_ID)==2){
	 //***** AÑADIR PAGINA *****//
	  $pdf->AddPage();
	  ///***** CREANDO ARCHIVO *****///	
	   $html ='
	  <table width="100%" border="0" align="center">
	   <tr>
		<td>
		
		<table width="100%" border="0" align="center">
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>	  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
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
		 $Contratos->Contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' '.
		 $Contratos->Contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong>    </td>
		  </tr>
		  <tr>
			<td align="left">'.$tipoDocumento.' : '.number_format($Contratos->Contrato->Persona->PERS_IDENTIFICACION).' de '.$exp.'</td>
		  </tr>
		  <tr>
			<td align="left">Direccion: '.$dir.'</td>
		  </tr>
		  <tr>
			<td align="left">Telefono: '.$Contratos->Contrato->Persona->PERS_TELEFONO.'</td>
		  </tr>
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		 
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">'.$formatoContrato->TUFC_DESCRIPCION.'</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[0].' - '.$descripcionClausulas[0].' : </strong> 
			'.$descripcionPartesClausulas[0][0].' <strong>'.$Contratos->TUTORIAS_LISTADO_MODULOS.'</strong>. 
			'.$descripcionPartesClausulas[1][0].' <strong>'.$Contratos->TUTORIAS_LIST_PROG.'</strong> 
			'.$descripcionPartesClausulas[2][0].' <strong>'.$Contratos->TUTORIAS_LIST_SEDES.'</strong>  
			'.$descripcionPartesClausulas[3][0].' (<strong>'.$Contratos->TUTORIAS_INTENS.'</strong>) 
			'.$descripcionPartesClausulas[4][0].' (<strong>$'.number_format($Contratos->TUCO_VALORHORA).'M/L</strong>).
			</td>
		  </tr>
		  
		  <tr>
           <td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[1].' - '.$descripcionClausulas[1].' : </strong>  
			'.$descripcionPartesClausulas[5][0].' <strong>'.$valorContratoLetras.' M/C ($'.number_format($valorContrato).').</strong>  
			'.$descripcionPartesClausulas[6][0].'
			</td>
		  </tr>
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		   <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[2].' - '.$descripcionClausulas[2].' : </strong>
			 '.$descripcionPartesClausulas[7][0].'
			 <strong>'.$Contratos->TUTORIAS_PLAZO.'</strong>.
			</td>
		  </tr>		  

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[3].' - '.$descripcionClausulas[3].' : </strong>
			'.$descripcionPartesClausulas[8][0].'
			</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[4].' - '.$descripcionClausulas[4].' : </strong>
			'.$descripcionPartesClausulas[9][0].' <strong>'.$Contratos->TUTORIAS_PRES.'</strong> 
			'.$descripcionPartesClausulas[10][0].'</td>
		  </tr>
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[5].' - '.$descripcionClausulas[5].' : </strong>
			'.$descripcionPartesClausulas[11][0].'
			</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[6].' - '.$descripcionClausulas[6].' : </strong>
			'.$descripcionPartesClausulas[12][0].' 
			</td>
		  </tr>
	
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[7].' - '.$descripcionClausulas[7].' : </strong>
			'.$descripcionPartesClausulas[13][0].'
			<strong>'.$Contratos->TUTORIAS_SUPERV.'</strong> 
			'.$descripcionPartesClausulas[14][0].'
			</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[8].' - '.$descripcionClausulas[8].' : </strong> 
			'.$descripcionPartesClausulas[15][0].'
			</td>
		  </tr>
		  
		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify">
			<strong>'.$nombreClausulas[9].' - '.$descripcionClausulas[9].' : </strong> 
			'.$descripcionPartesClausulas[16][0].'</td>
		  </tr>

		  <tr>
			<td align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left">
			<strong>'.$Contratos->Contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
					'.$Contratos->Contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'</strong></td>
		  </tr>
		  <tr>
			<td align="left">'.$Contratos->Contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
		  </tr>
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="left"> ACEPTO : 
			 <strong>
			 '.$Contratos->Contrato->Persona->rel_personas_naturales->PENA_NOMBRES.' 
			 '.$Contratos->Contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong></td>
		  </tr>
		  	  
		  <tr>
			<td align="left">Contratista</td>
		  </tr>
		  
		  <tr>
			<td align="left">&nbsp;</td>
		  </tr>
		  
		  <table width="100%" border="0" align="center">
		  <tr>
			<td width="15%" align="center">&nbsp;</td>
			<td width="53%" align="left">UNIGUAJIRA</td>
			<td width="32%" align="center">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="center">&nbsp;</td>
		<td align="left">SECCIÓN: <u> Sección '.$Contratos->TUTORIAS_PRES_SECCION.' Código '.$Contratos->TUTORIAS_PRES_CODIGO.'</u></td>
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
		  
		 </table>
		 
		</td>
	   </tr>
	  </table>';
	      }elseif(($Contratos->TUFC_ID)==5){
	      //***** AÑADIR PAGINA *****//
	      $pdf->AddPage();
	      ///***** CREANDO ARCHIVO *****///	
	      $html ='
		  <table width="100%" border="0">
		  <tr>
			<td width="75%"><strong>RIOHACHA</strong>,</td>
			<td width="25%" align="center"><strong>CONTRATO No.</strong></td>
		  </tr>
		  <tr>
			<td width="75%">Profesor (a)</td>
			<td width="25%" align="center"><strong>'.$numero.'</strong></td>
		  </tr>
		  
		  <tr>
			<td colspan="2">
			<table width="100%" border="0">
			  <tr>
				<td align="left">
				<strong>'.$Contratos->Contrato->Persona->rel_personas_naturales->PENA_NOMBRES.'</strong>
				<strong>'.$Contratos->Contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong>
				</td>
			  </tr>
			  <tr>
				<td align="left">
				'.$tipoIdentificacion.' No. '.number_format($identificacion).'
				</td>
			  </tr>
			 </table>
			</td>
		  </tr>		 
		  <tr>
			<td align="justify" colspan="2">'.$formatoContrato->TUFC_DESCRIPCION.'</td>
		  </tr>
		  
		  <tr>
			<td align="justify" colspan="2">
			<strong>'.$nombreClausulas[0].' - '.$descripcionClausulas[0].' : </strong> 
			'.$descripcionPartesClausulas[0][0].' <strong>'.$Contratos->TUTORIAS_LIST_PROG.'</strong>
			'.$descripcionPartesClausulas[1][0].'  <strong>'.$Contratos->TUTORIAS_LISTADO_MODULOS.'</strong>
			'.$descripcionPartesClausulas[2][0].' <strong>'.$Contratos->TUTORIAS_PLAZO.'</strong> en 
			<strong>'.$Contratos->TUTORIAS_LIST_SEDES.' </strong>
			'.$descripcionPartesClausulas[3][0].' <strong>'.$programa.'</strong>  
			'.$descripcionPartesClausulas[4][0].' (<strong>'.$Contratos->TUTORIAS_INTENS.'</strong>)
			'.$descripcionPartesClausulas[5][0].' <strong>'.$programa.'</strong>.
			'.$descripcionPartesClausulas[6][0].'
			</td>
		  </tr>
		  
		  <tr>
           <td align="center" colspan="2">&nbsp;</td>
		  </tr>
		  <tr>
			<td align="justify" colspan="2">
			<strong>'.$nombreClausulas[1].' - '.$descripcionClausulas[1].' : </strong>  
			'.$descripcionPartesClausulas[7][0].' <strong>'.$programa.'</strong>  
			'.$descripcionPartesClausulas[8][0].' 
			<strong>'.strtoupper($NumberToLetters->ValorEnLetras($Contratos->TUCO_VALORHORA,"PESOS")).'</strong> 
			(<strong>$'.number_format($Contratos->TUCO_VALORHORA).'M/L</strong>)
			'.$descripcionPartesClausulas[9][0].' <strong>'.$valorContratoLetras.' M/C ($'.number_format($valorContrato).')</strong>
			'.$descripcionPartesClausulas[10][0].' <strong>'.$Contratos->TUTORIAS_PRES.'</strong>
			'.$descripcionPartesClausulas[11][0].'
			</td>
		  </tr>
		  
		  <tr>
			<td align="justify" colspan="2">
			<strong>'.$nombreClausulas[2].' - '.$descripcionClausulas[2].' : </strong>  
			'.$descripcionPartesClausulas[12][0].' 
			</td>
		  </tr>
		  
		  <tr>
			<td align="justify" colspan="2">
			<strong>'.$nombreClausulas[3].' - '.$descripcionClausulas[3].' : </strong>  
			'.$descripcionPartesClausulas[13][0].' 
			</td>
		  </tr>
		  
		  <tr>
           <td align="center" colspan="2">&nbsp;</td>
		  </tr>
		  <tr>
		   <td align="center" colspan="2">
				
			<table width="100%" border="0">
			  <tr>
				<td width="50%" align="left"><strong>CONTRATANTE</strong></td>
				<td width="50%" align="left"><strong>CONTRATISTA</strong></td>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			  <tr>					
				<td align="left"><strong>'.$Contratos->Contrato->rel_contratantes->rel_personas_naturales->PENA_NOMBRES.' 
				  '.$Contratos->Contrato->rel_contratantes->rel_personas_naturales->PENA_APELLIDOS.'
				  </strong>
				</td>
				<td align="left"><strong>'.$Contratos->Contrato->Persona->rel_personas_naturales->PENA_NOMBRES.'</strong>
				 <strong>'.$Contratos->Contrato->Persona->rel_personas_naturales->PENA_APELLIDOS.'</strong>
				</td>
			  </tr>
			  <tr>
				<td align="left">'.$Contratos->Contrato->rel_contratantes->
				rel_personas_naturales->rel_personas->rel_tipos_identificacion->TIID_DESCRIPCION.' No. 
				'.number_format($Contratos->Contrato->rel_contratantes->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION).'
				</td>
				<td align="left">
				'.$tipoIdentificacion.' No. '.number_format($identificacion).'		
				</td>
			  </tr>
			  <tr>
				<td align="left">'.$Contratos->Contrato->rel_contratantes->PECO_DESCRIPCION.'</td>
				<td align="left">Docente Catedrático</td>
			  </tr>
			</table>		
		   </td>
		  </tr>
		  
		  <tr>
			<td colspan="2">&nbsp;</td>
		  </tr>
		  <tr>
			<td colspan="2">
			
		<table width="100%" border="0" align="center">
		  <tr>
			<td width="15%" align="center">&nbsp;</td>
		    <td width="53%" align="left">SECCIÓN: 
			 <u> Sección '.$Contratos->TUTORIAS_PRES_SECCION.' Código '.$Contratos->TUTORIAS_PRES_CODIGO.'</u></td>
			<td width="32%" align="center">&nbsp;</td>
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
	     }
		}
	
	}
	
   $pdf->SetFont('times', 'K', 10);
   $pdf->writeHTML($html, true, 0, true, 0);
  }
 $pdf->Output("$NombreDocumento.pdf", 'D');  
    
  Yii::app()->end();
  
?>