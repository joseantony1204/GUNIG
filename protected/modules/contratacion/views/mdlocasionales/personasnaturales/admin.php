<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/ocasionalescpanel/'),
	'Personas Naturales'=>array('mdlocasionales/personasnaturales/admin'),
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE PERSONAS NATURALES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('ocasionalescpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlocasionales/personasnaturales/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlocasionales/personasnaturales/create',),$htmlOptions ); 
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
               'template'=>'{view}&nbsp;{update}{delete}',
               'buttons'=>array(  
                'delete' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlocasionales/personas/delete",array("id"=>$data[PERS_ID],"command"=>"delete"))',
				),
                       'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/crosse.png',
			  'deleteConfirmation'=>'Seguro que quiere eliminar el elemento?', // mensaje de confirmación de borrado
			  'afterDelete'=>'function(link,success,data){ if(success) alert("Elemento borrado exitosamente..."); }',
			),

		),
	),
)); ?>

    </td>
  </tr>
</table>
