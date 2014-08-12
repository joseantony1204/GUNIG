<?php
Yii::app()->homeUrl = array('/seguridad/');
$this->breadcrumbs=array(
	'Modulo Seguridad'=>array('/seguridad/'),
	'Admin Seguridad'=>array('seguridadcpanel/'),
	'Usuarios - Perfiles'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Usersperfilesusuarios','url'=>array('index')),
	array('label'=>'Create Usersperfilesusuarios','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('usersperfilesusuarios-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE PERFILES DE USUARIOS</em></span></strong></td>

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
         echo CHtml::link($image, array('roles/usersperfilesusuarios/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('roles/usersperfilesusuarios/create',),$htmlOptions ); 
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
	'id'=>'usersperfilesusuarios-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	   array('name'=>'PERS_IDENTIFICACION', 'value'=>'$data->PERS_IDENTIFICACION','htmlOptions'=>array('width'=>'60'),),
	   array('name'=>'PENA_NOMBRES', 'value'=>'$data->PENA_NOMBRES','htmlOptions'=>array('width'=>'140'),),
	   array('name'=>'PENA_APELLIDOS', 'value'=>'$data->PENA_APELLIDOS','htmlOptions'=>array('width'=>'140'),),
	  
	   array('name'=>'USPE_ID', 'value'=>'$data->rel_usuarios_perfiles->USPE_NOMBRE', 
	         'filter'=>Usersperfilesusuarios::getUsuariosPerfiles(), 'htmlOptions'=>array('width'=>'180'),),
	   array('name'=>'USUA_USUARIO', 'value'=>'$data->USUA_USUARIO','htmlOptions'=>array('width'=>'80'),),
	   //array('name'=>'USUA_FECHAALTA', 'value'=>'$data->USUA_FECHAALTA','htmlOptions'=>array('width'=>'150'),),
	   array('name'=>'USUA_ULTIMOACCESO', 'value'=>'$data->USUA_ULTIMOACCESO','htmlOptions'=>array('width'=>'120'),),
	   array('name'=>'USES_ID', 'value'=>'$data->rel_users->rel_usuarios_estados->USES_NOMBRE', 'filter'=>Users::getUsuariosEstados(),
	         'htmlOptions'=>array('width'=>'60'),),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;&nbsp;{delete}',
              'buttons'=>array(       
			   'delete' => array(
			    'url'=>'Yii::app()->controller->createUrl("roles/users/delete", array("id"=>$data[USUA_ID],"command"=>"delete"))',
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
