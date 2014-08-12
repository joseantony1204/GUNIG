<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/tutoriascpanel/'),
	'Administrar',
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
         echo CHtml::link($image, array('/contratacion/tutoriascpanel/index',),$htmlOptions ); 
?></td>
         
     

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriascontratos/adminSupervisores',),$htmlOptions ); 
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
	'id'=>'tutoriascontratos-grid',
	'dataProvider'=>$model->searchSupervisores(),
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
	'value'=>'CHtml::link($data->TUTORIAS,Yii::app()->createUrl("contratacion/mdltutorias/tutorias/detail2",
	array("id"=>$data->primaryKey)))','type'=>'raw',
	'headerHtmlOptions'=>array('colspan'=>'1'),'htmlOptions'=>array('style'=>'text-align: center','width'=>'85'),),			
	array( 
			  'name'=>'DOCUMENTOS',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link(CHtml::image($data->estadoExpediente),array("mdltutorias/expedientedocumentos/adminSupervisor",
			                                                           "id"=>$data[CONT_ID],))',
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'10',
								   'title' => 'Sin Documentos / Con Documentos ' , 
								   'alt' => 'Sin Documentos / Con Documentos '), 
			  ),
			  
	array( 
			  'name'=>'CUENTAS',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link(CHtml::image($data->cuentas),array("mdltutorias/cuentas/admin",
			                                                           "id"=>$data[CONT_ID],))',
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'10',
								   'title' => 'Ver Cuentas del Contrato' , 
								   'alt' => 'Ver Cuentas del Contrato'), 
			  ),
	),
)); ?>

    </td>
  </tr>
</table>
