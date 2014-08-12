<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/ordenescpanel/index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Presupuestosordenes','url'=>array('index')),
	array('label'=>'Create Presupuestosordenes','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('presupuestosordenes-grid', {
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
		      $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
			  echo $image = CHtml::image($imageUrl);
		    ?></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE PRESUPUESTOS / CDP</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/modeloordenes/view','id'=>$model->MOOR_ID,),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/presupuestosordenes/admin','id'=>$model->MOOR_ID),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/presupuestosordenes/create','id'=>$model->MOOR_ID),$htmlOptions ); 
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
<?php //echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button btn')); ?>
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
	'id'=>'presupuestosordenes-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		//'PROR_ID',
		//'MOOR_ID',
		//'PRES_ID',
		//PRES_FECHA_VIGENCIA
array('name'=>'PRES_NUM_CERTIFICADO', 'filter' => false, 'value'=>'$data->Presupuestoordenes->PRES_NUM_CERTIFICADO','htmlOptions'=>array('width'=>'5'),),
		array('name'=>'PRES_SECCION', 'filter' => false, 'value'=>'$data->Presupuestoordenes->PRES_SECCION','htmlOptions'=>array('width'=>'5'),),
		array('name'=>'PRES_CODIGO', 'filter' => false, 'value'=>'$data->Presupuestoordenes->PRES_CODIGO','htmlOptions'=>array('width'=>'5'),),
		array('name'=>'PRES_MONTO', 'filter' => false, 'value'=>'$data->Presupuestoordenes->PRES_MONTO','htmlOptions'=>array('width'=>'5'),),
		array('name'=>'PRES_DESCRIPCION', 'filter' => false, 'value'=>'$data->Presupuestoordenes->PRES_DESCRIPCION','htmlOptions'=>array('width'=>'30'),),
		array('name'=>'PRES_FECHA_VIGENCIA', 'filter' => false, 'value'=>'$data->Presupuestoordenes->PRES_FECHA_VIGENCIA','htmlOptions'=>array('width'=>'50'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'&nbsp;{delete}',
              'buttons'=>array(       
               'update' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlordenes/presupuestosordenes/update", array("id"=>$data[PROR_ID]))',
				),),
		),
	),
)); ?>

    </td>
  </tr>
</table>
