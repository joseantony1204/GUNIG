<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Ops'=>array('opscpanel/'),
	'Contratos Ops',
);

/*
$this->menu=array(
	array('label'=>'List Opscontratos','url'=>array('index')),
	array('label'=>'Create Opscontratos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('opscontratos-grid', {
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
		    ?>
              <td width="8%" align="center"><?php echo $image = CHtml::image($imageUrl); ?></td>
             <td width="56%"><strong><span><em>ORDENES DE PRESTACIÓN DE SERVICIOS PROFESIONALES</em></span></strong></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('opscpanel/',),$htmlOptions ); 
?>         
		 
</td>
<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/opscontratos/admin',),$htmlOptions ); 
?></td>

<td width="9%" align="center">
        <?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_desccontrato.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar Contratos');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/opscontratos/download',"opcion"=>"true"),$htmlOptions ); 
        ?></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/opscontratos/searchPersonas',),$htmlOptions ); 
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
<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button btn')); ?>
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
	'id'=>'opscontratos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model, 
	'columns'=>array(
	array('name'=>'PERS_ID', 'value'=>'$data->rel_contrato->Persona->nombrePersona','filter'=>Opscontratos::getPersonas(),),	
	array('name'=>'CONT_NUMORDEN', 'value'=>'$data->CONT_NUMORDEN','htmlOptions'=>array('width'=>'100'),),
	array('name'=>'OPCO_MESES', 'value'=>'$data->OPCO_MESES','htmlOptions'=>array('width'=>'50'),),
	array('name'=>'OPCO_DIAS', 'value'=>'$data->OPCO_DIAS','htmlOptions'=>array('width'=>'35'),),	
	array('name'=>'OPCO_VALOR_MENSUAL', 'filter' => false, 'value'=>'$data->OPCO_VALOR_MENSUAL', 'type'=>'number',
	'htmlOptions'=>array('width'=>'120'),),
	array('name'=>'CONT_FECHAINICIO', 'value'=>'$data->CONT_FECHAINICIO','htmlOptions'=>array('width'=>'95'),),
	array('name'=>'CONT_FECHAFINAL', 'value'=>'$data->CONT_FECHAFINAL','htmlOptions'=>array('width'=>'95'),),
	array('name'=>'DEPE_ID', 'value'=>'$data->rel_dependencia->DEPE_NOMBRE', 'filter'=>Opscontratos::getDependencias()),			
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{download}&nbsp;{update}{delete}',
              'buttons'=>array(       
               'download' => array(
			    'label'=>'Descargar Contrato',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/cont_desc.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlops/opscontratos/download", array("id"=>$data[OPCO_ID]))',
				),
			   'delete' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlops/contratos/delete", array("id"=>$data[CONT_ID],"command"=>"delete"))',
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
