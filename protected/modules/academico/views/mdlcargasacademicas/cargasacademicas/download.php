<?php   
$pdf = Yii::createComponent('application.extensions.tcpdftati.ETcPdf','L', 'cm', 'Legal', true, 'UTF-8');
  ini_set("memory_limit","1024M"); 
  set_time_limit(0);
 
  
  $autor='DDS2013 - UNIVERSIDAD DE LA GUAJIRA';  
 // $Numero = $Contratos->numOrden;     
  $titulo="ASIGNACION ACADEMICA";
  $palabrasClaves='CARGA ACADEMICA, ASIGNACION ACADEMICA';
  $Sujeto='ASIGNACION ACADEMICA';
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
  $pdf->SetFont('helvetica', '', 8);
  
$pdf->AddPage('L','legal');
$pdf->writeHTML('<br/><br/><br/><br/><span style="text-align:center;"><strong></strong></span>');
$data=$Cargasacademicas->listadoDocentesP();
 $i=1;
$html='<div align="center"><b>DOCENTES DE PLANTA</b></div>
<br/>
 <table width="100%" border="1" align="center">
	 <thead>
		  <tr>
			<td width="1%">#</td>
			<td width="30%">DETALLE</td>
			<td width="40%">DOCENCIA DIRECTA</td>
			<td width="10%">INVESTIGACION</td>
			<td width="10%">EXTENSION</td>
			<td width="3%">THS</td>
			<td width="3%">THM</td>
			<td width="3%">THS</td>
			</tr></thead>';
             foreach($data as $rows){
				$PRCA_ID=$rows['PRCA_ID'];
				$Restudios=$Cargasacademicas->estudiosDocentes($PRCA_ID);
				$html=$html.'<tr>
					<td width="1%">'.$i++.'</td>
                    <td width="30%" align="left"><br/>
					DOCENTE: <b>'.$rows["TICD_NOMBRE"].'</b><br />
					<b>'.$rows["FACU_NOMBRE"].'</b><br />
					 No. CEDULA:<b>'.$rows['PERS_IDENTIFICACION'].'</b><br />
                     DOCENTE: <b>'.$rows["NOMBRE_DOCENTE"].'</b><br />
					<b> ESTUDIOS:</b>'.$Restudios.'<br/>
					</td>
                   <td width="40%">';
					$asignaturas=$Cargasacademicas->asignaturasDocente($PRCA_ID);
					$num_row=$Cargasacademicas->contarAsignaturas($PRCA_ID);
					if($num_row>0){
				 $html=$html.'<table border="1" align="center" width="100%">
                    <thead>
                  <tr>
					 <td width="50%">PROGRAMA</td>
					 <td width="10%">CODIGO</td> 
					 <td width="20%">ASIGNATURA</td> 
					 <td width="4%">#G</td> 
					 <td width="4%">IHS</td>
					 <td width="4%">THS</td>
                      <td width="4%">THM</td>
                       <td width="4%">THSE</td>
                       </tr>
                       </thead>'; 
					 $it=0; $ihs=0;
					 foreach($asignaturas as $asig){ 
					 $it++; 
					$html=$html.'<tr>
					 <td  width="50%">'.$asig["PROG_NOMBRE"].'</td>
					 <td  width="10%">'.$asig["ASIG_CODIGO"].'</td> 
					 <td  width="20%">'.$asig["ASIG_NOMBRE"].'</td> 
					 <td  width="4%">'.$asig["CAAD_NUMUMERO_GRUPOS"].'</td> 
					 <td  width="4%">'.$asig["ASIG_NUMERO_CREDITOS"].'</td>';
                    if($it==1){
					 $html=$html.'<td  width="4%" rowspan="'.$num_row.'">'.($rows["HDDIRECTA"]).'</td>
                      <td  width="4%" rowspan="'.$num_row.'">'.($rows["HDDIRECTA"]*4).'</td>
                      <td  width="4%" rowspan="'.$num_row.'">'.($rows["HDDIRECTA"]*16).'</td>';
                     }
					 $html=$html.'</tr>';}
					$html=$html.'</table>'; }
					  $html=$html.'</td>
						<td width="10%"><table border="1" align="center" width="100%">
                    <thead>
                  <tr>
					 <td>THS</td> 
					 <td>THM</td> 
					 <td>THSE</td> 
					 </tr>
                       </thead>
                	 <tr>
					 <td>'.($rows["HINVESTIGACION"]).'</td>
					 <td>'.($rows["HINVESTIGACION"]*4).'</td> 
					 <td>'.($rows["HINVESTIGACION"]*16).'</td> 
					 </tr>
					</table></td>
						<td width="10%"><table border="1" align="center" width="100%">
                    <thead>
                  <tr>
					 <td>THS</td> 
					 <td>THM</td> 
					 <td>THSE</td> 
					 </tr>
                       </thead>
                	 <tr>
					 <td>'.$rows["HEXTENSION"].'</td>
					 <td>'.($rows["HEXTENSION"]*4).'</td> 
					 <td>'.($rows["HEXTENSION"]*16).'</td> 
					 </tr>
					</table></td>
						<td width="3%">'.($rows["HDDIRECTA"]+$rows["HINVESTIGACION"]+$rows["HEXTENSION"]).'</td>
						<td width="3%">'.(($rows["HDDIRECTA"]+$rows["HINVESTIGACION"]+$rows["HEXTENSION"])*4).'</td>
						<td width="3%">'.(($rows["HDDIRECTA"]+$rows["HINVESTIGACION"]+$rows["HEXTENSION"])*16).'</td>
						</tr>';
			 }
$html=$html.'</table>';
$pdf->writeHTML($html, true, false, false, false, ' ');
//-------

$pdf->AddPage('L','legal');
$pdf->writeHTML('<br/><br/><br/><br/><span style="text-align:center;"><strong></strong></span>');
$html2='<br/> ';
 $dataO=$Cargasacademicas->listadoDocentesO();
 $i=1;
$html2='<div align="center"><b>DOCENTES OCASIONALES</b></div>
<br/>
 <table width="100%" border="1" align="center">
	 <thead>
		  <tr>
			<td width="1%">#</td>
			<td width="30%">DETALLE</td>
			<td width="40%">DOCENCIA DIRECTA</td>
			<td width="10%">INVESTIGACION</td>
			<td width="10%">EXTENSION</td>
			<td width="3%">THS</td>
			<td width="3%">THM</td>
			<td width="3%">THS</td>
			</tr></thead>';
             foreach($dataO as $rows){
				$PRCA_ID=$rows['PRCA_ID'];
				$Restudios=$Cargasacademicas->estudiosDocentes($PRCA_ID);
					$html2=$html2.'<tr>
					<td width="1%">'.$i++.'</td>
                    <td width="30%" align="left"><br/>
					DOCENTE: <b>'.$rows["TICD_NOMBRE"].'</b><br />
					<b>'.$rows["FACU_NOMBRE"].'</b><br />
					 No. CEDULA:<b>'.$rows['PERS_IDENTIFICACION'].'</b><br />
                     DOCENTE: <b>'.$rows["NOMBRE_DOCENTE"].'</b><br />
					<b> ESTUDIOS:</b>'.$Restudios.'<br/>
					</td>
                   <td width="40%">';
					$asignaturas=$Cargasacademicas->asignaturasDocente($PRCA_ID);
					$num_row=$Cargasacademicas->contarAsignaturas($PRCA_ID);
					if($num_row>0){
				 $html2=$html2.'<table border="1" align="center" width="100%">
                    <thead>
                  <tr>
					 <td width="50%">PROGRAMA</td>
					 <td width="10%">CODIGO</td> 
					 <td width="20%">ASIGNATURA</td> 
					 <td width="4%">#G</td> 
					 <td width="4%">IHS</td>
					 <td width="4%">THS</td>
                      <td width="4%">THM</td>
                       <td width="4%">THSE</td>
                       </tr>
                       </thead>'; 
					 $it=0; $ihs=0;
					 foreach($asignaturas as $asig){ 
					 $it++; 
					$html2=$html2.'<tr>
					 <td  width="50%">'.$asig["PROG_NOMBRE"].'</td>
					 <td  width="10%">'.$asig["ASIG_CODIGO"].'</td> 
					 <td  width="20%">'.$asig["ASIG_NOMBRE"].'</td> 
					 <td  width="4%">'.$asig["CAAD_NUMUMERO_GRUPOS"].'</td> 
					 <td  width="4%">'.$asig["ASIG_NUMERO_CREDITOS"].'</td>';
                    if($it==1){
					 $html2=$html2.'<td  width="4%" rowspan="'.$num_row.'">'.($rows["HDDIRECTA"]).'</td>
                      <td  width="4%" rowspan="'.$num_row.'">'.($rows["HDDIRECTA"]*4).'</td>
                      <td  width="4%" rowspan="'.$num_row.'">'.($rows["HDDIRECTA"]*16).'</td>';
                     }
					 $html2=$html2.'</tr>';}
					$html2=$html2.'</table>'; }
					  $html2=$html2.'</td>
						<td width="10%"><table border="1" align="center" width="100%">
                    <thead>
                  <tr>
					 <td>THS</td> 
					 <td>THM</td> 
					 <td>THSE</td> 
					 </tr>
                       </thead>
                	 <tr>
					 <td>'.($rows["HINVESTIGACION"]).'</td>
					 <td>'.($rows["HINVESTIGACION"]*4).'</td> 
					 <td>'.($rows["HINVESTIGACION"]*16).'</td> 
					 </tr>
					</table></td>
						<td width="10%"><table border="1" align="center" width="100%">
                    <thead>
                  <tr>
					 <td>THS</td> 
					 <td>THM</td> 
					 <td>THSE</td> 
					 </tr>
                       </thead>
                	 <tr>
					 <td>'.$rows["HEXTENSION"].'</td>
					 <td>'.($rows["HEXTENSION"]*4).'</td> 
					 <td>'.($rows["HEXTENSION"]*16).'</td> 
					 </tr>
					</table></td>
						<td width="3%">'.($rows["HDDIRECTA"]+$rows["HINVESTIGACION"]+$rows["HEXTENSION"]).'</td>
						<td width="3%">'.(($rows["HDDIRECTA"]+$rows["HINVESTIGACION"]+$rows["HEXTENSION"])*4).'</td>
						<td width="3%">'.(($rows["HDDIRECTA"]+$rows["HINVESTIGACION"]+$rows["HEXTENSION"])*16).'</td>
						</tr>';
			 }
$html2=$html2.'</table>';
$pdf->writeHTML($html2, true, false, false, false, ' C');


$pdf->AddPage('L','legal');
$pdf->writeHTML('<br/><br/><br/><br/><span style="text-align:center;"><strong></strong></span>');
$html3='<br/> ';
 $dataC=$Cargasacademicas->listadoDocentesC();
 $i=1;
$html3='<div align="center"><b>DOCENTES CATEDRÁTICOS</b></div>
<br/>
 <table width="100%" border="1" align="center">
	 <thead>
		  <tr>
			<td width="1%">#</td>
			<td width="30%">DETALLE</td>
			<td width="40%">DOCENCIA DIRECTA</td>
			<td width="10%">INVESTIGACION</td>
			<td width="10%">EXTENSION</td>
			<td width="3%">THS</td>
			<td width="3%">THM</td>
			<td width="3%">THS</td>
			</tr></thead>';
             foreach($dataC as $rows){
				$PRCA_ID=$rows['PRCA_ID'];
				$Restudios=$Cargasacademicas->estudiosDocentes($PRCA_ID);
				$html3=$html3.'<tr>
					<td width="1%">'.$i++.'</td>
                    <td width="30%" align="left"><br/>
					DOCENTE: <b>'.$rows["TICD_NOMBRE"].'</b><br />
					<b>'.$rows["FACU_NOMBRE"].'</b><br />
					 No. CEDULA:<b>'.$rows['PERS_IDENTIFICACION'].'</b><br />
                     DOCENTE: <b>'.$rows["NOMBRE_DOCENTE"].'</b><br />
					<b> ESTUDIOS:</b>'.$Restudios.';<br/>
					</td>
                   <td width="40%">';
					$asignaturas=$Cargasacademicas->asignaturasDocente($PRCA_ID);
					$num_row=$Cargasacademicas->contarAsignaturas($PRCA_ID);
					if($num_row>0){
				 $html3=$html3.'<table border="1" align="center" width="100%">
                    <thead>
                  <tr>
					 <td width="50%">PROGRAMA</td>
					 <td width="10%">CODIGO</td> 
					 <td width="20%">ASIGNATURA</td> 
					 <td width="4%">#G</td> 
					 <td width="4%">IHS</td>
					 <td width="4%">THS</td>
                      <td width="4%">THM</td>
                       <td width="4%">THSE</td>
                       </tr>
                       </thead>'; 
					 $it=0; $ihs=0;
					 foreach($asignaturas as $asig){ 
					 $it++; 
					$html3=$html3.'<tr>
					 <td  width="50%">'.$asig["PROG_NOMBRE"].'</td>
					 <td  width="10%">'.$asig["ASIG_CODIGO"].'</td> 
					 <td  width="20%">'.$asig["ASIG_NOMBRE"].'</td> 
					 <td  width="4%">'.$asig["CAAD_NUMUMERO_GRUPOS"].'</td> 
					 <td  width="4%">'.$asig["ASIG_NUMERO_CREDITOS"].'</td>';
                    if($it==1){
					 $html3=$html3.'<td  width="4%" rowspan="'.$num_row.'">'.($rows["HDDIRECTA"]).'</td>
                      <td  width="4%" rowspan="'.$num_row.'">'.($rows["HDDIRECTA"]*4).'</td>
                      <td  width="4%" rowspan="'.$num_row.'">'.($rows["HDDIRECTA"]*16).'</td>';
                     }
					 $html3=$html3.'</tr>';}
					$html3=$html3.'</table>'; }
					  $html3=$html3.'</td>
						<td width="10%"><table border="1" align="center" width="100%">
                    <thead>
                  <tr>
					 <td>THS</td> 
					 <td>THM</td> 
					 <td>THSE</td> 
					 </tr>
                       </thead>
                	 <tr>
					 <td>'.($rows["HINVESTIGACION"]).'</td>
					 <td>'.($rows["HINVESTIGACION"]*4).'</td> 
					 <td>'.($rows["HINVESTIGACION"]*16).'</td> 
					 </tr>
					</table></td>
						<td width="10%"><table border="1" align="center" width="100%">
                    <thead>
                  <tr>
					 <td>THS</td> 
					 <td>THM</td> 
					 <td>THSE</td> 
					 </tr>
                       </thead>
                	 <tr>
					 <td>'.$rows["HEXTENSION"].'</td>
					 <td>'.($rows["HEXTENSION"]*4).'</td> 
					 <td>'.($rows["HEXTENSION"]*16).'</td> 
					 </tr>
					</table></td>
						<td width="3%">'.($rows["HDDIRECTA"]+$rows["HINVESTIGACION"]+$rows["HEXTENSION"]).'</td>
						<td width="3%">'.(($rows["HDDIRECTA"]+$rows["HINVESTIGACION"]+$rows["HEXTENSION"])*4).'</td>
						<td width="3%">'.(($rows["HDDIRECTA"]+$rows["HINVESTIGACION"]+$rows["HEXTENSION"])*16).'</td>
						</tr>';
			 }
$html3=$html3.'</table>';
$pdf->writeHTML($html3, true, false, false, false, ' C');


$pdf->Output("$NombreDocumento.pdf", 'I');  
    
  Yii::app()->end();
?>