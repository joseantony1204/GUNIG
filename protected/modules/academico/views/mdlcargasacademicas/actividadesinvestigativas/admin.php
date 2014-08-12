<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel Carga Académica'=>array('cargasacademicascpanel/'),
	'Actividades de Investigación'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Actividadesinvestigativas','url'=>array('index')),
	array('label'=>'Create Actividadesinvestigativas','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('actividadesinvestigativas-grid', {
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
			  $imageUrl = Yii::app()->request->baseUrl . '/images/academico/actividadesinvestigativas.png';
			   echo $image = CHtml::image($imageUrl);?></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE ACTIVIDADES INVESTIGATIVAS</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlcargasacademicas/actividadesinvestigativas/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/actividadesinvestigativas/create',),$htmlOptions ); 
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
	'id'=>'actividadesinvestigativas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		/*'ACIN_ID',
		'GRIN_ID',
		'PEAC_ID',
		'ACIN_NOMBRE',
		'ACIN_HORAS_DEDICACION_SEMANAL',*/
		
		array('name'=>'ACIN_ID', 'value'=>'$data->ACIN_ID', 'htmlOptions'=>array('width'=>'4'),),
		array('name'=>'PENA_ID', 'value'=>'$data->rel_personas_naturales->nombreCompleto', 'filter'=>$model->getPersonas(), 'htmlOptions'=>array('width'=>'300'),),
		array('name'=>'GRIN_ID', 'value'=>'$data->rel_grupoinvestigacion->GRIN_NOMBRE', 'filter'=>$model->getGruposinvestigacion(), 'htmlOptions'=>array('width'=>'120'),),
		array('name'=>'PEAC_ID', 'value'=>'$data->rel_periodosacademicos->PEAC_ID', 'filter'=>$model->getPeridosacademicos(), 'htmlOptions'=>array('width'=>'50')),
		
		array('name'=>'ACIN_NOMBRE', 'value'=>'$data->ACIN_NOMBRE', 'htmlOptions'=>array('width'=>'400'),),	
		array('name'=>'ACIN_HORAS_DEDICACION_SEMANAL', 'value'=>'$data->ACIN_HORAS_DEDICACION_SEMANAL', 'htmlOptions'=>array('width'=>'70'),),	
		
		array(
			 'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',	
		),
	),
)); ?>

    </td>
  </tr>
</table>
