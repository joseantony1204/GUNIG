<?php if($model!==null){?>
<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
	<tr>
		<th>CC o NIT</th>
		<th>NOMBRES </th>
		<th>FECHA DE LIQUIDACION</th>
        <th>CUENTA</th>
        <th>FECHA DE INICIO</th>
        <th>FECHA FINAL</th>
		<th>VALOR</th>
        
	</tr>
	<?php $x=0; $Total=0;	foreach($model as $concepto){ 	$Total = $Total + $concepto['CUEN_VALOR'];?> 
    		
			<tr <?php echo ($x++)%2==0?"":"";?>>
				<td> <?php echo $concepto['PERS_IDENTIFICACION'];?></td>
				<td> <?php echo $concepto['NOMBRE'];?></td>
				<td> <?php echo $concepto['LIQU_FECHA'];?></td>			
                <td> <?php echo $concepto['CUEN_ID'];?></td>
                <td> <?php echo $concepto['CUEN_FECHAINICIO'];?></td>
                <td> <?php echo $concepto['CUEN_FECHAFINAL'];?></td>
				<td> <?php echo $concepto['CUEN_VALOR'];?></td>
                
			</tr>
	<?php } ?>    
    		<tr>				
                <td colspan="5"></td>
                <td width="123" align="right"><strong>TOTAL</strong></td>
                <td align="right" width="121"><strong><?php echo $Total;?></strong></td>
			</tr>   
</table>
<?php } ?>
