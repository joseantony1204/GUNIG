<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/catedraticoscpanel/'),
	'Facultades'=>array('mdlcatedraticos/facultades/admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Facultades','url'=>array('index')),
	array('label'=>'Create Facultades','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('facultades-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE FACULTADES</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlcatedraticos/facultades/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/facultades/create',),$htmlOptions ); 
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
	'id'=>'facultades-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'FACU_ID', 'value'=>'$data->FACU_ID','htmlOptions'=>array('width'=>'30'),),
		array('name'=>'FACU_NOMBRE', 'value'=>'$data->FACU_NOMBRE','htmlOptions'=>array('width'=>'350'),),
		array('name'=>'SEDE_ID', 'value'=>'$data->rel_sedes->SEDE_NOMBRE', 'filter'=>Facultades::getSedes(),
		'htmlOptions'=>array('width'=>'100')),
			
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'&nbsp;&nbsp;{download}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
			  //'htmlOptions'=>array('width'=>'80'),
              'buttons'=>array(       
               'download' => array(
			    'label'=>'Descargar Contratos de esta Facultad',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/cont_desc.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlcatedraticos/catedraticoscontratos/download", array("facultad"=>$data[FACU_ID]))',
				),
				'update'=>array('url'=>'Yii::app()->controller->createUrl("mdlcatedraticos/facultades/update", 
			                    array("id"=>$data[FACU_ID],))',),
			 
			   'delete'=>array('url'=>'Yii::app()->controller->createUrl("mdlcatedraticos/facultades/delete", 
			                    array("id"=>$data[FACU_ID],"command"=>"delete"))',
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
