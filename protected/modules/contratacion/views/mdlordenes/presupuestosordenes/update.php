<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/ordenescpanel/index'),
	
	'Actualizar',
);
?>
<table width="60" border="0" align="left" class="">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"><?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
			  echo $image = CHtml::image($imageUrl);
		    ?></td>
        <td align="left">
        <strong style="border-bottom-style:groove">PROCESO DE ACTUALIZACIÒN DE REGISTROS [ 
		CDP  : Editar ] </strong></td>
        <td width="80" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/presupuestosordenes/admin','id'=>$Presupuestosordenes->MOOR_ID),$htmlOptions ); 
?>         
		         
        </td>
        <td width="80" align="center">
        <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Actualizaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/presupuestosordenes/update','id'=>$Presupuestosordenes->PROR_ID),$htmlOptions ); 
?>         
		          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><?php echo $this->renderPartial('_form', array(
														'Presupuestos'=>$Presupuestos,
														 'Modeloordenes'=>$Modeloordenes,
														 'Presupuestosordenes'=>$Presupuestosordenes,)); 
															?></p></td>
  </tr>
</table>
