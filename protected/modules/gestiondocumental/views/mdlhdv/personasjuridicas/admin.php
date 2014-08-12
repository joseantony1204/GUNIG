<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Tutorias'=>array('tutoriascpanel/'),
	'Personas Juridicas'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Personasjuridicas','url'=>array('index')),
	array('label'=>'Create Personasjuridicas','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('personasjuridicas-grid', {
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
            <?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';   ?>
            <?php $image = CHtml::image($imageUrl);   ?>
              <td width="6%" align="center"><?php echo $image; ?></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE PERSONAS JURIDICAS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('tutoriascpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/personasjuridicas/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/personasjuridicas/create',),$htmlOptions ); 
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
	'id'=>'personasjuridicas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'TIID_ID', 'value'=>'$data->rel_personas->rel_tipos_identificacion->TIID_NOMBRE', 
		'filter'=>Tiposidentificacion::getTiposidentificacion(),'htmlOptions'=>array('width'=>'160'),),
		array('name'=>'PERS_IDENTIFICACION', 'value'=>'$data->PERS_IDENTIFICACION','htmlOptions'=>array('width'=>'180')),
		array('name'=>'PEJU_NOMBRE', 'value'=>'$data->PEJU_NOMBRE','htmlOptions'=>array('width'=>'300')),
		array('name'=>'PEJU_OBJETOCOMERCIAL', 'value'=>'$data->PEJU_OBJETOCOMERCIAL','htmlOptions'=>array('width'=>'290')),
		array('name'=>'TIRE_ID', 'value'=>'$data->rel_personas->rel_tiposregimen->TIRE_NOMBRE', 
		'filter'=>Personasjuridicas::getTiposregimen()),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

    </td>
  </tr>
</table>
