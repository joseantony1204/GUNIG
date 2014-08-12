<?php
Yii::app()->homeUrl = array('/seguridad/');
$this->breadcrumbs=array(
	'Modulo Seguridad'=>array('/seguridad/'),
	'Admin Seguridad'=>array('seguridadcpanel/'),
	'Usuarios Seguimiento Cuentas'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Seguimientouserdependencias','url'=>array('index')),
	array('label'=>'Create Seguimientouserdependencias','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('seguimientouserdependencias-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE USUARIOS SEGUIMIENTO CUENTAS</em></span></strong></td>

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
         echo CHtml::link($image, array('roles/seguimientouserdependencias/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('roles/seguimientouserdependencias/create',),$htmlOptions ); 
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
	'id'=>'seguimientouserdependencias-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'PENA_ID', 'value'=>'$data->rel_usuarios->rel_personas_naturales->nombreCompleto',
		'htmlOptions'=>array('width'=>'300'),),
		array('name'=>'USUA_USUARIO', 'value'=>'$data->rel_usuarios->USUA_USUARIO','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'USPE_ID', 'value'=>'$data->rel_usuarios->rel_users_perfiles_users->rel_usuarios_perfiles->USPE_NOMBRE', 
	         'filter'=>Usersperfilesusuarios::getUsuariosPerfiles(), 'htmlOptions'=>array('width'=>'180'),),
		array('name'=>'USUA_ULTIMOACCESO', 'value'=>'$data->rel_usuarios->USUA_ULTIMOACCESO','htmlOptions'=>array('width'=>'150'),),
		array('name'=>'USES_ID', 'value'=>'$data->rel_usuarios->rel_usuarios_estados->USES_NOMBRE', 'filter'=>Users::getUsuariosEstados(),),
array('name'=>'DEPE_ID', 'value'=>'$data->rel_dependencias->DEPE_NOMBRE', 'filter'=>Seguimientouserdependencias::getDependencias(),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
		),
	),
)); ?>

    </td>
  </tr>
</table>
