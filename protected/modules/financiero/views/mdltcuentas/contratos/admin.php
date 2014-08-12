<?php
Yii::app()->homeUrl = array('/financiero/');
$this->breadcrumbs=array(
	'Modulo Gestión Finanzas'=>array('/financiero/'),
	'Cuentas'=>array('mdltcuentas/cuentas/cuentasNoTramitadas'),
	'Contratos'=>array('mdltcuentas/contratos/admin'),
	'Administrar',
);


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
             	<?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl); ?>
              </td>
             <td><strong><span><em>ADMINISTRACION DE CONTRATOS</em></span></strong></td>


 
<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltcuentas/cuentas/cuentasNoTramitadas',),$htmlOptions ); 
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
	'dataProvider'=>$model->buscarContratos(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
        array('name'=>'PERS_ID', 'filter'=>false, 'value'=>'$data->Persona->nombrePersona','htmlOptions'=>array('width'=>'300'),),
		array('name'=>'TICO_ID', 'value'=>'$data->rel_tipos_contratos->TICO_NOMBRE','filter'=>Contratos::getContratostipo(),
		'htmlOptions'=>array('width'=>'140'),),
		array('name'=>'CLCO_ID', 'value'=>'$data->rel_clases_contratos->CLCO_NOMBRE','filter'=>Contratos::getContratosclase(),
		'htmlOptions'=>array('width'=>'250'),),
		 array('name'=>'CONT_NUMORDEN', 'value'=>'$data->CONT_NUMORDEN','htmlOptions'=>array('width'=>'120'),),
		 array('name'=>'CONT_ANIO', 'value'=>'$data->CONT_ANIO','htmlOptions'=>array('width'=>'80'),),
		 array('name'=>'MONTO', 'value'=>'$data->O+$data->T+$data->M','filter'=>false,'type'=>'number','htmlOptions'=>array('width'=>'50'),),
		 array('name'=>'PORPAGAR', 'value'=>'($data->O+$data->T+$data->M)-($data->VC)','filter'=>false,'type'=>'number',
		 'htmlOptions'=>array('width'=>'110'),),
		 array( 
			  'name'=>'CUENTAS',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> '$data->CUENTAS."&nbsp;&nbsp;&nbsp;&nbsp;".CHtml::link(CHtml::image(Yii::app()->baseurl."/images/icon_cuentas.png"),
			                                              array("mdltcuentas/cuentas/admin","id"=>$data[CONT_ID],))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'12',
								   'title' => 'Ver Cuentas del Contrato',
								   'alt' => 'Ver Cuentas del Contrato'
								  ), 
			  ),
			  
		array( 
			  'name'=>'DOCUMENTOS',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link(CHtml::image($data->estadoExpediente),array("mdltcuentas/expedientedocumentos/admin",
			                                                           "id"=>$data[CONT_ID],))',
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'10',
								   'title' => 'Sin Documentos / Con Documentos ' , 
								   'alt' => 'Sin Documentos / Con Documentos  '), 
			  ),
			  
		
	    ),
)); ?>

    </td>
  </tr>
</table>
