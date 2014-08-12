<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Ops'=>array('opscpanel/'),
	'Dependencias'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Dependencias','url'=>array('index')),
	array('label'=>'Create Dependencias','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('dependencias-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="90%" border="0" align="center">
  <tr>
    <td><table width="100%" border="0" align="center">
      <tr>
        <td>
        <fieldset>
          <table width="100%" border="0" align="center">
            <tr>
              <td width="6%" align="center"><img src="../images/setting.png" width="60" height="70" /></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE DEPENDENCIAS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('opscpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/dependencias/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/dependencias/create',),$htmlOptions ); 
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
	'id'=>'dependencias-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'DEPE_NOMBRE', 'value'=>'$data->DEPE_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		array('name'=>'SEDE_ID', 'value'=>'$data->rel_sedes->SEDE_NOMBRE', 'filter'=>Dependencias::getSedes(),
		'htmlOptions'=>array('width'=>'150')),
		array('name'=>'CONTRATOS', 'value'=>'$data->CONTRATOS', 'filter' => false,
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'120'),),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{download}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
              'buttons'=>array(       
               'download' => array(
			    'label'=>'Descargar Contratos de esta dependencia',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/cont_desc.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlops/opscontratos/download", array("dependencia"=>$data[DEPE_ID]))',
				),
			   'update' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlops/dependencias/update", array("id"=>$data[DEPE_ID]))',
				),
			   'delete' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlops/dependencias/delete", array("id"=>$data[DEPE_ID],"command"=>"delete"))',
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
