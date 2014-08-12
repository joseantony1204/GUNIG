<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/ocasionalescpanel/'),
	'Docentes Ocasionales'=>array('mdlocasionales/persnaturalesocasionales/admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Persnaturalesocasionales','url'=>array('index')),
	array('label'=>'Create Persnaturalesocasionales','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('persnaturalesocasionales-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE DOCENTES OCASIONALES ACTUALES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('ocasionalescpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlocasionales/persnaturalesocasionales/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlocasionales/persnaturalesocasionales/searchPersonas',),$htmlOptions ); 
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
	'id'=>'persnaturalesocasionales-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'PERS_IDENTIFICACION', 'value'=>'$data->PERS_IDENTIFICACION', 'htmlOptions'=>array('width'=>'100'),),
		array('name'=>'PENA_NOMBRES', 'value'=>'$data->PENA_NOMBRES', 'htmlOptions'=>array('width'=>'150'),),
		array('name'=>'PENA_APELLIDOS', 'value'=>'$data->PENA_APELLIDOS', 'htmlOptions'=>array('width'=>'120'),),
		
		array('name'=>'PENO_PUNTOS',  'value'=>'$data->PENO_PUNTOS','htmlOptions'=>array('style'=>'text-align: right','width'=>'10'),),
		array('name'=>'PENO_VALORPUNTO', 'type'=>'number', 'value'=>'$data->PENO_VALORPUNTO',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'60'),),
		
		array('name'=>'PENO_SUELDO', 'type'=>'number', 'value'=>'$data->PENO_SUELDO',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'25'),),
		
		array('name'=>'FACU_ID', 'value'=>'$data->rel_facultades->FACU_NOMBRE','filter'=>Persnaturalesocasionales::getFacultades(), 
		 'htmlOptions'=>array('width'=>'200'),),		
			
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{ver}&nbsp;&nbsp;{actualizar}&nbsp;&nbsp;{delete}',
              'buttons'=>array(       
               'ver' => array(
			    'label'=>'Ver Contrato',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/contratacion/grid_view.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlocasionales/ocasionalescontratos/admin", 
				 array("id"=>$data[PENO_ID],))',
				),
				
				'actualizar' => array(
			    'label'=>'Actualizar Docente Ocasional',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/contratacion/grid_update.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlocasionales/persnaturalesocasionales/update", 
				 array("id"=>$data[PENO_ID],))',
				),
				
				'delete' => array(
			    'label'=>'Eliminar Docente Ocasional',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/contratacion/grid_delete.png',
			     'url'=>'Yii::app()->controller->createUrl("mdlocasionales/persnaturalesocasionales/delete", 
				 array("id"=>$data[PENO_ID],"command"=>"delete"))',
				),
			  ),
			  'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/crosse.png',
			  'deleteConfirmation'=>'Seguro que quiere eliminar el elemento?', // mensaje de confirmación de borrado
			  'afterDelete'=>'function(link,success,data){ if(success) alert("Elemento borrado exitosamente..."); }',
			),	
	),
)); ?>

    </td>
  </tr>
</table>
