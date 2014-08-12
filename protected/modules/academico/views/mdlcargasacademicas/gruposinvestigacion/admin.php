<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Menú Carga Académica'=>array('cargasacademicascpanel/'),
	'Grupos de Invetigación'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Gruposinvestigacion','url'=>array('index')),
	array('label'=>'Create Gruposinvestigacion','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('gruposinvestigacion-grid', {
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
			 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/grupos.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?> </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE GRUPOS INVESTIGACION</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlcargasacademicas/gruposinvestigacion/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/gruposinvestigacion/create',),$htmlOptions ); 
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
	'id'=>'gruposinvestigacion-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		/*'GRIN_ID',
		'GRIN_NOMBRE',
		'CAGI_ID',
		'GRIN_ANIO_CALIFICACION',
		'GRIN_GRUPLAC',
		'PENA_ID',*/
		

	array('name'=>'GRIN_ID', 'value'=>'$data->GRIN_ID', 'htmlOptions'=>array('width'=>'50'),),
		array('name'=>'GRIN_NOMBRE', 'value'=>'$data->GRIN_NOMBRE', 'htmlOptions'=>array('width'=>'50'),),
array('name'=>'CAGI_ID', 'value'=>'$data->rel_categoriagrupos->CAGI_NOMBRE', 'filter'=>$model->getCategoriaGrupos(), 'htmlOptions'=>array('width'=>'200')),
		
		array('name'=>'GRIN_ANIO_CALIFICACION', 'value'=>'$data->GRIN_ANIO_CALIFICACION', 'htmlOptions'=>array('width'=>'50'),),
		array('name'=>'GRIN_GRUPLAC', 'value'=>'$data->GRIN_GRUPLAC', 'htmlOptions'=>array('width'=>'200'),),
		array('name'=>'PENA_ID', 'value'=>'$data->rel_personasnaturales->nombreCompleto', 'filter'=>$model->getPersonas(), 'htmlOptions'=>array('width'=>'400'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

    </td>
  </tr>
</table>
