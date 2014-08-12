<?php
$this->breadcrumbs=array(
	'Persnatudependencias'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Persnatudependencias','url'=>array('index')),
	array('label'=>'Create Persnatudependencias','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('persnatudependencias-grid', {
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
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE PERSONAS POR DEPENDENCIAS</em></span></strong></td>
			 	 <td width="5%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/archivo/rain.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Radicado Interno');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/radicadosinternos/admin',),$htmlOptions ); 
?>         
		 
</td>
	 <td width="6%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/archivo/raex.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Radicado Externo');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/radicadosexternos/admin',),$htmlOptions ); 
?>         
		 
</td>		

<td width="6%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('archivocpanel/index',),$htmlOptions ); 
?>         
		 
</td>

<td width="6%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/persnatudependencias/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="6%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/persnatudependencias/create',),$htmlOptions ); 
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
	'id'=>'persnatudependencias-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		//array('name'=>'PEND_ID', 'value'=>'$data->PEND_ID', 'htmlOptions'=>array('width'=>'80'),),
		array('name'=>'PENA_ID', 'value'=>'$data->rel_personasnaturales->nombreCompleto', 'filter'=>Persnatudependencias::getPersonas()),
        array('name'=>'DEPE_ID', 'value'=>'$data->dEPE->DEPE_NOMBRE', 'filter'=>Persnatudependencias::getDependencias()),
		array('name'=>'CARG_ID', 'value'=>'$data->cARG->CARG_NOMBRE', 'filter'=>Persnatudependencias::getCargos()),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}{update}',
              'buttons'=>array(       
			   'view' => array(
			    'url'=>'Yii::app()->controller->createUrl("rcdarchivo/persnatudependencias/view", array("id"=>$data[PEND_ID],))',
				),
			  ),
			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
