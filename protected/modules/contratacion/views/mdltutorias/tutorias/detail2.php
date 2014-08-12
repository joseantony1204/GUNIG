<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Tutorias'=>array('tutoriascpanel/'),
	'Contratos Tutorias'=>array('mdltutorias/tutoriascontratos/adminSupervisores'),
	'Tutorias del Contrato',
);

/*
$this->menu=array(
	array('label'=>'List Tutorias','url'=>array('index')),
	array('label'=>'Create Tutorias','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tutorias-grid', {
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
              <?php  $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl);   ?>
              </td>
             <td width="56%"><strong><span><em>ADMINISTRACION DE TUTORIAS</em></span></strong></td>

<td width="9%" align="center">&nbsp;</td>
<td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriascontratos/adminSupervisores',),$htmlOptions ); 
?></td>

<td width="9%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutorias/detail2','id'=>$model->TUCO_ID),$htmlOptions ); 
         ?></td>

<td width="9%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_desccontrato.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar Contrato');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriascontratos/download','id'=>$model->TUCO_ID),$htmlOptions ); 
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
	'id'=>'tutorias-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		array('name'=>'TUTO_INTENSIDAD', 'value'=>'$data->TUTO_INTENSIDAD',
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'130'),),
		array('name'=>'TUTO_VALOR', 'filter' => false, 'value'=>'$data->TUTO_VALOR', 'type'=>'number','htmlOptions'=>array('width'=>'50'),),
		array('name'=>'TUTO_PLAZO', 'filter' => false, 'value'=>'$data->TUTO_PLAZO','htmlOptions'=>array('width'=>'250'),),
		array('name'=>'SEDE_ID', 'value'=>'$data->Sede->SEDE_NOMBRE', 'filter'=>Tutorias::getSedes($_REQUEST['id']),
		'htmlOptions'=>array('width'=>'50')),
		array('name'=>'TUPR_ID', 'value'=>'$data->Presupuesto->Presupuesto->PRES_NUM_CERTIFICADO', 'filter'=>false,
		'htmlOptions'=>array('width'=>'70')),		
		array('name'=>'TUSP_ID', 'value'=>'$data->Subprograma->TUSP_NOMBRE', 'filter'=>Tutorias::getSubProgramas($_REQUEST['id']),
		'htmlOptions'=>array('width'=>'150')),
		array('name'=>'MODULOS', 'filter' => false, 
		'value'=>'$data->MODULOS',
		'type'=>'raw',
	    'headerHtmlOptions'=>array('colspan'=>'1'),'htmlOptions'=>array('style'=>'text-align: center','width'=>'50'),),
	),
)); ?>

    </td>
  </tr>
</table>
