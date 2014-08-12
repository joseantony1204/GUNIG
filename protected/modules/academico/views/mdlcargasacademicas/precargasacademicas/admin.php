<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel Carga Académica'=>array('cargasacademicascpanel/'),
	'Asignar Docente a un Periodo Académico'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Precargasacademicas','url'=>array('index')),
	array('label'=>'Create Precargasacademicas','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('precargasacademicas-grid', {
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
              <td width="6%" align="center"><img src="../images/setting.png" width="60" height="70" /></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE ASIGNAR DOCENTE A UN PERIODO ACADÉMICO</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlcargasacademicas/precargasacademicas/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/precargasacademicas/create',),$htmlOptions ); 
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
	'id'=>'precargasacademicas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		/*'PRCA_ID',
		'PENA_ID',
		'TICD_ID',
		'PEAC_ID',*/
		
		array('name'=>'PRCA_ID', 'value'=>'$data->PRCA_ID', 'htmlOptions'=>array('width'=>'4'),),
		array('name'=>'PENA_ID', 'value'=>'$data->rel_personasnaturales->nombreCompleto', 'filter'=>Precargasacademicas::getPersonas(), 'htmlOptions'=>array('width'=>'400'),),
		array('name'=>'TICD_ID', 'value'=>'$data->rel_tipovinculaciondocente->TICD_NOMBRE', 
		'filter'=>Precargasacademicas::getTipoVinculacionDocente2(),
		'htmlOptions'=>array('width'=>'200')),
		array('name'=>'FACU_ID', 'value'=>'$data->rel_facultades->FACU_NOMBRE', 'filter'=>Precargasacademicas::getFacultades(), 'htmlOptions'=>array('width'=>'200'),),
			array('name'=>'PEAC_ID', 'value'=>'$data->rel_periodosacademicos->PEAC_NOMBRE', 'filter'=>Precargasacademicas::getPeridosacademicos(), 'htmlOptions'=>array('width'=>'200'),),
		
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

    </td>
  </tr>
</table>
