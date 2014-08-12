<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/contratacion/opscpanel/index');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('opscpanel/'),
	'Administración de Informes',
);
?>
<table width="60%" border="0" align="left">
  <tr>
    <td height="21" align="center">
    <fieldset>
    <h4><?php echo "VISOR DE INFORMES DE ORDENES DE PRESTACIÓN DE SERVICIOS"; ?></h4>
    </fieldset>
    </td>
  </tr>
  <tr>
    <td height="21">
    <fieldset>
   <table width="98%" height="91" border="0" align="center">
                      <tr>
                        <th height="17" colspan="5"><hr /></th>
                      </tr>
                      <tr align="center">
                        <td width="26%" height="21" >
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_inf_contratoria.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informe de Contratatación para la Contraloría');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/informes/contraloria',),$htmlOptions ); 
	?></td>
                        <td width="10%" scope="col">&nbsp;</td>
                        <td width="30%" scope="col">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_inf_depend.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informe de contratacíon asignado por dependencias');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/informes/dependencias',),$htmlOptions ); 
	?></td>
                        <td width="9%" scope="col">&nbsp;</td>
                        <td width="25%" scope="col">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_inf_gen.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informe de contratacíon General');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/informes/general',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="14" colspan="5"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver CONTRATACION OPS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/contratacion/opscpanel/',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="6" colspan="5"><hr /></td>
                      </tr>
        </table> 
    </fieldset>
    </td>
  </tr>
</table>
