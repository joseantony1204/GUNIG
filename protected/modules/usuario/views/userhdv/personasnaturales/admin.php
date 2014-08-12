<?php
Yii::app()->homeUrl = array('/usuario/');
$this->breadcrumbs=array(
	'Modulo De Usuario'=>array('/usuario/'),
	'Personas Naturales'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Personasnaturales','url'=>array('index')),
	array('label'=>'Create Personasnaturales','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('personasnaturales-grid', {
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
            <?php
            $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
            $image = CHtml::image($imageUrl);
			?>
              <td width="6%" align="center"> <?php echo $image; ?></td>
             <td><strong><span><em>ADMINISTRACION DE DATOS PERSONALES</em></span></strong></td>

<td width="7%" align="center">
  <?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/usuario/',),$htmlOptions ); 
         ?>
</td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('userhdv/personasnaturales/admin',),$htmlOptions ); 
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
	'id'=>'personasnaturales-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'TIID_ID', 'value'=>'$data->rel_personas->rel_tipos_identificacion->TIID_NOMBRE', 
		'filter'=>Tiposidentificacion::getTiposidentificacion()),
		'PERS_IDENTIFICACION',
		'PENA_NOMBRES',
		'PENA_APELLIDOS',
		array('name'=>'SEXO_ID', 'value'=>'$data->rel_sexos->SEXO_NOMBRE','filter'=>Sexos::getSexos()),
		array('name'=>'MUNI_ID', 'value'=>'$data->rel_municipios->MUNI_NOMBRE','filter'=>Municipios::getMunicipios()),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}&nbsp;&nbsp;&nbsp;{update}',
		),
	),
)); ?>

    </td>
  </tr>
</table>
