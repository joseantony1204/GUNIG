<?php
$this->breadcrumbs=array(
	'Modulo Financiero'=>array('/financiero/'),
	'cpanel Liquidaciones'=>array('liquidacionescpanel/'),
	'Cuentas'=>array('segcuenta/cuentas/admin'),
	'Liquidaciones'=>array('liquidaciones/admin','id'=>$model->CUEN_ID),
	'Modulos de Liquidaciones',
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
        <strong style="border-bottom-style:groove">PROCESO DE CREACIÒN DE REGISTROS [ 
		LIQUIDACIONES  : Nuevo ] </strong></td>
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
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/liquidaciones/create','id'=>$liquidaciones->CUEN_ID),$htmlOptions ); 
?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  
  
  <tr>
    <td><p><?php echo $this->renderPartial('_form',array(
	                                       'Liquidaciones'=>$liquidaciones,
										   'Liquidacionesdescuentos'=>$liquidacionesdescuentos,));
		    ?></p></td>
  </tr>
  
</table>
