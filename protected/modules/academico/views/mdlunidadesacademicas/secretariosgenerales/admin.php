<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel Unidades Académicas'=>array('unidadesacademicascpanel/'),
	'Secretarios Generales'=>array('admin'),
	'Administrar',
);
/*
$this->menu=array(
	array('label'=>'List Secretariosgenerales','url'=>array('index')),
	array('label'=>'Create Secretariosgenerales','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('secretariosgenerales-grid', {
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
			 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/secretariosgenerales.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE SECRETARIOS GENERALES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('unidadesacademicascpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlunidadesacademicas/secretariosgenerales/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlunidadesacademicas/secretariosgenerales/create',),$htmlOptions ); 
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
	'id'=>'secretariosgenerales-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
				
			array('name'=>'SEGE_ID', 'value'=>'$data->SEGE_ID', 'type'=>'number','htmlOptions'=>array('width'=>'7'),),
		  array('name'=>'PENA_ID', 'value'=>'$data->rel_personasnaturales->nombreCompleto', 'filter'=>Secretariosgenerales::getPersonasnaturales()), 	
			array('name'=>'SEGE_FECHA_INICIO', 'value'=>'$data->SEGE_FECHA_INICIO', 'htmlOptions'=>array('width'=>'30'),),
		array('name'=>'SEGE_FECHA_FIN', 'value'=>'$data->SEGE_FECHA_FIN', 'htmlOptions'=>array('width'=>'30'),),
		array('name'=>'SEGE_ESTADO',
		  'type'=>'html',
		'filter'=>array('1'=> 'ACTIVO', '0' => 'INACTIVO'), 
		'value'=>'CHtml::link(CHtml::image($data->imagenEstado),array("mdlunidadesacademicas/secretariosgenerales/changeState",
			                                                                 "id"=>$data[SEGE_ID],
																			 "estado"=>$data[SEGE_ESTADO]))', 
	   'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'17',
								   'title' => 'Activar / Desactivar',
								   'alt' => 'Activar / Desactivar'
								  ), 
	  ),
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
