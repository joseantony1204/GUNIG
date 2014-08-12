<?php
$this->breadcrumbs=array(
	'Radicadosexternos'=>array('index'),
	$model->RAEX_ID,
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
        <td width="498" align="left"><strong style="border-bottom-style:groove">VISUALIZACIÒN DE REGISTROS [RADICADOS EXTERNOS: Detalles] </strong></td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/radicadosexternos/admin',),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/radicadosexternos/view','id'=>$model->RAEX_ID),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		/* $imageUrl = Yii::app()->request->baseUrl . '/images/edit.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('radicadosexternos/update','id'=>$model->RAEX_ID),$htmlOptions ); */
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
		'RAEX_ID',
		'RAEX_FECHARECIBIDO',
		'RAEX_GUIAENVIO',
		'RAEX_NUMERODOCUMENTO',
		'RAEX_FECHADOCUMENTO',
		'RAEX_ASUNTO',
		'RAEX_NUMEROANEXOS',
		'RAEX_ESCANEORUTA',
		'RAEX_ESTADO',
		array('name'=>'EMPRESA DE CORREO', 'value'=>$model->eMCO->EMCO_NOMBRE),
		//array('name'=>'RESPONSABLE DE ENTREGA', 'value'=>$model->mENS->rel_personasnaturales->PENA_NOMBRES. " ". $model->mENS->rel_personasnaturales->PENA_APELLIDOS),
		//'EMCO_ID',
	),
)); ?>    
    
    </td>
  </tr>
</table>
