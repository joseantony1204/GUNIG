<?php
$this->breadcrumbs=array(
	'Modulo Financiero'=>array('/financiero/'),
	'cpanel Descuentosatributos'=>array('descuentosatributoscpanel/'),
	'Descuentos Atributos'=>array('descuentos/admin'),
	'Atributos del Descuento'=>array('descuentosatributos/detail','id'=>$model->DESC_ID),
	'Modulos de Atributos de Descuentos',
);
?>
<table width="60" border="0" align="left" class="">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
       <td width="6%" align="center">
             	<?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl); ?>
              </td>
        <td align="left">
        <strong style="border-bottom-style:groove">PROCESO DE CREACIÒN DE REGISTROS [Nuevo: <?php echo $model->dESC->DESC_NOMBRE; ?>] </strong></td>
        <td width="80" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         
		 echo CHtml::link($image, array('segcuenta/descuentosatributos/detail','id'=>$model->DESC_ID),$htmlOptions );  
?>         
		         
        </td>
        <td width="80" align="center">
        <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/descuentosatributos/create','id'=>$model->DESC_ID),$htmlOptions ); 
?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    
    <td><p><?php echo $this->renderPartial('_form', array('model'=>$model,'Descuentosatributos'=>$Descuentosatributos)); ?></p></td>
  </tr>
</table>
