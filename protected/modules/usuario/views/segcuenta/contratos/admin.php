<?php
Yii::app()->homeUrl = array('/ususario/');
$this->breadcrumbs=array(
	'Modulo Usuario'=>array('/usuario/'),
	'Contratos'=>array('segcuenta/contratos/admin'),
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
             <?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl); ?>
              </td>
             <td><strong><span><em>ADMINISTRACION DE CONTRATOS</em></span></strong></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/usuario/',),$htmlOptions ); 
?></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/contratos/admin',),$htmlOptions ); 
?></td>
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
	'id'=>'contratos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
        array('name'=>'PERS_ID', 'filter'=>false, 'value'=>'$data->Persona->nombrePersona','htmlOptions'=>array('width'=>'300'),),
		array('name'=>'CLCO_ID', 'value'=>'$data->rel_clases_contratos->CLCO_NOMBRE',
		'filter'=>false, 'htmlOptions'=>array('width'=>'350'),),
		 array('name'=>'CONT_NUMORDEN', 'type'=>'number','value'=>'$data->CONT_NUMORDEN','htmlOptions'=>array('width'=>'100'),),
		 array('name'=>'CONT_ANIO', 'value'=>'$data->CONT_ANIO','htmlOptions'=>array('width'=>'60'),),
		 array('name'=>'MONTO', 'value'=>'$data->O+$data->T','filter'=>false,'type'=>'number','htmlOptions'=>array('width'=>'50'),),
		 array('name'=>'PORPAGAR', 'value'=>'($data->O+$data->T)-($data->VC)','filter'=>false,'type'=>'number',
		 'htmlOptions'=>array('width'=>'100'),),
		 array( 
			  'name'=>'CUENTAS',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> '$data->CUENTAS."&nbsp;&nbsp;&nbsp;&nbsp;".CHtml::link(CHtml::image(Yii::app()->baseurl."/images/icon_cuentas.png"),
			                                              array("segcuenta/cuentas/admin","id"=>$data[CONT_ID],))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'50',
								   'title' => 'Ver Cuentas del Contrato',
								   'alt' => 'Ver Cuentas del Contrato'
								  ), 
			  ),
		array( 
			  'name'=>'DOCUMENTOS',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link(CHtml::image($data->estadoExpediente),array("segcuenta/expedientedocumentos/admin",
			                                                           "id"=>$data[CONT_ID],))',
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'10',
								   'title' => 'Ver Documentos del contrato' , 
								   'alt' => 'Ver Documentos del contrato'), 
			  ),
	    ),
)); ?>

    </td>
  </tr>
</table>
