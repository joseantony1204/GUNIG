<?php
Yii::app()->homeUrl = array('/seguridad/');
$this->breadcrumbs=array(
	'Modulo Seguridad'=>array('/seguridad/'),
	'Admin Seguridad'=>array('seguridadcpanel/'),
	'Usuarios'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Usuarios','url'=>array('index')),
	array('label'=>'Create Usuarios','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('usuarios-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE USUARIOS</em></span></strong></td>

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
         echo CHtml::link($image, array('roles/users/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('roles/users/create',),$htmlOptions ); 
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
	'id'=>'usuarios-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'PENA_ID', 'value'=>'$data->rel_personas_naturales->nombreCompleto','htmlOptions'=>array('width'=>'300'),),
		array('name'=>'USUA_USUARIO', 'value'=>'$data->USUA_USUARIO','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'USUA_FECHAALTA', 'value'=>'$data->USUA_FECHAALTA','htmlOptions'=>array('width'=>'150'),),
		array('name'=>'USUA_FECHABAJA', 'value'=>'$data->USUA_FECHABAJA','htmlOptions'=>array('width'=>'150'),),
		array('name'=>'USUA_ULTIMOACCESO', 'value'=>'$data->USUA_ULTIMOACCESO','htmlOptions'=>array('width'=>'150'),),
		array('name'=>'USES_ID', 'value'=>'$data->rel_usuarios_estados->USES_NOMBRE', 'filter'=>Users::getUsuariosEstados(),),
		array( 
			  'name'=>'VER',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link(CHtml::image($data->imagenVer),array("roles/perfilesusuarios/admin",
			                                                                 "id"=>$data[USUA_ID],))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'30',
								   'title' => 'Ver Detalles',
								   'alt' => 'Ver Detalles'
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
