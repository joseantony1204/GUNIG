<?php if($model!==null){?>
<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
	<tr>
		<td>ECAES_OBSERVACIONES</td>
		<td>GRAD_ANIO</td>
		<td>ECAES_RESULTADOS</td>
        <td>GRAD_SEMESTRE</td>
        <td>TIPO_DOC_UNICO</td>
        <td>CODIGO_ENT_AULA</td>
		<td>SNP</td>
		<td>MUNICIPIO</td>
		<td>IES_CODE</td>
		<td>DEPARTAMENTO</td>
        <td>ACTA</td>
        <td>PRO_CONSECUTIVO</td>
        <td>CODIGO_UNICO</td>
		<td>FOLIO</td>
		<td>FECHA_GRADO</td>
    </tr>
	<?php $x=0; foreach($model as $concepto){ ?> 
    		
			<tr <?php echo ($x++)%2==0?"":"";?>>
				<td> <?php echo $concepto['EGRE_OBSERVACIONESECAES'];?></td>
				<td> <?php echo $concepto['EGRE_ANIOREPORTE'];?></td>
				<td><?php echo $concepto['EGRE_RESULTADOECAES'];?></td>			
                <td style="mso-number-format:'@';"><?php echo $concepto['EGRE_SEMESTREREPORTE'];?></td>
                <td> <?php echo $concepto['TIID_DESCRIPCION'];?></td>
                <td> <?php echo $concepto['EGRE_CODIGOIES'];?></td>
				<td> <?php echo $concepto['EGRE_ECAES'];?></td>
				<td> <?php echo $concepto['MUNI_CODIGO'];?></td>
				<td> <?php echo $concepto['EGRE_CODIGOIES'];?></td>
				<td> <?php echo $concepto['DEPA_ID'];?></td>			
                <td> <?php echo $concepto['EGRE_ACTAGRADO'];?></td>
                <td> <?php echo $concepto['PRSE_PROCONSECUTIVO'];?></td>
				<td style="mso-number-format:'@';"><?php echo $concepto['EGRE_NUMEROIDENTIFICACION'];?></td>				
                <td> <?php echo $concepto['EGRE_FOLIO'];?></td>
				<td style="mso-number-format:'@';"><?php echo $concepto['FEGR_FECHA'];?></td>
                
				</tr>
	<?php } ?>    
    		   
</table>
<?php } ?>