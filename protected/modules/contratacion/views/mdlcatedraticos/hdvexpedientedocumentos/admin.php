<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('catedraticoscpanel/'),
	'Personas Naturales'=>array('mdlcatedraticos/personasnaturales/admin'),
	'Hoja de vida'=>array('mdlcatedraticos/personasnaturales/view', 'id'=>$Personasnaturales->PENA_ID),
	'Digitalizacion Hoja De Vida'=>array('admin','id'=>$model->PERS_ID),
	'Administrar',
);


/*
$this->menu=array(
	array('label'=>'List Hdvexpedientedocumentos','url'=>array('index')),
	array('label'=>'Create Hdvexpedientedocumentos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('hdvexpedientedocumentos-grid', {
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
              <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="56%"><strong><span><em> DIGITALIZACION HOJA DE VIDA</em></span></strong></td>
             <td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/personasnaturales/view','id'=>$Personasnaturales->PENA_ID,),$htmlOptions ); 
?></td>

<td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/hdvexpedientedocumentos/admin','id'=>$model->PERS_ID),$htmlOptions ); 
?></td>

<td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/documental/icon_doct.png';
         $htmlOptions = array("target"=>"_blank",'class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ver Hoja De Vida Completa');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/hdvexpedientedocumentos/unirpdf','id'=>$model->PERS_ID,),$htmlOptions ); 
?></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/hdvexpedientedocumentos/create','id'=>$model->PERS_ID),$htmlOptions ); 
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
	'id'=>'hdvexpedientedocumentos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'HTDO_ID', 'value'=>'$data->rel_hdv_tipos_documentos->HTDO_NOMBRE',
		'filter'=>Hdvexpedientedocumentos::getHdvtiposdocumentos($model->PERS_ID),'htmlOptions'=>array('width'=>'380'),),
		array(
			'name'=>'HEXD_RUTA',
					'type'=>'raw',
					'htmlOptions'=>array('style'=>'text-align: center','width'=>'100'),
					'value'=>'CHtml::link("Ver Documento", Yii::app()->baseUrl.$data->HEXD_RUTA, array("target"=>"_blank"))',					  
			 ),
		array('name'=>'HEXD_FECHAINGRESO', 'value'=>'$data->HEXD_FECHAINGRESO','htmlOptions'=>array('width'=>'100'),),	
   
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
