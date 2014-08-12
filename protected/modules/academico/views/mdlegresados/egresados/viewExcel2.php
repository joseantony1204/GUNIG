<?php if($model!==null){?>
<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
	<tr>	
	<td>IES_CODE</td>
    <td></td>
    <td>TIPO_DOC_UNICO</td>
    <td>CODIGO_UNICO</td>
    <td></td>
    <td>TIPO_ID_ANT</td>
    <td>CODIGO_ID_ANT</td>
    <td>PRIMER_NOMBRE</td>
    <td>SEGUNDO_NOMBRE</td>
    <td>PRIMER_APELLIDO</td>
    <td>SEGUNDO_APELLIDO</td>
	<td></td>
    <td>GENERO_CODE</td>
    <td></td>
    <td>COD_IDENTIFIC</td>
    <td>DOCUMENTO</td>
    <td></td>
    <td>EST_CIVIL_CODE</td>
    <td>FECHA_NACIM</td>
	<td></td>
    <td>PAIS_LN</td>
    <td></td>
    <td>DEPARTAMENTO_LN</td>
	<td></td>
    <td>MUNICIPIO_LN</td>
    <td>PAIS_TEL</td>
    <td>AREA_TEL</td>
    <td>NUMERO_TEL</td>
    <td>EMAIL</td>	
	</tr>
	
	<tr>
	<td>Codigo de la IES.</td>
    <td>Clase de Identificacion Principal</td>
    <td>Tipo de Identificacion Principal</td>
    <td>Numero de Identificacion Principal</td>
    <td>Clase de Identificacion Anterior</td>
    <td>Tipo de Identificacion Anterior</td>
    <td>Numero de Identificacion Anterior</td>
    <td>Primer Nombre</td>
    <td>Segundo Nombre</td>
    <td>Primer Apellido</td>
    <td>Segundo Apellido</td>
    <td>GENERO</td>
    <td>Codigo Genero</td>
    <td>Clase de Identificacion Secundaria</td>
    <td>Tipo de Identificacion Secundaria</td>
    <td>Numero de Identificaci&oacute;n Sec.</td>
    <td>ESTADO CIVIL</td>
    <td>Estado Civil.</td>
    <td>Fecha de Nacimiento</td>
    <td>PAIS</td>
    <td>Codigo del pais de Nacimiento.</td>
    <td>DEPARTAMENTO</td>
    <td>Codigo del Departamento de nacimiento.</td>
    <td>MUNICIPIO</td>
    <td>Codigo del Municipio de Nacimiento.</td>
    <td>Indicativo del pais;</td>
    <td>Indicativo del area</td>
    <td>Numero telefonico</td>
    <td>Email de la persona</td>
    </tr>
	
	<?php $x=0; foreach($model as $concepto){ ?> 
    		
			<tr <?php echo ($x++)%2==0?"":"";?>>
				<td> <?php echo $concepto['EGRE_CODIGOIES'];?></td>
				<td> <?php echo $concepto['TIID_NOMBRE'];?></td>
				<td> <?php echo $concepto['TIID_DESCRIPCION'];?></td>			
                <td> <?php echo $concepto['EGRE_NUMEROIDENTIFICACION'];?></td>
                <td> <?php echo $concepto['TIID_NOMBRE'];?></td>
				<td> <?php echo $concepto['TIID_DESCRIPCION'];?></td>
				<td> <?php echo $concepto['EGRE_NUMEROIDENTIFICACION'];?></td>
				<td> <?php echo $concepto['EGRE_PRIMERNOMBRE'];?></td>
				<td> <?php echo $concepto['EGRE_SEGUNDONOMBRE'];?></td>
				<td> <?php echo $concepto['EGRE_PRIMERAPELLIDO'];?></td>			
                <td> <?php echo $concepto['EGRE_SEGUNDOAPELLIDO'];?></td>
                <td> <?php echo $concepto['SEXO_NOMBRE'];?></td>
                <td> <?php echo $concepto['SEXO_ID'];?></td>
				<td> <?php echo $concepto['TIID_NOMBRE'];?></td>
				<td> <?php echo $concepto['TIID_DESCRIPCION'];?></td>
				<td> <?php echo $concepto['EGRE_NUMEROIDENTIFICACION'];?></td>			
                <td> <?php echo $concepto['ESCI_NOMBRE'];?></td>
                <td> <?php echo $concepto['ESCI_ID'];?></td>
                <td> <?php echo $concepto['EGRE_FECHANACIMIENTO'];?></td>
				<td> <?php echo $concepto['EGRE_SEMESTREINGRESO'];?></td>
				<td> <?php echo $concepto['PAIS_NOMBRE'];?></td>
				<td> <?php echo $concepto['PAIS_DESCRIPCION'];?></td>
				<td> <?php echo $concepto['DEPA_NOMBRE'];?></td>
				<td> <?php echo $concepto['DEPA_ID'];?></td>			
                <td> <?php echo $concepto['MUNI_NOMBRE'];?></td>
                <td> <?php echo $concepto['MUNI_CODIGO'];?></td>
                <td> <?php echo $concepto['PAIS_INDICATIVO'];?></td>
				<td> <?php echo $concepto['DEPA_INDICATIVOAREA'];?></td>
				<td> <?php echo $concepto['EGRE_TELEFONO'];?></td>               
			</tr>
	<?php } ?>    
    		   
</table>
<?php } ?>