<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel Carga Académica'=>array('cargasacademicascpanel/'),
	'Asignaturas'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Asignaturas','url'=>array('index')),
	array('label'=>'Create Asignaturas','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('asignaturas-grid', {
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
			  $imageUrl = Yii::app()->request->baseUrl . '/images/academico/asignaturas.png';
			   echo $image = CHtml::image($imageUrl);?>
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE ASIGNATURAS</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlcargasacademicas/asignaturas/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/asignaturas/create',),$htmlOptions ); 
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
	'id'=>'asignaturas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		/*'ASIG_ID',
		'ASIG_CODIGO',
		'ASIG_NOMBRE',
		'ASIG_NUMERO_CREDITOS',
		'PROG_ID',
		*/
		array('name'=>'ASIG_ID', 'value'=>'$data->ASIG_ID', 'htmlOptions'=>array('width'=>'4'),),
		array('name'=>'ASIG_CODIGO', 'value'=>'$data->ASIG_CODIGO', 'htmlOptions'=>array('width'=>'4'),),
		array('name'=>'ASIG_NOMBRE', 'value'=>'$data->ASIG_NOMBRE', 'htmlOptions'=>array('width'=>'4'),),
		array('name'=>'ASIG_NUMERO_CREDITOS', 'value'=>'$data->ASIG_NUMERO_CREDITOS', 'htmlOptions'=>array('width'=>'4'),),
		array('name'=>'PROG_ID', 'value'=>'$data->pROG->PROG_NOMBRE', 'filter'=>$model->getProgramas(),'htmlOptions'=>array('width'=>'300'),),
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
