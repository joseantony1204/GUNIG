ini_set("memory_limit","1024M"); 
  set_time_limit(0);

   <table width="100%" border="0" align="center">
            <tr>
              <td width="6%" align="center">
              <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/carga.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE ASIGNACIÓN ACADÉMICA SEMESTRE</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('cargasacademicascpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/cargasacademicas/download',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

        
		  
?>         
		 </td>
            </tr>
          </table>
<?php


$txt='
<table width="100%"><tr>
<td align="center"><img src="'.Yii::app()->request->baseUrl.'/images/academico/logo.png" width="50%" height="30px" />
</td>
</tr></table>
<br/>';
//echo $txt;
echo '<br/><span style="text-align:center;"><strong></strong></span>';
$data=$Cargasacademicas->listadoDocentesP();
 $i=1;
$html='<div align="center"><b>DOCENTES DE PLANTA</b></div>
<br/>
 <table width="100%" border="1" align="center" bordercolor="#e79e39">
	 <thead>
		  <tr align="center" bgcolor="#e79e39">
			<td width="1%"><b>#</b></td>
			<td width="30%"><b>DETALLE</b></td>
			<td width="40%"><b>DOCENCIA DIRECTA</b></td>
			<td width="10%"><b>INVESTIGACION</b></td>
			<td width="10%"><b>EXTENSION</b></td>
			<td width="3%"><b>THS</b></td>
			<td width="3%"><b>THM</b></td>
			<td width="3%"><b>THS</b></td>
			</tr></thead>';
             foreach($data as $rows){
				$PRCA_ID=$rows['PRCA_ID'];
				$Restudios=$Cargasacademicas->estudiosDocentes($PRCA_ID);
				if(($i%2)===0){$bg="#F8E2C7";}else{$bg="#fff";}
				$html=$html.'<tr bgcolor="'.$bg.'">
					<td width="1%">'.$i++.'</td>
                    <td width="30%" align="left"><b>'.$rows["FACU_NOMBRE"].'</b><br />
					 No. CEDULA:<b>'.$rows['PERS_IDENTIFICACION'].'</b><br />
                     DOCENTE: <b>'.$rows["NOMBRE_DOCENTE"].'</b><br />
					<b> ESTUDIOS:</b>'.$Restudios.'
					</td>
                   <td width="40%" align="justify">';
					$asignaturas=$Cargasacademicas->asignaturasDocente($PRCA_ID);
					$num_row=$Cargasacademicas->contarAsignaturas($PRCA_ID);
					if($num_row>0){
				 $html=$html.'<table border="0" align="center" width="100%">
                    <thead>
                   <tr>
					 <td width="50%" bgcolor="#e79e39"><b>PROGRAMA</b></td>
					 <td width="10%" bgcolor="#e79e39"><b>CODIGO</b></td> 
					 <td width="20%" bgcolor="#e79e39"><b>ASIGNATURA</b></td> 
					 <td width="4%" bgcolor="#e79e39"><b>#G</b></td> 
					 <td width="4%" bgcolor="#e79e39"><b>IHS</b></td>
					 <td width="4%" bgcolor="#e79e39"><b>THS</b></td>
                      <td width="4%" bgcolor="#e79e39"><b>THM</b></td>
                       <td width="4%" bgcolor="#e79e39"><b>THSE</b></td>
                       </tr>
                       </thead>'; 
					 $it=0; $ihs=0;
					 $r=0;
					 foreach($asignaturas as $asig){ 
					 $it++; 
					  if(($r%2)===0){$bg2="#fff";}else{$bg2="#4ab1dc";}
					 $r++;
					$html=$html.'<tr>
					 <td  width="50%" bgcolor="'.$bg2.'">'.$asig["PROG_NOMBRE"].'</td>
					 <td  width="10%" bgcolor="'.$bg2.'">'.$asig["ASIG_CODIGO"].'</td> 
					 <td  width="20%" bgcolor="'.$bg2.'">'.$asig["ASIG_NOMBRE"].'</td> 
					 <td  width="4%" bgcolor="'.$bg2.'">'.$asig["CAAD_NUMUMERO_GRUPOS"].'</td> 
					 <td  width="4%" bgcolor="'.$bg2.'">'.$asig["ASIG_NUMERO_CREDITOS"].'</td>';
                    if($it==1){
					 $html=$html.'<td  width="4%" rowspan="'.$num_row.'" v>'.($rows["HDDIRECTA"]).'</td>
                      <td  width="4%" rowspan="'.$num_row.'"  bgcolor="#e79e39">'.($rows["HDDIRECTA"]*4).'</td>
                      <td  width="4%" rowspan="'.$num_row.'"  bgcolor="#e79e39">'.($rows["HDDIRECTA"]*16).'</td>';
                     }
					 $html=$html.'</tr>';}
					$html=$html.'</table>'; }
					  $html=$html.'</td>
						<td width="10%"><table border="0" align="center" width="100%">
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
						<td width="10%"><table border="0" align="center" width="100%">
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
echo $html;
//-------

echo '<br/><br/><br/><br/><span style="text-align:center;"><strong></strong></span>';
$html2='<br/> ';
 $dataO=$Cargasacademicas->listadoDocentesO();
 $i=1;
$html2='<div align="center"><b>DOCENTES OCASIONALES</b></div>
<br/>
<table width="100%" border="1" align="center" bordercolor="#e79e39">
	 <thead>
		  <tr align="center" bgcolor="#e79e39">
			<td width="1%"><b>#</b></td>
			<td width="30%"><b>DETALLE</b></td>
			<td width="40%"><b>DOCENCIA DIRECTA</b></td>
			<td width="10%"><b>INVESTIGACION</b></td>
			<td width="10%"><b>EXTENSION</b></td>
			<td width="3%"><b>THS</b></td>
			<td width="3%"><b>THM</b></td>
			<td width="3%"><b>THS</b></td>
			</tr></thead>';
             foreach($dataO as $rows){
				$PRCA_ID=$rows['PRCA_ID'];
				$Restudios=$Cargasacademicas->estudiosDocentes($PRCA_ID);
				if(($i%2)===0){$bg="#F8E2C7";}else{$bg="#fff";}
				$html2=$html2.'<tr bgcolor="'.$bg.'">
					<td width="1%">'.$i++.'</td>
                    <td width="30%" align="left"><b>'.$rows["FACU_NOMBRE"].'</b><br />
					 No. CEDULA:<b>'.$rows['PERS_IDENTIFICACION'].'</b><br />
                     DOCENTE: <b>'.$rows["NOMBRE_DOCENTE"].'</b><br />
					<b> ESTUDIOS:</b>'.$Restudios.'
					</td>
                   <td width="40%">';
					$asignaturas=$Cargasacademicas->asignaturasDocente($PRCA_ID);
					$num_row=$Cargasacademicas->contarAsignaturas($PRCA_ID);
					if($num_row>0){
				 $html2=$html2.'<table border="0" align="center" width="100%">
                    <thead>
                  <tr>
					 <td width="50%" bgcolor="#e79e39"><b>PROGRAMA</b></td>
					 <td width="10%" bgcolor="#e79e39"><b>CODIGO</b></td> 
					 <td width="20%" bgcolor="#e79e39"><b>ASIGNATURA</b></td> 
					 <td width="4%" bgcolor="#e79e39"><b>#G</b></td> 
					 <td width="4%" bgcolor="#e79e39"><b>IHS</b></td>
					 <td width="4%" bgcolor="#e79e39"><b>THS</b></td>
                      <td width="4%" bgcolor="#e79e39"><b>THM</b></td>
                       <td width="4%" bgcolor="#e79e39"><b>THSE</b></td>
                       </tr>
                       </thead>'; 
					 $it=0; $ihs=0;
					 $r=1;
					 foreach($asignaturas as $asig){ 
					 $it++; 
					 if(($r%2)===0){$bg2="#fff";}else{$bg2="#4ab1dc";}
					 $r++;
					$html2=$html2.'<tr>
					 <td  width="50%" bgcolor="'.$bg2.'">'.$asig["PROG_NOMBRE"].'</td>
					 <td  width="10%" bgcolor="'.$bg2.'">'.$asig["ASIG_CODIGO"].'</td> 
					 <td  width="20%" bgcolor="'.$bg2.'">'.$asig["ASIG_NOMBRE"].'</td> 
					 <td  width="4%" bgcolor="'.$bg2.'">'.$asig["CAAD_NUMUMERO_GRUPOS"].'</td> 
					 <td  width="4%" bgcolor="'.$bg2.'">'.$asig["ASIG_NUMERO_CREDITOS"].'</td>';
                    if($it==1){
					 $html2=$html2.'<td  width="4%" rowspan="'.$num_row.'" bgcolor="#e79e39">'.($rows["HDDIRECTA"]).'</td>
                      <td  width="4%" rowspan="'.$num_row.'" bgcolor="#e79e39">'.($rows["HDDIRECTA"]*4).'</td>
                      <td  width="4%" rowspan="'.$num_row.'" bgcolor="#e79e39">'.($rows["HDDIRECTA"]*16).'</td>';
					  
                     }
					 
					 $html2=$html2.'</tr>';}
					$html2=$html2.'</table>'; }
					  $html2=$html2.'</td>
						<td width="10%"><table border="0" align="center" width="100%">
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
						<td width="10%"><table border="0" align="center" width="100%">
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
echo $html2;


echo '<br/><br/><br/><br/><span style="text-align:center;"><strong></strong></span>';
$html3='<br/> ';
 $dataC=$Cargasacademicas->listadoDocentesC();
 $i=1;
$html3='<div align="center"><b>DOCENTES CATEDRÁTICOS</b></div>
<br/>
<table width="100%" border="1" align="center" bordercolor="#e79e39">
	 <thead>
		 <tr align="center" bgcolor="#e79e39">
			<td width="1%"><b>#</b></td>
			<td width="30%"><b>DETALLE</b></td>
			<td width="40%"><b>DOCENCIA DIRECTA</b></td>
			<td width="10%"><b>INVESTIGACION</b></td>
			<td width="10%"><b>EXTENSION</b></td>
			<td width="3%"><b>THS</b></td>
			<td width="3%"><b>THM</b></td>
			<td width="3%"><b>THS</b></td>
			</tr></thead>';
             foreach($dataC as $rows){
				$PRCA_ID=$rows['PRCA_ID'];
				$Restudios=$Cargasacademicas->estudiosDocentes($PRCA_ID);
				if(($i%2)===0){$bg="#F8E2C7";}else{$bg="#fff";}
					$html3=$html3.'<tr bgcolor="'.$bg.'">
					<td width="1%">'.$i++.'</td>
                    <td width="30%" align="left"><b>'.$rows["FACU_NOMBRE"].'</b><br />
					 No. CEDULA:<b>'.$rows['PERS_IDENTIFICACION'].'</b><br />
                     DOCENTE: <b>'.$rows["NOMBRE_DOCENTE"].'</b><br />
					<b> ESTUDIOS:</b>'.$Restudios.'
					</td>
                   <td width="40%">';
					$asignaturas=$Cargasacademicas->asignaturasDocente($PRCA_ID);
					$num_row=$Cargasacademicas->contarAsignaturas($PRCA_ID);
					if($num_row>0){
				 $html3=$html3.'<table border="0" align="center" width="100%">
                    <thead>
                   <tr>
					 <td width="50%" bgcolor="#e79e39"><b>PROGRAMA</b></td>
					 <td width="10%" bgcolor="#e79e39"><b>CODIGO</b></td> 
					 <td width="20%" bgcolor="#e79e39"><b>ASIGNATURA</b></td> 
					 <td width="4%" bgcolor="#e79e39"><b>#G</b></td> 
					 <td width="4%" bgcolor="#e79e39"><b>IHS</b></td>
					 <td width="4%" bgcolor="#e79e39"><b>THS</b></td>
                      <td width="4%" bgcolor="#e79e39"><b>THM</b></td>
                       <td width="4%" bgcolor="#e79e39"><b>THSE</b></td>
                       </tr>
                       </thead>'; 
					 $it=0; $ihs=0;
					  $r=1;
					 foreach($asignaturas as $asig){ 
					 $it++; 
					 if(($r%2)===0){$bg2="#fff";}else{$bg2="#4ab1dc";}
					 $r++;
					$html3=$html3.'<tr>
					 <td  width="50%" bgcolor="'.$bg2.'">'.$asig["PROG_NOMBRE"].'</td>
					 <td  width="10%" bgcolor="'.$bg2.'">'.$asig["ASIG_CODIGO"].'</td> 
					 <td  width="20%" bgcolor="'.$bg2.'">'.$asig["ASIG_NOMBRE"].'</td> 
					 <td  width="4%" bgcolor="'.$bg2.'">'.$asig["CAAD_NUMUMERO_GRUPOS"].'</td> 
					 <td  width="4%" bgcolor="'.$bg2.'">'.$asig["ASIG_NUMERO_CREDITOS"].'</td>';
                    if($it==1){
					 $html3=$html3.'<td  width="4%" rowspan="'.$num_row.'" bgcolor="#e79e39">'.($rows["HDDIRECTA"]).'</td>
                      <td  width="4%" rowspan="'.$num_row.'" bgcolor="#e79e39">'.($rows["HDDIRECTA"]*4).'</td>
                      <td  width="4%" rowspan="'.$num_row.'" bgcolor="#e79e39">'.($rows["HDDIRECTA"]*16).'</td>';
					  
                     }
					 $html3=$html3.'</tr>';}
					$html3=$html3.'</table>'; }
					  $html3=$html3.'</td>
						<td width="10%"><table border="0" align="center" width="100%">
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
						<td width="10%"><table border="0" align="center" width="100%">
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
echo $html3;
echo '<br/><br/><br/><br/><span style="text-align:center;"><strong></strong></span>';

?>