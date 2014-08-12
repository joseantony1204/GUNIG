<?php
Yii::app()->homeUrl = array('/usuario/');
$this->breadcrumbs=array(
	'Modulo De Usuario'=>array('/usuario/'),
	'Usuario'=>array('admin'),
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
             <td><strong><span><em>ADMINISTRACION DEL PERFIL DE USUARIO</em></span></strong></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/usuario/',),$htmlOptions ); 
?></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('userperfil/usuarioperfilusuario/admin',),$htmlOptions ); 
?></td>
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
	   array('name'=>'PENA_ID','value'=>'$data->rel_usuario->rel_personas_naturales->nombreCompleto','htmlOptions'=>array('width'=>'290'),),
	   array('name'=>'USPE_ID', 'value'=>'$data->rel_usuario_perfil->USPE_NOMBRE', 
	         'filter'=>Usuarioperfilusuario::getUsuariosPerfiles(), 'htmlOptions'=>array('width'=>'180'),),
	   array('name'=>'USUA_USUARIO', 'value'=>'$data->USUA_USUARIO','htmlOptions'=>array('width'=>'100'),),
	   array('name'=>'USUA_FECHAALTA', 'value'=>'$data->USUA_FECHAALTA','htmlOptions'=>array('width'=>'150'),),
	   array('name'=>'USUA_ULTIMOACCESO', 'value'=>'$data->USUA_ULTIMOACCESO','htmlOptions'=>array('width'=>'150'),),
	   array('name'=>'USES_ID', 'value'=>'$data->rel_usuario->rel_usuario_estado->USES_NOMBRE', 'filter'=>Usuario::getUsuariosEstados(),
	         'htmlOptions'=>array('width'=>'100'),),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}',
		),
	),
)); ?>

    </td>
  </tr>
</table>
