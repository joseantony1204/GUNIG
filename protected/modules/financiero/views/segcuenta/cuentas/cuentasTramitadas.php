<?php
Yii::app()->homeUrl = array('/financiero/');
$this->breadcrumbs=array(
	'Modulo Gestión Finanzas'=>array('/financiero/'),
	'Cuentas'=>array('cuentasTramitadas',),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Cuentas','url'=>array('index')),
	array('label'=>'Create Cuentas','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cuentas-grid', {
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
              <td width="6%" align="center"><?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl); ?></td>
              <td width="52%"><strong><span><em>ADMINISTRACION DE CUENTAS - </em></span></strong><span><em><strong> TRAMITADAS</strong></em></span></td>
              <td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
     echo CHtml::link($image, array('segcuenta/contratos/admin','id'=>$Cuentas->CONT_ID),$htmlOptions ); 
?></td>
              <td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/cuentas/cuentasTramitadas',),$htmlOptions ); 
?></td>
              <td width="14%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/icon_ctaNtra.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ver Cuentas No Tramitadas');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/cuentas/cuentasNoTramitadas',),$htmlOptions ); 
?></td>
              <td width="10%" align="center"><?php
         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/icon_ctatramit.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar reporte de cuentas tramitadas');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/cuentas/reporteCuentasS',),$htmlOptions ); 
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
	'id'=>'cuentas-grid',
	'dataProvider'=>$Cuentas->buscarCuentasTramitadas(),
	'type'=>'striped bordered condensed',
    'filter'=>$Cuentas,
	'columns'=>array(
		array('name'=>'CUEN_FECHAINGRESO', 'value'=>'$data->CUEN_FECHAINGRESO',  'filter'=>false, 'htmlOptions'=>array('width'=>'140'),),
		array('name'=>'PERS_ID', 'filter'=>Cuentas::getPersonas(), 'value'=>'$data->rel_contratos->Persona->nombrePersona',
		'htmlOptions'=>array('width'=>'220'),),
		array('name'=>'CLCO_ID', 'value'=>'$data->rel_contratos->rel_clases_contratos->CLCO_NOMBRE','filter'=>Cuentas::getContratosclase(),
		'htmlOptions'=>array('width'=>'100'),),		
		array('name'=>'CONT_NUMORDEN', 'value'=>'$data->CONT_NUMORDEN', 'htmlOptions'=>array('width'=>'60'),),		
		array('name'=>'CUEN_FECHAINICIO', 'value'=>'$data->CUEN_FECHAINICIO', 'htmlOptions'=>array('width'=>'70'),),
		array('name'=>'CUEN_FECHAFINAL', 'value'=>'$data->CUEN_FECHAFINAL', 'htmlOptions'=>array('width'=>'70'),),
		array('name'=>'TIPA_ID', 'value'=>'$data->rel_tipo_pago->TIPA_NOMBRE','filter'=>Cuentas::getTipospagos(),
		'htmlOptions'=>array('width'=>'60'),),
		array('name'=>'CUEN_VALOR', 'value'=>'$data->CUEN_VALOR', 'type'=>'number',
		'htmlOptions'=>array('width'=>'30','style'=>'text-align: right',),),

		  
		array( 
			  'name'=>'CUEN_ESTADO',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link(CHtml::image($data->estadoCuenta),array("segcuenta/cuentas/changeState",
			                                                           "id"=>$data[CUEN_ID], "estado"=>$data[CUEN_ESTADO]))',			  
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'50',
								   'title' => 'Estado de la cuenta' , 
								   'alt' => 'Estado de la cuenta'), 
			  ),	
	  
			  
		 
		array( 
			  'name'=>'ORDEN',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link(CHtml::image($data->imagenOrden),array("segcuenta/cuentas/generarOrden",
			                                                            "id"=>$data[CUEN_ID], "estado"=>$data[CUEN_ESTADO]))',			  
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'50',
								   'title' => 'Descargar orden de pago' , 
								   'alt' => 'Descargar orden de pago'), 
			  ),	  
			  
		array( 
			  'name'=>'DOCUMENTOS',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link(CHtml::image($data->estadoExpediente),array("segcuenta/expedientedocumentos/admin",
			                                                           "id"=>$data[CONT_ID],))',
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'10',
								   'title' => 'Sin Documentos / Con Documentos ' , 
								   'alt' => 'Sin Documentos / Con Documentos  '), 
			  ),
			  	  			  	  		  
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template' => '{ver}',
              'buttons' => array(
                                'ver' => array(
                                               'label' => Yii::t('int', 'Ir al Seguimiento de la Cuenta'),
                                               'url' => 'Yii::app()->controller->createUrl("segcuenta/seguimientocuentas/admin",
											                                                          array("id"=>$data[CUEN_ID]))',
                                               'imageUrl' => Yii::app()->baseurl.'/images/icon_view.png',
                                               ),			   			   		  
			                    ),
	          ),
	),
)); ?>

    </td>
  </tr>
</table>
