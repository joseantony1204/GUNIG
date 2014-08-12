<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Contratos'=>array('mdltutorias/tutoriascontratos/adminSupervisores'),
	'Cuentas'=>array('mdltutorias/cuentas/admin','id'=>$Cuentas->CONT_ID),
	'Seguimiento Cuenta'=>array('mdltutorias/seguimientocuentas/admin','id'=>$Seguimientocuentas->CUEN_ID),
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
              <td width="6%" align="center"><?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl); ?></td>
             <td><strong><span><em>ADMINISTRACION DE DEVOLUCIONES DE CUENTAS</em></span></strong></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/seguimientocuentas/admin','id'=>$Seguimientocuentas->CUEN_ID),$htmlOptions ); 
?></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/devolucionescuentas/admin','id'=>$model->SECU_ID),$htmlOptions ); 
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
	'id'=>'devolucionescuentas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'DECU_MOTIVO',  'value'=>'$data->DECU_MOTIVO','htmlOptions'=>array('width'=>'200'),),
		array('name'=>'TIDO_ID', 'filter'=>false, 'value'=>'$data->rel_tipos_documentos->TIDO_NOMBRE',
		'htmlOptions'=>array('width'=>'250'),),
		array('name'=>'DECU_FECHADEVOLUCION',  'value'=>'$data->DECU_FECHADEVOLUCION','htmlOptions'=>array('width'=>'100'),),
	),
)); ?>

    </td>
  </tr>
</table>
