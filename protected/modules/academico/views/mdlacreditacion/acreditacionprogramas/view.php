<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>
<?php
$this->breadcrumbs=array(
	'Programas'=>array('index'),
	$model->ACPR_ID,
);


?>

<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"><img src="/APP_FONDO/images/user.png" alt="" /></td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">VISUALIZACIÒN DE REGISTROS [ PROGRAMAS : Detalles ] </strong></td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, Yii::app()->homeUrl,$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('acreditacionprogramas/view','id'=>$model->ACPR_ID),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/edit.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('acreditacionprogramas/update','id'=>$model->ACPR_ID),$htmlOptions ); 
?>         
		 </td>
         
        <td width="80" align="center"><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/programas.png';
        $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Informacion Base');
        $image = CHtml::image($imageUrl);
        echo CHtml::link($image, array('mdlacreditacion/acreditacionprogramas/create',),$htmlOptions ); 											
        ?></td>
        
        <td width="80" align="center"><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/bitacoras.png';
        $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Bitacoras');
        $image = CHtml::image($imageUrl);
        echo CHtml::link($image, array('mdlacreditacion/acreditacionbitacoras/create','PROGRAMA'=>$model->ACPR_ID,),$htmlOptions ); 
        ?></td>        
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ACPR_ID',
		'ACPR_NOMBRE',
		//'FACU_ID',
	),
)); ?>    
    
    </td>
  </tr>
</table>
