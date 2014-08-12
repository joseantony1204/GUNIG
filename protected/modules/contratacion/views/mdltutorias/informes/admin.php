<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/contratacion/opscpanel/index');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('tutoriascpanel/'),
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
   <table width="98%" height="64" border="0" align="center">
                      <tr align="center">
                        <td width="31%" height="21" >
                        <?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_inf_contratoria.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informe de Contratatación para la Contraloría');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/informes/contraloria',),$htmlOptions ); 
	?></td>
                        <td width="38%" scope="col">&nbsp;</td>
                        <td width="31%" scope="col">
                        <?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_inf_gen.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informe de contratacíon General');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/informes/general',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="14" colspan="3"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_inf_programas.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informe de contratacíon asignado por dependencias');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/informes/dependencias',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_inf_est.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informe de Personal Con Estudios');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/informes/estudios',),$htmlOptions ); 
	?></td>
                      </tr>
        </table> 
    </fieldset>
    </td>
  </tr>
  <tr>
    <td height="21">
    <fieldset>
    <table width="100%" border="0" align="center">
      <tr>      
        <td width="225" align="left">&nbsp;</td>
        <td width="256" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver CONTRATACION OPS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/contratacion/tutoriascpanel/',),$htmlOptions ); 
	?></td>
        <td width="226" align="center">&nbsp;</td>
        </tr>
    </table>
    </fieldset>
    </td>
  </tr>
</table>
