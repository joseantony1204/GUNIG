<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/ordenescpanel/index'),
	'Administrar',
	//$_POST['supervisor']
);





/*
$this->menu=array(
	array('label'=>'List Modeloordenes','url'=>array('index')),
	array('label'=>'Create Modeloordenes','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('modeloordenes-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php 
$numero = $model->rel_contrato->CONT_NUMORDEN; 
$tipo = $model->rel_contrato->tICO->TICO_NOMBRE;
$clase = $model->rel_contrato->cLCO->CLCO_NOMBRE;
$anio = $model->rel_contrato->CONT_ANIO; 
?>



<table width="100%" border="0" align="center">
  <tr>
    <td><table width="100%" border="0" align="center">
      <tr>
        <td>
        <fieldset>
          <table width="100%" border="0" align="center">
            <tr>
              <td width="6%" align="center">  <?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
			  echo $image = CHtml::image($imageUrl);
		    ?>   </td>
             <td width="63%"><strong><span><em>ADMINITRACION DE CONTRATOS - SUPERVISOR</em></span></strong></td>

<td width="7%" align="center">&nbsp;</td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al Cpanel');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/contratacion/ordenescpanel/index',),$htmlOptions ); 
?></td>
         
     

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/modeloordenes/adminsupervisores',),$htmlOptions ); 
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
	'id'=>'modeloordenes-grid',
	'dataProvider'=>$model->searchSupervisores(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	//'MOOR_ID',
	array('name'=>'TICO_ID','value'=>'$data->rel_contrato->tICO->TICO_NOMBRE','filter'=>Modeloordenes::getTipoContratos(),'htmlOptions'=>array('width'=>'40'),),
	array('name'=>'CLCO_ID', 'value'=>'$data->rel_contrato->cLCO->CLCO_NOMBRE', 'filter'=>Modeloordenes::getClaseContratos(), 
	'htmlOptions'=>array('width'=>'100'),),
	array('name'=>'CONT_NUMORDEN', 'value'=>'$data->rel_contrato->CONT_NUMORDEN', 'htmlOptions'=>array('width'=>'50'),),
	array('name'=>'CONT_FECHA', 'value'=>'$data->rel_contrato->CONT_ANIO', 'filter'=>false,'htmlOptions'=>array('width'=>'50'),),
	//array('name'=>'CONT_ANIO', 'value'=>'$data->rel_contrato->CONT_ANIO','filter' => false,'htmlOptions'=>array('width'=>'50'),),
	array('name'=>'PERS_ID', 'value'=>'$data->rel_contrato->Persona->nombrePersona','filter'=>Modeloordenes::getPersonas(),
	'htmlOptions'=>array('width'=>'150'),),
		array('name'=>'MOOR_VALOR', 'filter' => false, 'value'=>'$data->MOOR_VALOR','type'=>'number','htmlOptions'=>array('width'=>'100'),),	
//	array('name'=>'MOOR_OBJETO', 'filter' => false, 'value'=>'$data->MOOR_OBJETO','htmlOptions'=>array('width'=>'300'),),
		array('name'=>'MOOR_ANIOS', 'filter' => false, 'value'=>'$data->MOOR_ANIOS','htmlOptions'=>array('width'=>'40'),),
		array('name'=>'MOOR_MESES', 'filter' => false, 'value'=>'$data->MOOR_MESES','htmlOptions'=>array('width'=>'40'),),
		array('name'=>'MOOR_DIAS', 'filter' => false, 'value'=>'$data->MOOR_DIAS','htmlOptions'=>array('width'=>'40'),),
		
		//array('name'=>'', 'filter' => false, 'value'=>'$data->getVenceContratos','htmlOptions'=>array('width'=>'40'),),
		
	/*	array('name'=>'ESTADO',
			  'type'=>'html', 
			  'filter' => false, 
			  'value'=> 'CHtml::link(CHtml::image($data->imagenEstado))',
			   'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'50',
								   'title' => 'Estado del Contrato' , 
								   'alt' => 'Estado del Contrato'), 
			  ),
		
		
		*/
	
				
//'CONT_ID',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			
			 'template'=>'{next}&nbsp;{evaluacion}&nbsp;{cuentas}',
			// 'template'=>'{download}&nbsp;{next}{delete}',
              'buttons'=>array(       
               'evaluacion' => array(
			    'label'=>'Evaluación del Contrato',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/contratacion/grid_view.png',
			    'url'=>'Yii::app()->controller->createUrl("mdlordenes/modeloordenes/viewsupervisores", array("id"=>$data[MOOR_ID]))',
				),	
				'next' => array(
			    'label'=>'Supervisión del Contrato',
				'label' => Yii::t('int', 'Ver Documentos del contrato'),
                'url' => 'Yii::app()->controller->createUrl("../gestiondocumental/mdlexpediente/expedientedocumentos/adminsupervisor",
				array("id"=>$data[CONT_ID]))',
                'imageUrl' => Yii::app()->baseurl.'/images/icon_doc.png',
				),
				'cuentas' => array(
			    'label'=>'Ver Cuentas del Contrato',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/icon_view.png',
			    //'url'=>'Yii::app()->controller->createUrl("mdlordenes/modeloordenes/viewsupervisores", array("id"=>$data[CONT_ID]))',
				),
				
				'delete' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlordenes/modeloordenes/delete", array("id"=>$data[MOOR_ID],"command"=>"delete"))',
				),
				'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/crosse.png',
			    'deleteConfirmation'=>'¿Seguro que quiere eliminar el Contrato?', // mensaje de confirmación de borrado
			    'afterDelete'=>'function(link,success,data){ if(success) alert("Contrato borrado exitosamente..."); }',
				),
				
	
			
		),
	),
)); ?>







    </td>
  </tr>
</table>
