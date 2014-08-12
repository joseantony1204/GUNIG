<?php
$this->breadcrumbs=array(
	'Resoluciones'=>array('index'),
	$model->LIRE_ID,
);

?>

<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"><img src="/APP_FONDO/images/user.png" alt="" /></td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">VISUALIZACIÒN DE REGISTROS [ RESOLUCIONES : Detalles ] </strong></td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/tesoreria/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('tesoreria/libroresoluciones/admin',),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/tesoreria/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('tesoreria/libroresoluciones/view','id'=>$model->LIRE_ID),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/tesoreria/edit.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('tesoreria/libroresoluciones/update','id'=>$model->LIRE_ID),$htmlOptions ); 
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
		'LIRE_ID',		
		'LIRE_CONCEPTO',
		'LIRE_VALOR',
		'LIRE_FECHA',
		//array('name'=>'PERS_ID', 'type'=>'raw', 'value'=>'Personas::getNombrePersona()')
	),
)); ?>    
    
	   
	<?php echo CHtml::link('Subir Archivo (-)', array("tesoreria/escaneados/create", "id"=>$model->LIRE_ID),array('class' => 'thumbnail','rel' => 'tooltip')); ?>

    </td>
  </tr>
</table>
