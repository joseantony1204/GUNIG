<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/catedraticoscpanel/'),
	'Contratos'=>array('mdlcatedraticos/catedraticoscontratos/admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Catedraticoscontratos','url'=>array('index')),
	array('label'=>'Create Catedraticoscontratos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('catedraticoscontratos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE CONTRATOS CATEDRÁTICOS</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlcatedraticos/catedraticoscontratos/admin',),$htmlOptions ); 
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
	'id'=>'catedraticoscontratos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'PERS_IDENTIFICACION', 'value'=>'$data->PERS_IDENTIFICACION', 'htmlOptions'=>array('width'=>'100'),),
		array('name'=>'PENA_NOMBRES', 'value'=>'$data->PENA_NOMBRES', 'htmlOptions'=>array('width'=>'160'),),
		array('name'=>'PENA_APELLIDOS', 'value'=>'$data->PENA_APELLIDOS', 'htmlOptions'=>array('width'=>'170'),),
        array('name'=>'CACO_NUMORDEN', 'value'=>'$data->CACO_NUMORDEN','htmlOptions'=>array('style'=>'text-align: center','width'=>'90'),),
		array('name'=>'CACO_VALORHORA', 'value'=>'$data->CACO_VALORHORA', 'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'60'),),
		
		array('name'=>'VALORCONTRATO', 'value'=>'$data->VALORCONTRATO', 'filter'=>false, 'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'100'),),
		
		array('name'=>'CATC_ID', 'value'=>'$data->rel_catedraticos_tp_contratos->CATC_NOMBRE',
		'filter'=>Catedraticoscontratos::getCatedraticostiposcontratos(), 'htmlOptions'=>array('width'=>'150'),),
		

		
		array( 
			  'name'=>'CATEDRAS',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> '$data->CATEDRAS."&nbsp;&nbsp;&nbsp;&nbsp; || &nbsp;&nbsp;&nbsp;&nbsp;".
			             CHtml::link(CHtml::image(Yii::app()->baseurl."/images/icon_search.png"),
			             array("mdlcatedraticos/catedraticoscatedras/admin","id"=>$data[CACO_ID],))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'12',
								   'title' => 'Ver Catedras',
								   'alt' => 'Ver Catedras'
								  ), 
			  ),


        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{download}&nbsp;{update}{delete}',
              'buttons'=>array(       
               'download' => array(
			    'label'=>'Descargar Contrato',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/cont_desc.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlcatedraticos/catedraticoscontratos/download", array("id"=>$data[CACO_ID]))',
				),
				'update' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlcatedraticos/persnaturalescatedraticos/update", array("id"=>$data[PENC_ID]))',
				),
			   'delete' => array(
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
