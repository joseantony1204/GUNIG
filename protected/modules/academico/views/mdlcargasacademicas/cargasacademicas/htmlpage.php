<?php   
$Rtipos= Cargasacademicas::model()->tipos();
 foreach($Rtipos as $tipos){
 $tipo=$tipos["TICD_ID"];
 $data=Cargasacademicas::model()->listadoDocentes($tipo);
 $i=1;
?>
<div align="center"><b><?php echo $tipos["TICD_NOMBRE"];?></b></div>
<br/>
 <table width='100%' border='1' align='center'>
	 <thead>
		  <tr>
			<td width='1%'>#</td>
			<td>DETALLE</td>
			<td width='50%'>DOCENCIA DIRECTA</td>
			<td>INVESTIGACION</td>
			<td>EXTENSION</td>
			<td>THS</td>
			<td>THM</td>
			<td>THS</td>
			</tr></thead>
              <?php
			foreach($data as $rows){
				$PRCA_ID=$rows['PRCA_ID'];
				$Restudios=Cargasacademicas::model()->estudiosDocentes($PRCA_ID);
				?><tr>
					<td width='1%'><?php echo $i++ ?></td>
                    <td width='30%'><b><?php echo $rows["FACU_NOMBRE"];?></b><br />No. CEDULA:  <b><?php echo $rows['PERS_IDENTIFICACION'];?></b><br />
                    DOCENTE: <b><?php echo $rows["NOMBRE_DOCENTE"];?></b><br />
                    ESTUDIOS: <b> <?php foreach($Restudios as $estudios){
						echo   $estudio .=$estudios["ESTU_NOMBRE"].', '; }?></b>
                   </td>
                   <td width='30%'>
					<?php $asignaturas=Cargasacademicas::model()->asignaturasDocente($PRCA_ID);
					$num_row=Cargasacademicas::model()->contarAsignaturas($PRCA_ID);
					if($num_row>0){?>
				  <table border='1' align='center' width='100%'>
                    <thead>
                  <tr>
					 <td>PROGRAMA</td>
					 <td>CODIGO</td> 
					 <td>ASIGNATURA</td> 
					 <td>#G</td> 
					 <td>IHS</td>
					 <td>THS</td>
                      <td>THM</td>
                       <td>THSE</td>
                       </tr>
                       </thead>
                	 <?php 
					 $it=0; $ihs=0;
					 foreach($asignaturas as $asig){ 
					 $it++; 
					 ?>
					 <tr>
					 <td><?php echo $asig["PROG_NOMBRE"] ?></td>
					 <td><?php echo $asig["ASIG_CODIGO"]?></td> 
					 <td><?php echo $asig["ASIG_NOMBRE"]?></td> 
					 <td><?php echo $asig["CAAD_NUMUMERO_GRUPOS"]?></td> 
					 <td><?php echo $asig["ASIG_NUMERO_CREDITOS"]?></td>
                     <?php 
					 if($it==1){?>
					  <td rowspan="<?php echo $num_row?>"><?php echo ($rows["HDDIRECTA"]);?></td>
                      <td rowspan="<?php echo $num_row?>"><?php echo ($rows["HDDIRECTA"]*4);?></td>
                      <td rowspan="<?php echo $num_row?>"><?php echo ($rows["HDDIRECTA"]*16);?></td>
                      <?php }?>
					 </tr> <?php }?>
					</table>
					<?php }?>
					   </td>
						<td><table border='1' align='center' width='100%'>
                    <thead>
                  <tr>
					 <td>THS</td> 
					 <td>THM</td> 
					 <td>THSE</td> 
					 </tr>
                       </thead>
                	 <tr>
					 <td><?php echo ($rows["HINVESTIGACION"]); ?></td>
					 <td><?php echo ($rows["HINVESTIGACION"]*4);?></td> 
					 <td><?php echo ($rows["HINVESTIGACION"]*16);?></td> 
					 </tr>
					</table></td>
						<td><table border='1' align='center' width='100%'>
                    <thead>
                  <tr>
					 <td>THS</td> 
					 <td>THM</td> 
					 <td>THSE</td> 
					 </tr>
                       </thead>
                	 <tr>
					 <td><?php echo $rows["HEXTENSION"]; ?></td>
					 <td><?php echo ($rows["HEXTENSION"]*4);?></td> 
					 <td><?php echo ($rows["HEXTENSION"]*16);?></td> 
					 </tr>
					</table></td>
						<td><?php echo ($rows["HDDIRECTA"]+$rows["HINVESTIGACION"]+$rows["HEXTENSION"]); ?></td>
						<td><?php echo ($rows["HDDIRECTA"]+$rows["HINVESTIGACION"]+$rows["HEXTENSION"])*4; ?></td>
						<td><?php echo ($rows["HDDIRECTA"]+$rows["HINVESTIGACION"]+$rows["HEXTENSION"])*16; ?></td>
						</tr>
			<?php  }?>
</table>
	  		
  
  <?php }
  
?>