<?php
Yii::app()->homeUrl = array('/financiero/');
$this->breadcrumbs=array(
	'Modulo Gestión Finanzas'=>array('/financiero/'),
	'Contratos'=>array('segcuenta/contratos/admin'),
	'Cuentas'=>array('segcuenta/cuentas/admin','id'=>$Cuentas->CONT_ID),
	'Seguimiento Cuenta'=>array('segcuenta/seguimientocuentas/admin','id'=>$Seguimientocuentas->CUEN_ID),
	'Devoluciones de Cuentas'=>array('admin','id'=>$model->SECU_ID),
	'Administrar',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('devolucionescuentas-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE DEVOLUCIONESCUENTAS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/seguimientocuentas/admin','id'=>$Seguimientocuentas->CUEN_ID),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/devolucionescuentas/admin','id'=>$model->SECU_ID),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/devolucionescuentas/create','id'=>$model->SECU_ID),$htmlOptions ); 
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
	'id'=>'devolucionescuentas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'DECU_MOTIVO',  'value'=>'$data->DECU_MOTIVO','htmlOptions'=>array('width'=>'200'),),
		array('name'=>'TIDO_ID', 'filter'=>false, 'value'=>'$data->rel_tipos_documentos->TIDO_NOMBRE',
		'htmlOptions'=>array('width'=>'250'),),
		array('name'=>'DECU_FECHADEVOLUCION',  'value'=>'$data->DECU_FECHADEVOLUCION','htmlOptions'=>array('width'=>'100'),),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',
              'buttons'=>array(       
			   'delete' => array(
			    'url'=>'Yii::app()->controller->createUrl("segcuenta/devolucionescuentas/delete", 
				                                            array("id"=>$data[DECU_ID],"command"=>"delete"))',
				),
			  ),
			),	
	),
)); ?>

    </td>
  </tr>
</table>
