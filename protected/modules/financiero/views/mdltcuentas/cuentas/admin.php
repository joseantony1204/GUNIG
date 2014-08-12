<?php
Yii::app()->homeUrl = array('/financiero/');
$this->breadcrumbs=array(
	'Modulo Gestión Finanzas'=>array('/financiero/'),
	'Contratos'=>array('mdltcuentas/contratos/admin'),
	'Cuentas'=>array('admin','id'=>$model->CONT_ID),
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
              <td width="8%" align="center">
              <?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl); ?>
              </td>
             <td><strong><span><em>ADMINISTRACION DE CUENTAS</em></span></strong></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltcuentas/contratos/admin',),$htmlOptions ); 
?></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltcuentas/cuentas/admin','id'=>$model->CONT_ID),$htmlOptions ); 
?>         
		 </td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltcuentas/cuentas/create','id'=>$model->CONT_ID),$htmlOptions ); 
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
	'id'=>'cuentas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'CUEN_ID', 'value'=>'$data->CUEN_ID', 'htmlOptions'=>array('width'=>'10'),),
		array('name'=>'CUEN_NUMERO', 'value'=>'$data->CUEN_NUMERO', 'htmlOptions'=>array('width'=>'70'),),
		array('name'=>'CUEN_VALOR', 'value'=>'$data->CUEN_VALOR', 'type'=>'number','htmlOptions'=>array('width'=>'50'),),
		array('name'=>'TIPA_ID', 'value'=>'$data->rel_tipo_pago->TIPA_NOMBRE','filter'=>Cuentas::getTipospagos(),
		'htmlOptions'=>array('width'=>'120'),),
		array('name'=>'CUEN_FECHAINICIO', 'value'=>'$data->CUEN_FECHAINICIO', 'htmlOptions'=>array('width'=>'90'),),
		array('name'=>'CUEN_FECHAFINAL', 'value'=>'$data->CUEN_FECHAFINAL', 'htmlOptions'=>array('width'=>'90'),),
		array('name'=>'CUEN_FECHAINGRESO', 'value'=>'$data->CUEN_FECHAINGRESO', 'htmlOptions'=>array('width'=>'100'),),
			  	  		  
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template' => '{update}&nbsp;&nbsp;{delete}',
	          ),
	),
)); ?>

    </td>
  </tr>
</table>
