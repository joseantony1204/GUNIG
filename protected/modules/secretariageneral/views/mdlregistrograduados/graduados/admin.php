<?php
$this->breadcrumbs=array(
	'Modulo Secretaria General'=>array('/secretariageneral/'),
	'Panel Registro Graduados'=>array('registrograduadoscpanel/'),
	''=>array('admin'),
	'Administrar',
);
/*
$this->menu=array(
	array('label'=>'List Graduados','url'=>array('index')),
	array('label'=>'Create Graduados','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('graduados-grid', {
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
			 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/graduados.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE GRADUADOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('registrograduadoscpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/graduados/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/graduados/create',),$htmlOptions ); 
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
	'id'=>'graduados-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	
		
		
		
		array('name'=>'GRAD_PRIMER_APELLIDO', 'value'=>'$data->GRAD_PRIMER_APELLIDO', 'htmlOptions'=>array('width'=>'30'),),
		array('name'=>'GRAD_SEGUNDO_APELLIDO', 'value'=>'$data->GRAD_SEGUNDO_APELLIDO', 'htmlOptions'=>array('width'=>'30'),),
              array('name'=>'GRAD_NOMBRES', 'value'=>'$data->GRAD_NOMBRES', 'htmlOptions'=>array('width'=>'30'),),
              array('name'=>'GRAD_CEDULA', 'value'=>'$data->GRAD_CEDULA', 'htmlOptions'=>array('width'=>'3'),),
              array('name'=>'GRAD_LUGAR_EXPEDICION', 'value'=>'$data->GRAD_LUGAR_EXPEDICION', 'htmlOptions'=>array('width'=>'10'),),
              array('name'=>'SEXO_ID', 'value'=>'$data->rel_sexos->SEXO_NOMBRE', 'filter'=>Sexos::getSexos(),'htmlOptions'=>array('width'=>'5')),
		array('name'=>'GRAD_FECHA_NACIMIENTO', 'value'=>'$data->GRAD_FECHA_NACIMIENTO', 'htmlOptions'=>array('width'=>'7'),),
		array('name'=>'GRAD_FECHA_EXPEDICION', 'value'=>'$data->GRAD_FECHA_EXPEDICION', 'htmlOptions'=>array('width'=>'4'),),
		
		
		
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
