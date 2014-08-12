<?php
$this->breadcrumbs=array(
	'Persnatudependencias'=>array('index'),
	$model->PEND_ID,
);

?>

<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"><?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?></td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">VISUALIZACIÒN DE REGISTROS [PERSONAS POR DEPENDENCIAS: Detalles] </strong></td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/persnatudependencias/admin',),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/persnatudependencias/view','id'=>$model->PEND_ID),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/edit.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/persnatudependencias/update','id'=>$model->PEND_ID),$htmlOptions ); 
?>         
		 </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'PEND_ID',	
		array('name'=>'PERSONA', 'value'=>$model->rel_personasnaturales->PENA_NOMBRES . " ". $model->rel_personasnaturales->PENA_APELLIDOS),
		//'PENA_ID',
		array('name'=>'DEPENDENCIA', 'value'=>$model->dEPE->DEPE_NOMBRE),
		//'DEPE_ID',
		array('name'=>'CARGO', 'value'=>$model->cARG->CARG_NOMBRE),
		//'CARG_ID',
	),
)); ?>    
    
    </td>
  </tr>
</table>
