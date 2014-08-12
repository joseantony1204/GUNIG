<?php
Yii::app()->homeUrl = array('/seguridad/');
$this->breadcrumbs=array(
	'Modulo Seguridad'=>array('/seguridad/'),
	'Admin Seguridad'=>array('seguridadcpanel/'),
	'Roles de Acceso'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Usuariosroles','url'=>array('index')),
	array('label'=>'Create Usuariosroles','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('usuariosroles-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE USUARIOS ROLES</em></span></strong></td>

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
         echo CHtml::link($image, array('roles/usuariosroles/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('roles/usuariosroles/create',),$htmlOptions ); 
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
	'id'=>'usuariosroles-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		'USRO_NOMBRE',
		array('name'=>'USPE_ID', 'value'=>'$data->rel_usuarios_perfiles->USPE_NOMBRE', 
		 'filter'=>Usuariosroles::getUsuariosPerfiles(),),
		array('name'=>'USMO_ID', 'value'=>'$data->rel_usuarios_modulos->USMO_NOMBRE', 'filter'=>Usuariosroles::getUsuariosModulos(),),
		array('name'=>'USSM_ID', 'value'=>'$data->rel_usuarios_submodulos->USSM_NOMBRE', 
		 'filter'=>Usuariosroles::getUsuariosSubModulos($data->rel_usuarios_modulos->USMO_ID),),
		array('name'=>'USCO_ID', 'value'=>'$data->rel_usuarios_controladores->USCO_NOMBRE', 
		 'filter'=>Usuariosroles::getUsuariosControladores(),),
		array('name'=>'USVI_ID', 'value'=>'$data->rel_usuarios_vistas->USVI_NOMBRE', 
		 'filter'=>Usuariosroles::getUsuariosVistas(),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}&nbsp;&nbsp;{delete}',
		),
	),
)); ?>

    </td>
  </tr>
</table>
