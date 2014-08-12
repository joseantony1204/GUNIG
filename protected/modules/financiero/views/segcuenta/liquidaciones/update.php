<?php
	$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/financiero/'),
	'cpanel Tutorias'=>array('liquidacionescpanel/'),
	'Personas Naturales'=>array('admin'),
	'Actualizar',
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
        <strong style="border-bottom-style:groove">PROCESO DE ACTUALIZACIÒN DE REGISTROS [ 
		LIQUIDACIONES  : Editar ] </strong></td>
        <td width="80" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/cuentas/admin','id'=>$liquidaciones->cUEN->CONT_ID),$htmlOptions ); 
?>         
		         
        </td>
        <td width="80" align="center">
        <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Actualizaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/liquidaciones/update','id'=>$liquidaciones->LIQU_ID),$htmlOptions ); 
?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form', array( 'Liquidaciones'=>$liquidaciones,
										   'Liquidacionesdescuentos'=>$liquidacionesdescuentos)); ?></p></td>
  </tr>
</table>
