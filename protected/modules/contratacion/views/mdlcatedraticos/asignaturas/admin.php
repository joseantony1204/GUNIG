<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('catedraticoscpanel/'),
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
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE ASIGNATURAS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('catedraticoscpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/asignaturas/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/asignaturas/create',),$htmlOptions ); 
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
	'id'=>'asignaturas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'ASIG_ID', 'value'=>'$data->ASIG_ID', 'htmlOptions'=>array('width'=>'10')),
		array('name'=>'ASIG_CODIGO', 'value'=>'$data->ASIG_CODIGO', 'htmlOptions'=>array('width'=>'60')),
		array('name'=>'ASIG_NOMBRE', 'value'=>'$data->ASIG_NOMBRE', 'htmlOptions'=>array('width'=>'300')),	
		array('name'=>'PROG_ID', 'value'=>'$data->rel_programas->PROG_NOMBRE', 'filter'=>Asignaturas::getProgramas(),
		'htmlOptions'=>array('width'=>'250')),
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
