<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/ordenescpanel/index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Resolucionesacuerdos','url'=>array('index')),
	array('label'=>'Create Resolucionesacuerdos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('resolucionesacuerdos-grid', {
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
		    ?></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE ENCARGOS DE RECTORÍA</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al Cpanel');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/contratacion/ordenescpanel/index'),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/resolucionesacuerdos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/resolucionesacuerdos/create',),$htmlOptions ); 
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
	'id'=>'resolucionesacuerdos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		//'REAC_ID',
		array('name'=>'CONRATANTE', 'value'=>'$data->rel_contratantes->rel_personas_naturales->rel_personas->nombrePersona','htmlOptions'=>array('width'=>'160'),),
		array('name'=>'CONDICION', 'value'=>'$data->rel_contratantes->PECO_DESCRIPCION','filter' => false,'htmlOptions'=>array('width'=>'80'),),
		array('name'=>'INICIO', 'value'=>'$data->rel_contratantes->PECO_FECHAINICIO','htmlOptions'=>array('width'=>'80'),),
		array('name'=>'FIN', 'value'=>'$data->rel_contratantes->PECO_FECHAFINAL','htmlOptions'=>array('width'=>'80'),),
		
		array('name'=>'REAC_NUMERO', 'value'=>'$data->REAC_NUMERO','htmlOptions'=>array('width'=>'10'),),
		array('name'=>'REAC_FECHA', 'value'=>'$data->REAC_FECHA','htmlOptions'=>array('width'=>'60'),),
		
		//$CONRATANTE,$INICIO,$FIN;
		//'REAC_NUMERO',
		//'REAC_FECHA',
		//'REAC_DESCRIPCION',
		//array('name'=>'REAC_DESCRIPCION', 'value'=>'$data->rel_contratantes->rel_personas_naturales->rel_personas->nombrePersonas','filter' => false,'htmlOptions'=>array('width'=>'50'),),
		
		
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			//'template'=>'{update}{delete}',
		),
	),
)); ?>

    </td>
  </tr>
</table>
