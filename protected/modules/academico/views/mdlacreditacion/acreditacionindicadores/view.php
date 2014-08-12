<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>
<?php
$this->breadcrumbs=array(
	'Indicadores'=>array('index'),
	$model->ACIN_ID,
);

?>

<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"><img src="/APP_FONDO/images/user.png" alt="" /></td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">VISUALIZACIÒN DE REGISTROS [ INDICADORES : Detalles ] </strong></td>
        <td width="80" align="center"><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/indicadores.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Indicadores');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlacreditacion/acreditacionindicadores/create',),$htmlOptions ); 														 														?>
      </td>
      
      <td width="80" align="center"><?php

         
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
         echo CHtml::link($image, array('acreditacionindicadores/view','id'=>$model->ACIN_ID),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/edit.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('acreditacionindicadores/update','id'=>$model->ACIN_ID),$htmlOptions ); 
?>         
		 </td>
		
		<td width="80" align="center"><?php $imageUrl = Yii::app()->request->baseUrl . '/images/academico/acreditacion/soportes.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Soportes');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlacreditacion/acreditacionsoportes/create','INDICADOR'=>$model->ACIN_ID),$htmlOptions ); 														 														?>
      </td>

      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'ACIN_ID',
		'ACIN_NUMERO',
		'ACIN_DESCRIPCION',
		'ACAS_ID',
	),
)); ?>    
    
    </td>
  </tr>
</table>
