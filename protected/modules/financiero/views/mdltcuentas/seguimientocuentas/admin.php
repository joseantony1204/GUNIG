<?php
Yii::app()->homeUrl = array('/financiero/');
$this->breadcrumbs=array(
	'Modulo Gestión Finanzas'=>array('/financiero/'),
	'Cuentas'=>array('mdltcuentas/cuentas/cuentas',),
	'Seguimiento Cuenta'=>array('admin','id'=>$model->CUEN_ID),
	'Administrar',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('seguimientocuentas-grid', {
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
             <td width="63%">
              <?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl); ?>
             <strong><span><em>ADMINISTRACION DE SEGUIMIENTO DE CUENTAS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltcuentas/cuentas/cuentasNoTramitadas',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltcuentas/seguimientocuentas/admin','id'=>$model->CUEN_ID),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltcuentas/seguimientocuentas/create','id'=>$model->CUEN_ID),$htmlOptions ); 
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
	'id'=>'seguimientocuentas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'SEUD_ID', 'filter'=>false, 'value'=>'$data->rel_users_dependencias->rel_dependencias->DEPE_NOMBRE',
		'htmlOptions'=>array('width'=>'150'),),
		array( 
			  'name'=>'SECU_ESTADO',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::image($data->imagenEstado)',
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'50',
								   'title' => 'Recibida / Devuelta' , 
								   'alt' => 'Recibida / Devuelta'), 
			  ),
		array('name'=>'SECU_FECHAINGRESO', 'filter'=>false, 'value'=>'$data->SECU_FECHAINGRESO','htmlOptions'=>array('width'=>'140'),),
		array('name'=>'SECU_NUMORDENPAGO',  'value'=>'$data->SECU_NUMORDENPAGO','htmlOptions'=>array('width'=>'120'),),
		array('name'=>'SECU_VRORDENPAGO',  'value'=>'$data->SECU_VRORDENPAGO','htmlOptions'=>array('width'=>'120'),),
		array('name'=>'SECU_CODIGOCDP',  'value'=>'$data->SECU_CODIGOCDP','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'SECU_NUMCHECQUE',  'value'=>'$data->SECU_NUMCHECQUE','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'SECU_VALORCHEQUE',  'value'=>'$data->SECU_VALORCHEQUE','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'SECU_FECHAPAGO',  'value'=>'$data->SECU_FECHAPAGO','htmlOptions'=>array('width'=>'100'),),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{view}&nbsp;{update}&nbsp;{delete}',
              'buttons'=>array(       
			   'view' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdltcuentas/devolucionescuentas/admin", array("id"=>$data[SECU_ID],))',
				),
			   'update' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdltcuentas/seguimientocuentas/update", array("id"=>$data[SECU_ID],))',
				),
			   'delete' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdltcuentas/seguimientocuentas/delete", 
				                                            array("id"=>$data[SECU_ID],"command"=>"delete"))',
				),
			  ),
			),
	),
)); ?>

    </td>
  </tr>
</table>
