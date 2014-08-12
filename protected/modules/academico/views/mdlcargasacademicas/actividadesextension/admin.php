<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel Carga Académica'=>array('cargasacademicascpanel/'),
	'Actividades de Extensión'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Actividadesextension','url'=>array('index')),
	array('label'=>'Create Actividadesextension','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('actividadesextension-grid', {
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
              <td width="6%" align="center"><?php  
			  $imageUrl = Yii::app()->request->baseUrl . '/images/academico/actividadesextension.png';
			   echo $image = CHtml::image($imageUrl);?></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE ACTIVIDADES DE EXTENSION</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('cargasacademicascpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/actividadesextension/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/actividadesextension/create',),$htmlOptions ); 
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
   <td colspan="2">
<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
   </td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'actividadesextension-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		/*'ACEX_ID',
		'ACEX_ACTIVIDAD_EXTENCION',
		'ACEX_HORAS_DEDICACION_SEMANAL',
		'PEAC_ID',*/
	array('name'=>'ACEX_ID', 'value'=>'$data->ACEX_ID', 'htmlOptions'=>array('width'=>'4'),),
	array('name'=>'PENA_ID', 'value'=>'$data->rel_pernaturales->nombreCompleto', 'filter'=>$model->getPersonas(),'htmlOptions'=>array('width'=>'300'),),
	array('name'=>'ACEX_ACTIVIDAD_EXTENCION', 'value'=>'$data->ACEX_ACTIVIDAD_EXTENCION', 'htmlOptions'=>array('width'=>'400'),),
		array('name'=>'ACEX_HORAS_DEDICACION_SEMANAL', 'value'=>'$data->ACEX_HORAS_DEDICACION_SEMANAL', 'htmlOptions'=>array('width'=>'70'),),
		
	array('name'=>'PEAC_ID', 'value'=>'$data->rel_periodosacademicos->PEAC_ID', 'filter'=>$model->getPeridosacademicos(), 'htmlOptions'=>array('width'=>'70')),

		array(
			 'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',	
		),
	),
)); ?>

    </td>
  </tr>
</table>
