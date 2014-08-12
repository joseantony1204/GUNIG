<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel Carga Académica'=>array('cargasacademicascpanel/'),
	'Horas Cátedras'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Horascatedras','url'=>array('index')),
	array('label'=>'Create Horascatedras','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('horascatedras-grid', {
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
			 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/horascatedras.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE HORAS CÁTEDRAS</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlcargasacademicas/horascatedras/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/horascatedras/create',),$htmlOptions ); 
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
	'id'=>'horascatedras-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	/*	'HOCA_ID',
		'HOCA_SEMANAL',
		'TICD_ID',
		'HOCA_ACUERDO',
		'HOCA_INICIO',
		'HOCA_FIN',*/
		/*
		'HOCA_ESTADOS',
		*/
		
		array('name'=>'HOCA_ID', 'value'=>'$data->HOCA_ID', 'htmlOptions'=>array('width'=>'50'),),
		array('name'=>'HOCA_SEMANAL', 'value'=>'$data->HOCA_SEMANAL', 'htmlOptions'=>array('width'=>'150'),),
		array('name'=>'TICD_ID', 'value'=>'$data->rel_tipovinculaciondocente->TICD_NOMBRE', 'filter'=>$model->getTipovinculaciondocenente(), 'htmlOptions'=>array('width'=>'200')),
		array('name'=>'HOCA_ACUERDO', 'value'=>'$data->HOCA_ACUERDO', 'htmlOptions'=>array('width'=>'100'),),
		array('name'=>'HOCA_INICIO', 'value'=>'$data->HOCA_INICIO', 'htmlOptions'=>array('width'=>'150'),),
		array('name'=>'HOCA_INICIO', 'value'=>'$data->HOCA_FIN', 'htmlOptions'=>array('width'=>'150'),),
		array( 
			  'name'=>'HOCA_ESTADOS',
			  'type'=>'html',
			  'filter'=>array('0'=> 'ACTIVO', '1' => 'INACTIVO'),
			  'value'=> 'CHtml::link(CHtml::image($data->imagenEstado),array("mdlcargasacademicas/horascatedras/changeState",
			                                                                 "id"=>$data[HOCA_ID],
																			 "estado"=>$data[HOCA_ESTADOS]))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'130',
								   'title' => 'Activar / Desactivar',
								   'alt' => 'Activar / Desactivar'
								  ), 
			  ),
		
		array('class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

    </td>
  </tr>
</table>
