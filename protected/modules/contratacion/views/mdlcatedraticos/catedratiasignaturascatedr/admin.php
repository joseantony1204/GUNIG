<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/catedraticoscpanel/'),
	'Contratos'=>array('mdlcatedraticos/catedraticoscontratos/admin'),
	'Catedras'=>array('mdlcatedraticos/catedraticoscatedras/admin','id'=>$Catedraticoscatedras->CACO_ID),
	'Asignaturas'=>array('mdlcatedraticos/catedratiasignaturascatedr/admin','id'=>$model->CACA_ID),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Catedratiasignaturascatedr','url'=>array('index')),
	array('label'=>'Create Catedratiasignaturascatedr','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('catedratiasignaturascatedr-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="70%" border="0" align="left">
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE ASIGNATURAS DE LA CATEDRA</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedraticoscatedras/admin','id'=>$Catedraticoscatedras->CACO_ID,),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedratiasignaturascatedr/admin','id'=>$model->CACA_ID,),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedratiasignaturascatedr/create','id'=>$model->CACA_ID,),$htmlOptions ); 
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
	'id'=>'catedratiasignaturascatedr-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'CAAC_ID', 'value'=>'$data->CAAC_ID', 'htmlOptions'=>array('width'=>'10'),),
		array('name'=>'ASIG_ID', 'value'=>'$data->rel_asignaturas->ASIG_NOMBRE', 'htmlOptions'=>array('width'=>'300'),),	
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
