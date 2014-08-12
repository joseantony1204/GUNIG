<?php
$this->breadcrumbs=array(
	'Radicadosinternos'=>array('index'),
	$model->RAIN_ID,
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
        <td width="498" align="left"><strong style="border-bottom-style:groove">VISUALIZACIÒN DE REGISTROS [RADICADOSINTERNOS: Detalles] </strong></td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/radicadosinternos/admin',),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/radicadosinternos/view','id'=>$model->RAIN_ID),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 /*$imageUrl = Yii::app()->request->baseUrl . '/images/edit.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('radicadosinternos/update','id'=>$model->RAIN_ID),$htmlOptions ); */
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
		'RAIN_ID',
		'RAIN_FECHA',
		'RAIN_ASUNTO',
		'RAIN_NUMEROANEXOS',
		'RAIN_ESCANEORUTA',
		'RAIN_ESTADO',
		'RAIN_TIPO',
		'RAIN_UBICACION',
		//array('name'=>'RESPONSABLE DE ENTREGA', 'value'=>$model->mENS->rel_personasnaturales->PENA_NOMBRES. " ". $model->mENS->rel_personasnaturales->PENA_APELLIDOS),
		
		//array('name'=>'DEPENDENCIA', 'value'=>$model->dEPE->DEPE_NOMBRE),
		//'MENS_ID',
	),
)); ?>    
    
    </td>
  </tr>
</table>
