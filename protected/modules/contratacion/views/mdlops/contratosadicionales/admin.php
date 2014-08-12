<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('opscpanel/'),
	'Adicionales Contratos'=>array('mdlops/contratosadicionales/admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Contratosadicionales','url'=>array('index')),
	array('label'=>'Create Contratosadicionales','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contratosadicionales-grid', {
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
              <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="55%"><strong><span><em>ADMINISTRACION DE CONTRATOSADICIONALES</em></span></strong></td>

<td width="10%" align="center">
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
         echo CHtml::link($image, array('mdlops/contratosadicionales/admin',),$htmlOptions ); 
?>         
		 </td>
<td width="9%" align="center">
<?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_desccontrato.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar Contratos');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/contratosadicionales/download',"opcion"=>"true"),$htmlOptions ); 
        ?>
</td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/contratosadicionales/searchContratos',),$htmlOptions ); 
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
	'id'=>'contratosadicionales-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'COAD_NUMADICIONAL', 'value'=>'$data->COAD_NUMADICIONAL','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'PERS_ID', 'value'=>'$data->cONT->Persona->nombrePersona','filter'=>Contratosadicionales::getPersonas(),),
		array('name'=>'CONT_NUMORDEN', 'value'=>'$data->CONT_NUMORDEN','htmlOptions'=>array('style'=>'text-align: center','width'=>'100'),),
		array('name'=>'CONT_ANIO', 'value'=>'$data->CONT_ANIO','htmlOptions'=>array('style'=>'text-align: center','width'=>'20'),),		
		array('name'=>'COAD_MESES', 'value'=>'$data->COAD_MESES','htmlOptions'=>array('style'=>'text-align: center','width'=>'50'),),
	    array('name'=>'COAD_DIAS', 'value'=>'$data->COAD_DIAS','htmlOptions'=>array('style'=>'text-align: center','width'=>'35'),),	
	    array('name'=>'COAD_VALOR', 'value'=>'$data->COAD_VALOR', 
		'type'=>'number', 'htmlOptions'=>array('style'=>'text-align: right','width'=>'120'),),
		
		array('name'=>'COAD_FECHAELABORACION', 'value'=>'$data->COAD_FECHAELABORACION','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'DEPE_ID', 'value'=>'$data->DEPE_NOMBRE', 'filter'=>Contratosadicionales::getDependencias()),
		
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{download}&nbsp;{update}{delete}',
              'buttons'=>array(       
               'download' => array(
			    'label'=>'Descargar Contrato',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/cont_desc.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlops/contratosadicionales/download", array("id"=>$data[COAD_ID]))',
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
