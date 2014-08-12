<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Admin Tutorias'=>array('tutoriascpanel/'),
	'Contratos Tutorias'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Tutoriascontratos','url'=>array('index')),
	array('label'=>'Create Tutoriascontratos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tutoriascontratos-grid', {
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
              <td width="8%" align="center">
              <?php  $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl);   ?>
              </td>
             <td width="56%"><strong><span><em>ORDENES DE PRESTACIÓN DE SERVICIOS PROFESIONALES - TUTORIAS</em></span></strong></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('tutoriascpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriascontratos/admin',),$htmlOptions ); 
?>         
		 </td>
<td width="9%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_desccontrato.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar Contratos');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriascontratos/download',"opcion"=>"true"),$htmlOptions ); 
        ?></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriascontratos/searchPersonas',),$htmlOptions ); 
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
	'id'=>'tutoriascontratos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
    array('name'=>'PERS_ID', 'value'=>'$data->Contrato->Persona->nombrePersona', 
	'filter'=>Tutoriascontratos::getPersonas(),),
	array('name'=>'CONT_NUMORDEN', 'value'=>'$data->CONT_NUMORDEN','htmlOptions'=>array('width'=>'95'),),
	array('name'=>'TUCO_VALORHORA', 'filter' => false, 'value'=>'$data->TUCO_VALORHORA', 'type'=>'number',
	'htmlOptions'=>array('width'=>'90'),),
	array('name'=>'VALOR_CONTRATO', 'filter' => false, 'value'=>'$data->VALOR_CONTRATO', 'type'=>'number',
	'htmlOptions'=>array('width'=>'130'),),
	array('name'=>'CONT_FECHAINICIO', 'value'=>'$data->CONT_FECHAINICIO','htmlOptions'=>array('width'=>'95'),),
	array('name'=>'CONT_FECHAFINAL', 'value'=>'$data->CONT_FECHAFINAL','htmlOptions'=>array('width'=>'95'),),
	array('name'=>'TUTORIAS', 'filter' => false, 
	'value'=>'CHtml::link($data->TUTORIAS,Yii::app()->createUrl("contratacion/mdltutorias/tutorias/detail",
	array("id"=>$data->primaryKey)))','type'=>'raw',
	'headerHtmlOptions'=>array('colspan'=>'1'),'htmlOptions'=>array('style'=>'text-align: center','width'=>'85'),),
	array('name'=>'TUFC_ID', 'value'=>'$data->FContrato->TUFC_NOMBRE', 'filter'=>Tutoriascontratos::getFcontrato(),),			
	array(
          'class'=>'bootstrap.widgets.TbButtonColumn',
          'template' => '{descargar}&nbsp;{update}{delete}',
          'buttons' => array(
                             'descargar' => array(
                                            'label' => Yii::t('int', 'Descargar contrato'),
                                            'url' => 'Yii::app()->controller->createUrl("mdltutorias/tutoriascontratos/download",
											                                                          array("id"=>$data[TUCO_ID]))',
                                            'imageUrl' => Yii::app()->baseurl.'/images/cont_desc.png',
                                            ),
							 'delete' => array(
                                               'label' => Yii::t('int', 'Eliminar Contrato'),
                                               'url' => 'Yii::app()->controller->createUrl("mdltutorias/contratos/delete",
											                                              array("id"=>$data[CONT_ID],"command"=>"delete"))',
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
