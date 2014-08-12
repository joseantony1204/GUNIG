<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/ocasionalescpanel/'),
	'Contratos'=>array('mdlocasionales/ocasionalescontratos/admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Ocasionalescontratos','url'=>array('index')),
	array('label'=>'Create Ocasionalescontratos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ocasionalescontratos-grid', {
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
              <td width="8%" align="center">
              <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="56%"><strong><span><em>ADMINISTRACION DE CONTRATOS DE DOCENTES OCASIONALES</em></span></strong></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('ocasionalescpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlocasionales/ocasionalescontratos/admin',),$htmlOptions ); 
?>         
		 </td>
<td width="9%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_desccontrato.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar Contratos');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlocasionales/ocasionalescontratos/download',"opcion"=>"true"),$htmlOptions ); 
        ?></td>

<td width="9%" align="center">
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
	'id'=>'ocasionalescontratos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
        array('name'=>'PERS_IDENTIFICACION', 'value'=>'$data->PERS_IDENTIFICACION', 'htmlOptions'=>array('width'=>'100'),),
		array('name'=>'PENA_NOMBRES', 'value'=>'$data->PENA_NOMBRES', 'htmlOptions'=>array('width'=>'150'),),
		array('name'=>'PENA_APELLIDOS', 'value'=>'$data->PENA_APELLIDOS', 'htmlOptions'=>array('width'=>'120'),),
		
		array('name'=>'OCCO_RESOLUCION', 'value'=>'$data->OCCO_RESOLUCION',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'30'),),
		
		array('name'=>'OCCO_VALORMENSUAL', 'type'=>'number', 'value'=>'$data->OCCO_VALORMENSUAL',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'100'),),
		
		array('name'=>'OCCO_MESES', 'value'=>'$data->OCCO_MESES','htmlOptions'=>array('style'=>'text-align: center','width'=>'30'),),
		array('name'=>'OCCO_DIAS', 'value'=>'$data->OCCO_DIAS','htmlOptions'=>array('style'=>'text-align: center','width'=>'30'),),       
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{ver}&nbsp;&nbsp;{actualizar}&nbsp;&nbsp;{delete}',
              'buttons'=>array(       
               'ver' => array(
			    'label'=>'Descargar Contrato',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/contratacion/grid_download.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlocasionales/ocasionalescontratos/download", 
				 array("id"=>$data[OCCO_ID],))',
				),
				
				'actualizar' => array(
			    'label'=>'Actualizar Docente Ocasional',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/contratacion/grid_update.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlocasionales/persnaturalesocasionales/update", 
				 array("id"=>$data[PENO_ID],))',
				),
				
				'delete' => array(
			    'label'=>'Eliminar Contrato y Docente Ocasional',
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
