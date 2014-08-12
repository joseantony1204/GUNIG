<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>
<?php
$this->breadcrumbs=array(
	'Caracteristicas'=>array('index'),
	$model->ACCA_ID,
);

?>

<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"><img src="/APP_FONDO/images/user.png" alt="" /></td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">VISUALIZACIÒN DE REGISTROS [ CARACTERISTICAS : Detalles ] </strong></td>
         <td width="80" align="center"><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/caracteristicas.png';
			 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Caracteristicas');
			 $image = CHtml::image($imageUrl);
			 echo CHtml::link($image, array('mdlacreditacion/acreditacioncaracteristicas/create',),$htmlOptions ); 
		?></td> <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, Yii::app()->homeUrl ,$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('acreditacioncaracteristicas/view','id'=>$model->ACCA_ID),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php
		 $imageUrl = Yii::app()->request->baseUrl . '/images/edit.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('acreditacioncaracteristicas/update','id'=>$model->ACCA_ID),$htmlOptions ); 
?>         
		 </td>
        
         <td width="80" align="center"><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/aspectos.png';
			 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Aspectos');
			 $image = CHtml::image($imageUrl);
			 echo CHtml::link($image, array('mdlacreditacion/acreditacionaspectos/create','CARACTERISTICA'=>$model->ACCA_ID),$htmlOptions ); 											
		?></td>
         </tr>
    </table></td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ACCA_ID',
		'ACCA_NUMERO',
		'ACCA_DESCRIPCION',
		'ACFA_ID',
	),
)); ?>    
    
    </td>
  </tr>
</table>
