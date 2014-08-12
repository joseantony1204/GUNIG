<?php
Yii::app()->homeUrl = array('/financiero/');
$this->breadcrumbs=array(
	'Modulo Gestión Finanzas'=>array('/financiero/'),
	'Cuentas'=>array('mdltcuentas/cuentas/cuentas'),
	'Documentos del Contrato'=>array('admin','id'=>$model->CONT_ID),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Expedientedocumentos','url'=>array('index')),
	array('label'=>'Create Expedientedocumentos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('expedientedocumentos-grid', {
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
             <td width="56%"><strong><span><em>ADMINISTRACION DE EXPEDIENTE - DOCUMENTOS DEL CONTRATO
               
             </em></span></strong></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltcuentas/cuentas/cuentasNoTramitadas',),$htmlOptions ); 
?>         
		 
</td>
<td width="9%" align="center">
  <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltcuentas/expedientedocumentos/admin','id'=>$model->CONT_ID),$htmlOptions ); 
?>
</td>

<td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/icon_doct.png';
         $htmlOptions = array("target"=>"_blank","class" => "thumbnail",
		                      "rel" => "tooltip","data-title" => "Ver Todos los Documentos Contrato");
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltcuentas/expedientedocumentos/unirpdf','id'=>$model->CONT_ID),$htmlOptions ); 
?></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltcuentas/expedientedocumentos/create','id'=>$model->CONT_ID),$htmlOptions ); 
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
	'id'=>'expedientedocumentos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'TIDO_ID', 'value'=>'$data->rel_tipos_documentos->TIDO_NOMBRE',
		'filter'=>Expedientedocumentos::getTiposdocumentos($model->CONT_ID),
		'htmlOptions'=>array('width'=>'350'),),
		array('name'=>'EXDO_FECHAVENCIMIENTO', 'value'=>'$data->EXDO_FECHAVENCIMIENTO','htmlOptions'=>array('width'=>'100'),),
		array(
			'name'=>'EXDO_RUTA',
					'type'=>'raw',
					'htmlOptions'=>array('style'=>'text-align: center','width'=>'200'),
					'value'=>'CHtml::link("Ver Documento", Yii::app()->baseUrl.$data->EXDO_RUTA, array("target"=>"_blank"))',					  
			 ),
	),
)); ?>

    </td>
  </tr>
</table>
