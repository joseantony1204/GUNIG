<?php
Yii::app()->homeUrl = array('/contratacion/opscpanel/index');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('tutoriascpanel/'),
	'Administración de Informes'=>array('admin'),
	'Diseñar Informe'
);

?>
<table width="60" border="0" align="left" class="">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left">
        <?php 			 
		$imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
		echo $image = CHtml::image($imageUrl); 
	    ?> 
        </td>
        <td align="left">
        <strong style="border-bottom-style:groove">PROCESO DE CREACIÓN DE INFORMES [ 
		Contraloria ] </strong></td>
        <td width="80" align="center">
         <?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/informes/admin',),$htmlOptions ); 
         ?>         
		         
        </td>
        <td width="80" align="center">
        <?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/informes/contraloria'),$htmlOptions ); 
         ?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form',array(
	                                       'Tutoriascontratos'=>$Tutoriascontratos,
										   'Informes'=>$Informes,
										   ));
	?></p></td>
  </tr>
</table>
