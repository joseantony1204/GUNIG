<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>
 
 <?php
$this->breadcrumbs=array(
	'Bitacoras'=>array('index'),
	'Crear',
);
?>
<table width="60" border="0" align="left" class="">
  <tr>
    <td>
	<table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"><img src="/APP_FONDO/images/user.png" alt="" /></td>
        <td align="left">
        <strong style="border-bottom-style:groove">PROCESO DE CREACIÒN DE REGISTROS [ BITACORAS  : Nuevo ] </strong></td>
        <td width="80" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, Yii::app()->homeUrl ,$htmlOptions ); 
?>         
		         
        </td>
        <td width="80" align="center">
        <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('acreditacionbitacoras/create',),$htmlOptions ); 
?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
      <td><p><?php echo $this->renderPartial('_form', array('model'=>$model,'model_acredi'=>$model_acredi)); ?></p></td>
</tr>
</table>
