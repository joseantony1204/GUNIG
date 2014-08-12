<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Personas Naturales'=>array('mdlops/personasnaturales/admin'),
	'Hoja de vida'=>array('mdlops/personasnaturales/view', 'id'=>$Personasnaturales->PENA_ID),
	'Educacion Continua'=>array('admin','id'=>$model->PERS_ID),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Hdveducacioncontinua','url'=>array('index')),
	array('label'=>'Create Hdveducacioncontinua','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hdveducacioncontinua-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="100%" border="0" align="center">
  <tr>
    <td><table width="100%" border="0" align="center">
      <tr>
        <td>
        <fieldset>
          <table width="100%" border="0" align="center">
            <tr>
              <td width="6%" align="center">
              <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE EDUCACION CONTINUA</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/personasnaturales/view','id'=>$Personasnaturales->PENA_ID,),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/hdveducacioncontinua/admin','id'=>$model->PERS_ID),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/hdveducacioncontinua/create','id'=>$model->PERS_ID),$htmlOptions ); 
?>         
		 </td>
            </tr>
          </table>
          </fieldset>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'hdveducacioncontinua-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		'HECO_NOMBRE',
		'HECO_LUGAR',
		'HECO_FECHATERMINACION',
		array(
			'name'=>'HECO_RUTA',
					'type'=>'raw',
					'htmlOptions'=>array('style'=>'text-align: center','width'=>'100'),
					'value'=>'CHtml::link("Ver Documento", Yii::app()->baseUrl.$data->HECO_RUTA, array("target"=>"_blank"))',					  
			 ),	
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
