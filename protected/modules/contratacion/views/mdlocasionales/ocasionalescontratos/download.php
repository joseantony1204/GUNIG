<?php
  $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf','P', 'pt', 'A4', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
  
  $phpNumToLetterPath = Yii::getPathOfAlias('ext');
  include($phpNumToLetterPath . DIRECTORY_SEPARATOR . 'CNumeroaLetra.php');
  $NumberToLetters = new EnLetras();
  
  
  $autor='ING. JOSE ANTONIO GONZALEZ LIÑAN - UNIVERSIDAD DE LA GUAJIRA';  
 // $Numero = $Contratos->numOrden;     
  $titulo="REPORTE DE CONTRATOS DOCENTES OCASIONALES";
  $palabrasClaves='CONTRATO, OCASIONALES, TALENTO HUMANO';
  $Sujeto='CONTRATO OCASIONALES';
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
  $pdf->SetFont('times', 'K', 10);
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
 
  $id = "";  $facultad = "";  $opcion = "";
  
  if(($_REQUEST["id"]) or ($_REQUEST["facultad"])) {
   $id = $_REQUEST["id"];
   $facultad = $_REQUEST["facultad"];
   $data = $Ocasionalescontratos->downloadContratos($id,$facultad);
  }else{   
		if($_REQUEST["opcion"]=='true'){
		 $data = $Registros;
		}
       }
 

  
  foreach($data as $rows){
  $Ocasionalescontratos = Ocasionalescontratos::model()->findByPk($rows["OCCO_ID"]);
  
  /*OBTENIENDO VALORES PARA CALCULAR EL VALOR DEL CONTRATO*/
  $meses = $Ocasionalescontratos->OCCO_MESES;
  $dias = $Ocasionalescontratos->OCCO_DIAS;
  $sueldo = $Ocasionalescontratos->rel_personas_naturales_ocasionales->PENO_SUELDO;
  $valor_dias = (($sueldo)/30)*($dias);  
  $valor_total_contrato = ($sueldo*$meses)+$valor_dias;
  $valorContratoCon4xMil = (($valor_total_contrato) + (($valor_total_contrato)/(4*1000)));
  if($dias!=0){
  $desc_dias_trabajados = "y ".$dias." días, ";
  }else{
       $desc_dias_trabajados = "";
	   }
  $Numero = $Ocasionalescontratos->OCCO_RESOLUCION;
  $dia_contrato = date("d",strtotime($Ocasionalescontratos->OCCO_FECHAPROCESO));
  $mes_contrato=NombreMes(date("m",strtotime($Ocasionalescontratos->OCCO_FECHAPROCESO)));
  $anio_contrato=date("Y",strtotime($Ocasionalescontratos->OCCO_FECHAPROCESO));
  
  $Personas = Personas::model()->findByPk($Ocasionalescontratos->rel_personas_naturales_ocasionales->rel_personas_naturales->PERS_ID);
  $tipoDoc = strtolower($Personas->rel_tipos_identificacion->TIID_NOMBRE);
  $tipoDocumento = ucwords(ucfirst($tipoDoc));
  
  
  $fecha = $dia_contrato." de ".$mes_contrato." de ".$anio_contrato;
  
  $dia_cdp = date("d",strtotime($Ocasionalescontratos->rel_oca_pesupuestos->Presupuesto->PRES_FECHA_VIGENCIA));
  $mes_cdp=NombreMes(date("m",strtotime($Ocasionalescontratos->rel_oca_pesupuestos->Presupuesto->PRES_FECHA_VIGENCIA)));
  $anio_cdp=date("Y",strtotime($Ocasionalescontratos->rel_oca_pesupuestos->Presupuesto->PRES_FECHA_VIGENCIA));
  
  $fecha_cdp = "";	   
  $pdf->AddPage();
  $pdf->SetFont('times', 'K', 10);
  $html = ' 
	<table width="100%" border="0" align="center"> 
		 <tr>
		  <td align="center">RESOLUCIÓN No. <strong>'.$Numero.'</strong></td>
	     </tr>
		 <tr>
		  <td align="center">&nbsp;</td>
	     </tr> 
		 <tr>
		  <td align="center">“POR MEDIO DE LA CUAL SE HACE UNA VINCULACIÓN”</td>
	     </tr>
		 <tr>
		  <td align="center">&nbsp;</td>
	     </tr> 
		 <tr>
		  <td align="center">
		   EL '.strtoupper($Ocasionalescontratos->rel_contratanta->PECO_DESCRIPCION).'  DE LA UNIVERSIDAD DE LA GUAJIRA<br>
		   <strong>En uso de sus facultades legales, estatutarias, en especial el Acuerdo 025 de 2002, y</strong>
		  <br><br><strong>CONSIDERANDO</strong><br>
		  </td>
	     </tr>		 
		 <tr>
		  <td align="justify">Que el Articulo 13 del Estatuto Profesoral de la Universidad de la Guajira (Acuerdo 005 de 2006), 
		  establece la condición de Profesor Ocasional.<br><br>Que el Acuerdo 025 de 2002 reglamenta la 
		  vinculación y remuneración de Docentes Ocasionales.
		  <br><br>Que los  Decanos de las diferentes facultades presentaron la relación de los docentes 
		  Ocasionales  a  la Rectoría de la Universidad de La Guajira, con el objeto de formalizar su 
		  vinculación con el Alma Mater.<br><br>Que en virtud de lo anterior.
		  </td>
	     </tr>
		 
		 <tr>
		  <td align="center"><br><strong>RESUELVE:</strong><br></td>
	     </tr>
		 
		 <tr>
		  <td>
			<div align="justify"><strong>ARTICULO PRIMERO:</strong> Vincúlese a él(la) profesor(a) 
			<strong>
			'.$Ocasionalescontratos->rel_personas_naturales_ocasionales->rel_personas_naturales->PENA_APELLIDOS.'
			'.$Ocasionalescontratos->rel_personas_naturales_ocasionales->rel_personas_naturales->PENA_NOMBRES.'</strong>, 
			identificado(a) con 
			<strong>'.$tipoDocumento.' número '.number_format($Personas->PERS_IDENTIFICACION).'</strong>, 
			como Docente Ocasional de  Tiempo Completo, por un Periodo de  
			<strong>'.$meses.' Meses '.$desc_dias_trabajados.'</strong> 
			contados  a partir del Registro Presupuestal, adscrito (a) a la Facultad de 
			<strong>'.$Ocasionalescontratos->rel_personas_naturales_ocasionales->rel_facultades->FACU_NOMBRE.'</strong>, 
			con una asignación mensual de: 
            <strong>'.strtoupper($NumberToLetters->ValorEnLetras(
			$Ocasionalescontratos->rel_personas_naturales_ocasionales->PENO_SUELDO,'PESOS')).'</strong> 
			(<strong>$ '.number_format($Ocasionalescontratos->rel_personas_naturales_ocasionales->PENO_SUELDO).'</strong>) M/L, 
			para un total en el periodo de 
			(<strong>$'.number_format($valor_total_contrato).'</strong>) MCTE, con cargo a la 
			<strong>SECCIÓN '.$Ocasionalescontratos->rel_oca_pesupuestos->Presupuesto->PRES_SECCION.' CODIGO 
			'.$Ocasionalescontratos->rel_oca_pesupuestos->Presupuesto->PRES_CODIGO.'</strong>, según disponibilidad presupuestal 
			número <strong>'.$Ocasionalescontratos->rel_oca_pesupuestos->Presupuesto->PRES_NUM_CERTIFICADO.' de Fecha
			'.$Ocasionalescontratos->rel_oca_pesupuestos->Presupuesto->PRES_FECHA_VIGENCIA.' 
			del Presupuesto  de la vigencia del año '.$anio_cdp.'</strong>.
			</div>
		  </td>
	     </tr>
		 
		<tr>
		  <td align="center">&nbsp;</td>
	     </tr>
		 
		 <tr>
		 <td>
          <div align="justify"><strong>ARTICULO SEGUNDO:</strong> En cualquier momento, la 
		  Universidad podrá terminar anticipadamente esta vinculación, cuando las exigencias del servicio público lo 
		  requieran o la situación de orden público lo imponga, por muerte o incapacidad física permanente del docente, 
		  por interdicción judicial, o cuando a discrecionalidad del Rector se requiera dar por terminado por hechos 
		  que afecten grave y notoriamente su ejecución.
		  </div>
		  </td>
	     </tr>
		 
		 <tr>
		  <td align="center">&nbsp;</td>
	     </tr>
		 
		 <tr>
		 <td>
         <div align="justify"><strong>ARTICULO TERCERO:</strong> La presente resolución rige a partir de la fecha de su Expedición.
		  </div>
		  </td>
	     </tr>
		 
		  <tr>
		  <td align="center"><br><br><strong>NOTIFIQUESE Y CUMPLASE:</strong><br></td>
	     </tr> 
		 
		 <tr>
		 <td><div align="justify">Dada en Riohacha, Capital del Departamento de La Guajira, <strong>'.$fecha_cdp.'</strong> </div>
		  </td>
	     </tr>
		 
		 <tr>
		  <td align="center"><br><br><strong>'.$Rector->nombres.' '.$Rector->apellidos.'</strong><br>'.$Rector->descripcion.'</td>
	     </tr>
		 
		 <tr>
		  <td align="center">&nbsp;</td>
	     </tr>
		 
		 <tr>
		  <td align="left">
			<table width="100%" border="0" align="center">
			 <tr>
			  <td align="center">&nbsp;</td>
			  <td align="left">Seccíon: 
			  Sección '.$Ocasionalescontratos->rel_oca_pesupuestos->Presupuesto->PRES_SECCION.'  
			  Código '.$Ocasionalescontratos->rel_oca_pesupuestos->Presupuesto->PRES_CODIGO.'
			  </td>
			  <td align="center">&nbsp;</td>
			 </tr>
			 <tr>
			  <td align="center"><p>&nbsp;</p></td>
			  <td align="left">Valor: '.number_format($valorContratoCon4xMil).' </td>
			  <td align="center">&nbsp;</td>
			 </tr>
			 <tr>
			  <td align="center"><p>&nbsp;</p></td>
			  <td align="left">Fecha: ________________________</td>
			  <td align="center">&nbsp;</td>
			 </tr>
			 <tr>
			  <td align="center">&nbsp;</td>
			  <td align="left">Registro: ____________________</td>
			  <td align="center">&nbsp;</td>
			 </tr>
			</table>					
		   </td>
		  </tr> 
		 
		 </table>';
	
   $pdf->writeHTML($html, true, 0, true, 0);
  }
  
 $pdf->Output("$NombreDocumento.pdf", 'D');  
    
  Yii::app()->end();
  
?>