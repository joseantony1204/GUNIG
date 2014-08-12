<?php
$this->breadcrumbs=array(
	'Liquidaciones'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Liquidaciones','url'=>array('index')),
	array('label'=>'Create Liquidaciones','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('liquidaciones-grid', {
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
             	<?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl); ?>
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE LIQUIDACIONES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/financiero',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/liquidaciones/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/liquidaciones/create',),$htmlOptions ); 
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
	'id'=>'liquidaciones-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		
		array('name'=>'LIQU_ID', 'value'=>'$data->LIQU_ID', 'htmlOptions'=>array('width'=>'100'),),
		array('name'=>'LIQU_FECHA', 'value'=>'$data->LIQU_FECHA', 'htmlOptions'=>array('width'=>'100'),),
		array('name'=>'CUEN_ID', 'value'=>'$data->CUEN_ID', 'htmlOptions'=>array('width'=>'100'),),
		array('name'=>'ANAC_ID', 'value'=>'$data->ANAC_ID', 'htmlOptions'=>array('width'=>'100'),),
		array('class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{download}',
              'buttons'=>array(       
							  'download' => array(
												  'label'=>'Descargar Orden de Pago',
												  'imageUrl'=>Yii::app()->request->baseUrl.'/images/cont_desc.png',
												  'url'=>'Yii::app()->controller->createUrl("segcuenta/liquidaciones/download", array("id"=>$data[LIQU_ID]))',
												  ),
								),				  
			 ),									
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

    </td>
  </tr>
</table>
