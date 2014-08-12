<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel Unidades Académicas'=>array('unidadesacademicascpanel/'),
	'Decanos'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Decanos','url'=>array('index')),
	array('label'=>'Create Decanos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('decanos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE DECANOS</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlunidadesacademicas/decanos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlunidadesacademicas/decanos/create',),$htmlOptions ); 
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
	'id'=>'decanos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		/*'DECA_ID',
		'FACU_ID',
		'PENA_ID',
		'DECA_FECHA_INICIO',
		'DECA_FECHA_FIN',*/
		
		array('name'=>'DECA_ID', 'value'=>'$data->DECA_ID', 'type'=>'number','htmlOptions'=>array('width'=>'7'),),
		array('name'=>'FACU_ID', 'value'=>'$data->rel_facultades->FACU_NOMBRE', 'filter'=>Decanos::getfacultades()),
		  array('name'=>'PENA_ID', 'value'=>'$data->rel_personasnaturales->nombreCompleto', 'filter'=>Decanos::getPersonasnaturales()), 	
			array('name'=>'DECA_FECHA_INICIO', 'value'=>'$data->DECA_FECHA_INICIO', 'htmlOptions'=>array('width'=>'30'),),
		array('name'=>'DECA_FECHA_FIN', 'value'=>'$data->DECA_FECHA_FIN', 'htmlOptions'=>array('width'=>'30'),),
		array('name'=>'DECA_ESTADO',
		  'type'=>'html',
		'filter'=>array('1'=> 'ACTIVO', '0' => 'INACTIVO'), 
		'value'=>'CHtml::link(CHtml::image($data->imagenEstado),array("mdlunidadesacademicas/decanos/changeState",
			                                                                 "id"=>$data[DECA_ID],
																			 "estado"=>$data[DECA_ESTADO]))', 
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
