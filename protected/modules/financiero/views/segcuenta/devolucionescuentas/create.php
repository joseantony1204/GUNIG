<?php
Yii::app()->homeUrl = array('/financiero/');
$this->breadcrumbs=array(
	'Modulo Gestión Finanzas'=>array('/financiero/'),
	'Contratos'=>array('segcuenta/contratos/admin'),
	'Cuentas'=>array('segcuenta/cuentas/admin','id'=>$Cuentas->CONT_ID),
	'Seguimiento Cuenta'=>array('segcuenta/seguimientocuentas/admin','id'=>$Seguimientocuentas->CUEN_ID),
	'Devoluciones de Cuentas'=>array('admin','id'=>$model->SECU_ID),
	'Crear',
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
		DEVOLUCIONESCUENTAS  : Nuevo ] </strong></td>
        <td width="80" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/devolucionescuentas/admin','id'=>$model->SECU_ID),$htmlOptions ); 
?>         
		         
        </td>
        <td width="80" align="center">
        <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/devolucionescuentas/create','id'=>$model->SECU_ID),$htmlOptions ); 
?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form', array('model'=>$model,)); ?></p></td>
  </tr>
</table>
