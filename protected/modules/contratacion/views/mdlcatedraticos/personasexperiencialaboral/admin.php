<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('catedraticoscpanel/'),
	'Personas Naturales'=>array('mdlcatedraticos/personasnaturales/admin'),
	'Hoja de vida'=>array('mdlcatedraticos/personasnaturales/view', 'id'=>$Personasnaturales->PENA_ID),
	'Experiencia Laboral'=>array('admin','id'=>$model->PERS_ID),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Personasexperiencialaboral','url'=>array('index')),
	array('label'=>'Create Personasexperiencialaboral','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('personasexperiencialaboral-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE EXPERIENCIA LABORAL</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/personasnaturales/view','id'=>$Personasnaturales->PENA_ID),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/personasexperiencialaboral/admin','id'=>$model->PERS_ID),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/personasexperiencialaboral/create','id'=>$model->PERS_ID),$htmlOptions ); 
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
	'id'=>'personasexperiencialaboral-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		'PEEL_EMPRESA',
		array('name'=>'PEEL_TELEFONOEMPRESA', 'value'=>'$data->PEEL_TELEFONOEMPRESA','htmlOptions'=>array('width'=>'150'),),
		'PEEL_CARGO',
		array('name'=>'PEEL_FECHAINICIO', 'value'=>'$data->PEEL_FECHAINICIO','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'PEEL_FECHAFINAL', 'value'=>'$data->PEEL_FECHAFINAL','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'PEEL_ACTUALMENTE', 'value'=>'$data->PEEL_ACTUALMENTE','htmlOptions'=>array('width'=>'200'),),		
   
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
