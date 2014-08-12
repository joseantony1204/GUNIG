<?php if($model!==null){?>
<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
	<tr>
		<td>IES_CODE</td>
		<td> </td>
		<td>TIPO_DOC_UNICO</td>
		<td>CODIGO_UNICO</td>
        <td>PRO_CONSECUTIVO</td>
        <td>ANIO</td>
        <td>SEMESTRE</td>
		<td>ES_TRANSFERENCIA</td>
	</tr>
	
	<tr>
		<td>Código de la IES</td>
		<td>Tipo de Identificación del estudiante</td>
		<td>Tipo de Identificación del estudiante</td>
        <td>Número de Identificación del estudiante</td>
        <td>Proconsecutivo del programa</td>
        <td>Anio de ingreso del programa</td>
		<td>Semestre de ingreso del programa</td>
		<td>Valor que determina si el estudiante ingreso al programa de  
		transferencia externa</td>
    </tr>
	<?php $x=0; foreach($model as $concepto){ ?> 
    		
			<tr <?php echo ($x++)%2==0?"":"";?>>
				<td> <?php echo $concepto['EGRE_CODIGOIES'];?></td>
				<td> <?php echo $concepto['TIID_NOMBRE'];?></td>
				<td><?php echo $concepto['TIID_DESCRIPCION'];?></td>			
                <td><?php echo $concepto['PRSE_PROCONSECUTIVO'];?></td>
                <td> <?php echo $concepto['TIID_DESCRIPCION'];?></td>
                <td> <?php echo $concepto['ANAC_ID'];?></td>
				<td> <?php echo $concepto['EGRE_SEMESTREINGRESO'];?></td>
				<td> <?php echo $concepto['EGRE_TRANSFERENCIA'];?></td>
				                
			</tr>
	<?php } ?>    
    		   
</table>
<?php } ?>