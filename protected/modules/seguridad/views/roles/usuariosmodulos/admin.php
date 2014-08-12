<?php
Yii::app()->homeUrl = array('/seguridad/');
$this->breadcrumbs=array(
	'Modulo Seguridad'=>array('/seguridad/'),
	'Admin Seguridad'=>array('seguridadcpanel/'),
	'Modulos'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Usuariosmodulos','url'=>array('index')),
	array('label'=>'Create Usuariosmodulos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('usuariosmodulos-grid', {
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
              <?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; 
			   echo $image = CHtml::image($imageUrl);
			  ?>
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE USUARIOS MODULOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/seguridad/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('roles/usuariosmodulos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('roles/usuariosmodulos/create',),$htmlOptions ); 
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
	'id'=>'usuariosmodulos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'USMO_ID', 'value'=>'$data->USMO_ID','htmlOptions'=>array('width'=>'10'),),
		array('name'=>'USMO_NOMBRE', 'value'=>'$data->USMO_NOMBRE','htmlOptions'=>array('width'=>'300'),),
		array('name'=>'USMO_URL', 'value'=>'$data->USMO_URL','htmlOptions'=>array('width'=>'200'),),
		array('name'=>'SUBMODULOS', 'filter' => false, 
	    'value'=>'CHtml::link($data->SUBMODULOS,Yii::app()->createUrl("seguridad/roles/usuariossubmodulos/detail",
	    array("id"=>$data->primaryKey)))','type'=>'raw',
	    'headerHtmlOptions'=>array('colspan'=>'1'),'htmlOptions'=>array('style'=>'text-align: center','width'=>'85'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}&nbsp;&nbsp;{delete}',
		),
	),
)); ?>

    </td>
  </tr>
</table>
