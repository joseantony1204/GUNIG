<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/ordenescpanel/index'),
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
              <td width="6%" align="center"> <?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
			  echo $image = CHtml::image($imageUrl);
		    ?> </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE PERSONAS NATURALES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al Cpanel');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/contratacion/ordenescpanel/index',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/personasnaturales/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/personasnaturales/create',),$htmlOptions ); 
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
		array('name'=>'TIID_ID', 'value'=>'$data->rel_personas->rel_tipos_identificacion->TIID_NOMBRE', 'filter' => false,),
		//'filter'=>Tiposidentificacion::getTiposidentificacion()),
		'PERS_IDENTIFICACION',
		'PENA_NOMBRES',
		'PENA_APELLIDOS',
		array('name'=>'SEXO_ID', 'value'=>'$data->rel_sexos->SEXO_NOMBRE','filter' => false,),
		//'filter'=>Sexos::getSexos()),
		array('name'=>'MUNI_ID', 'value'=>'$data->rel_municipios->MUNI_NOMBRE','filter' => false,),
		//'filter'=>Municipios::getMunicipios()),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{next}{update}{delete}',
			 'buttons'=>array(       
              'next' => array(
			    'label'=>'Administrar Contrato',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/contratacion/cont_next.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlordenes/personasnaturales/view", array("id"=>$data[PERS_ID]))',
				),			  
			  ),
		),
	),
)); ?>

    </td>
  </tr>
</table>
