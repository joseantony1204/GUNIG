<?php
Yii::app()->homeUrl = array('/gestiondocumental/');
$this->breadcrumbs=array(
	'Modulo Gestión Documental'=>array('/gestiondocumental/'),
	'Panel'=>array('/gestiondocumental/expedientecpanel/'),
	'Contratos'=>array('mdlexpediente/contratos/admin'),
	'Administrar',
);
/*
$this->menu=array(
	array('label'=>'List Contratos','url'=>array('index')),
	array('label'=>'Create Contratos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contratos-grid', {
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
             <?php $imageUrl = Yii::app()->request->baseUrl . '/images/archivos.png'; echo $image = CHtml::image($imageUrl); ?>
              </td>
             <td><strong><span><em>ADMINISTRACION EXPEDIENTE ELECTRONICO DE CONTRATOS</em></span></strong></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('expedientecpanel/',),$htmlOptions ); 
?></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlexpediente/contratos/admin',),$htmlOptions ); 
?></td>
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
	'id'=>'contratos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
        array('name'=>'PERS_ID', 'filter'=>false, 'value'=>'$data->Persona->nombrePersona','htmlOptions'=>array('width'=>'300'),),
		array('name'=>'TICO_ID', 'value'=>'$data->rel_tipos_contratos->TICO_NOMBRE','filter'=>Contratos::getContratostipo(),
		'htmlOptions'=>array('width'=>'140'),),
		array('name'=>'CLCO_ID', 'value'=>'$data->rel_clases_contratos->CLCO_NOMBRE','filter'=>Contratos::getContratosclase(),
		'htmlOptions'=>array('width'=>'350'),),
		 array('name'=>'CONT_NUMORDEN', 'value'=>'$data->CONT_NUMORDEN','htmlOptions'=>array('width'=>'120'),),
		 array('name'=>'CONT_ANIO', 'value'=>'$data->CONT_ANIO','htmlOptions'=>array('width'=>'80'),),

		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template' => '{ver}',
              'buttons' => array(
                                'ver' => array(
                                               'label' => Yii::t('int', 'Ver Documentos del contrato'),
                                               'url' => 'Yii::app()->controller->createUrl("mdlexpediente/expedientedocumentos/admin",
											                                                          array("id"=>$data[CONT_ID]))',
                                               'imageUrl' => Yii::app()->baseurl.'/images/icon_doc.png',
                                               ),
										   		  
			                    ),
	          ),
	    ),
)); ?>

    </td>
  </tr>
</table>
