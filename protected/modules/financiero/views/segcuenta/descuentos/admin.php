<?php
$this->breadcrumbs=array(
	'Descuentos'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Descuentos','url'=>array('index')),
	array('label'=>'Create Descuentos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('descuentos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE DESCUENTOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('tcuentascpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/descuentos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/descuentos/create',),$htmlOptions ); 
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
	'id'=>'descuentos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		//array('name'=>'DESC_ID', 'value'=>'$data->DESC_ID','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'DESC_NOMBRE', 'value'=>'$data->DESC_NOMBRE','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'TIDE_NOMBRE', 'value'=>'$data->TIDE_NOMBRE','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'APDE_NOMBRE', 'value'=>'$data->APDE_NOMBRE','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'ESDE_NOMBRE', 'value'=>'$data->ESDE_NOMBRE','htmlOptions'=>array('width'=>'95'),),
		
		
		
		array('name'=>'AGREGAR', 'filter' => false, 
		'value'=> '$data->AGREGAR."&nbsp;&nbsp;&nbsp;&nbsp;".CHtml::link(CHtml::image(Yii::app()->baseurl."/images/icon_cuentas.png"),
		Yii::app()->createUrl("financiero/segcuenta/descuentosatributos/detail",
		array("id"=>$data->primaryKey)))','type'=>'raw','headerHtmlOptions'=>array('colspan'=>'1'),
		'htmlOptions'=>array('style'=>'text-align: right', 'title' => 'Agregar nuevo atributo al descuento', 'alt' => 'Agregar nuevo atributo al descuento', 'width'=>'30'),),
				
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template' => '{update}&nbsp;&nbsp;{delete}',
              'buttons' => array(
                                			   		  
			                    ),
	          ),
		),
		)); 
?>	
	
		
    </td>
  </tr>
</table>
