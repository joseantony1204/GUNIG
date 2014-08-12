<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/gestiondocumental/archivocpanel/index');
$this->breadcrumbs=array(
	'Modulo Gestión Documental'=>array('/gestiondocumental/'),
	'Panel De Archivo'=>array('archivocpanel/'),
	'Admininistrar',
);
?>
<table width="56%" border="0" align="center">
  <tr>
    <td height="172" align="center">
    <fieldset>
    <table  width="100%" border="0">
  	<tr>
    <td width="18%" height="75%" align="left">    </td>
    <td width="64%" height="75%" align="center">  
    <h4><?php echo "PANEL GESTION DOCUMENTAL - ARCHIVO"; ?></h4>    </td>
    <td width="5%" height="10%" align="right">&nbsp;</td>
    <td width="13%" height="10%" align="right"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al panel principal GESTIÓN DOCUMENTAL');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/gestiondocumental',),$htmlOptions ); 
	?></td>  
	</tr>
	</table>
    <fieldset>
   <table width="98%" height="115" border="0" align="center">
                      <tr>
                        <th colspan="5"><hr /></th>
                      </tr>
                      <tr align="center">
                        <td width="22%" height="21" >
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/archivo/interno.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'RADICADOS INTERNOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('rcdarchivo/radicadosinternos/admin',),$htmlOptions ); 
	?></td>
                        <td width="15%" scope="col">&nbsp;</td>
                        <td width="27%" scope="col">
						<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/archivo/externo.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'RADICADOS EXTERNOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('rcdarchivo/radicadosexternos/admin',),$htmlOptions ); 
	?></td>
                        <td width="14%" scope="col">&nbsp;</td>
                        <td width="22%" scope="col">
	
						<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/archivo/persdepe.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'PERSONAS POR DEPENDENCIAS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('rcdarchivo/persnatudependencias/admin',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="19" colspan="5"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/archivo/entes.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'ENTES EXTERNOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('rcdarchivo/entesexternos/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
                        <?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/archivo/cargos.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'CARGOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('rcdarchivo/cargos/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/archivo/correo.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'EMPRESAS DE CORREOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('rcdarchivo/empresascorreos/admin',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="19" colspan="5"><hr /></td>
                      </tr>
					   <tr>
                         <td height="21" align="center">
                         
                         <td align="center">&nbsp;</td>
                         <td align="center">
                         
                         <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/archivo/mensajeros.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'MENSAJEROS UNIGUAJIRA');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('rcdarchivo/mensajeros/admin',),$htmlOptions ); 
	?></td>
      </table> 
    </fieldset>    
  
</table>
