<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/ordenescpanel/index'),
	'Personas Juridicas'=>array('/contratacion/mdlordenes/personasjuridicas/admin'),
	'Administrar',	
);

/*
$this->menu=array(
	array('label'=>'List Representante','url'=>array('index')),
	array('label'=>'Create Representante','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('representante-grid', {
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
              <td width="6%" align="center"><?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
			  echo $image = CHtml::image($imageUrl);
		    ?>   </td>
             <td width="63%"><strong><span><em> REPRESENTANTE LEGAL DE LA EMPRESA</em></span></strong></td>

<td width="7%" align="center">&nbsp;</td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/personasjuridicas/admin',),$htmlOptions ); 
?></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/representante/create','id'=>$model->PEJU_ID),$htmlOptions ); 
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
   <td colspan="2">
<?php //echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
   </td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'representante-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		//'RELE_ID',
		array('name'=>'A_ID', 'value'=>'$data->rel_personas_naturales->rel_personas->getNombrePersona(PERS_ID)','filter' => false,),
		array('name'=>'B_ID', 'value'=>'$data->rel_personas_naturales->rel_personas->rel_tipos_identificacion->TIID_NOMBRE','filter' => false,),
		array('name'=>'C_ID', 'value'=>'$data->rel_personas_naturales->rel_personas->PERS_IDENTIFICACION','filter' => false,),
		array('name'=>'D_ID', 'value'=>'$data->rel_personas_naturales->rel_personas->rel_municipios->MUNI_NOMBRE','filter' => false,),
		array('name'=>'E_ID', 'value'=>'$data->rel_personas_naturales->rel_personas->rel_departamentos->DEPA_NOMBRE','filter' => false,),
		array('name'=>'F_ID', 'value'=>'$data->rel_personas_naturales->rel_personas->rel_paises->PAIS_NOMBRE','filter' => false,),
		//'PERS_ID',
		//'PEJU_ID',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			
		),
	),
)); ?>

    </td>
  </tr>
</table>
