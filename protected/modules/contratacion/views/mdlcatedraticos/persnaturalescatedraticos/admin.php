<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/catedraticoscpanel/'),
	'Docentes Catedráticos'=>array('mdlcatedraticos/persnaturalescatedraticos/admin'),
	'Administrar',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('persnaturalescatedraticos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE DOCENTES CATEDRATICOS</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlcatedraticos/persnaturalescatedraticos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/persnaturalescatedraticos/searchPersonas',),$htmlOptions ); 
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
	'id'=>'persnaturalescatedraticos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'PERS_IDENTIFICACION', 'value'=>'$data->PERS_IDENTIFICACION', 'htmlOptions'=>array('width'=>'80'),),
		array('name'=>'PENA_NOMBRES', 'value'=>'$data->PENA_NOMBRES', 'htmlOptions'=>array('width'=>'150'),),
		array('name'=>'PENA_APELLIDOS', 'value'=>'$data->PENA_APELLIDOS', 'htmlOptions'=>array('width'=>'150'),),
		
		array('name'=>'PENC_CATEGORIA', 'value'=>'$data->PENC_CATEGORIA', 'htmlOptions'=>array('style'=>'text-align: center','width'=>'60'),),
		
		/*array('name'=>'PENC_VALORCATEGORIA', 'type'=>'number', 'value'=>'$data->PENC_VALORCATEGORIA',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'100'),),*/
		
		array('name'=>'PENC_FECHAINGRESO', 'value'=>'$data->PENC_FECHAINGRESO', 'htmlOptions'=>array('width'=>'100'),),
		
		array('name'=>'PEAC_ID', 'value'=>'$data->rel_repiodos_academicos->PEAC_NOMBRE',
		'filter'=>Persnaturalescatedraticos::getPeriodosacademicos(), 'htmlOptions'=>array('width'=>'150'),),
			
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{ver}&nbsp;&nbsp;{actualizar}&nbsp;&nbsp;{delete}',
              'buttons'=>array(       
               'ver' => array(
			    'label'=>'Ver Contrato',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/contratacion/grid_view.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlcatedraticos/catedraticoscontratos/admin", 
				 array("id"=>$data[PENC_ID],))',
				),
				
				'actualizar' => array(
			    'label'=>'Actualizar Docente Catedrático',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/contratacion/grid_update.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlcatedraticos/persnaturalescatedraticos/update", 
				 array("id"=>$data[PENC_ID],))',
				),
				
				'delete' => array(
			    'label'=>'Eliminar Docente Ocasional',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/contratacion/grid_delete.png',
			     'url'=>'Yii::app()->controller->createUrl("mdlcatedraticos/persnaturalescatedraticos/delete", 
				 array("id"=>$data[PENC_ID],"command"=>"delete"))',
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
