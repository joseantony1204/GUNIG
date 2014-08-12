<?php
$this->breadcrumbs=array(
	'Modulo Gestion Documental'=>array('/gestiondocumental/'),
	'cpanel enexraex'=>array('enexraexcpanel/'),
	'Radicados Externos'=>array('radicadosexternos/admin'),
	'Enexraex'=>array('enexraex/detail','id'=>$model->RAEX_ID),
	'Modulos de Enexraex',
);

/*
$this->menu=array(
	array('label'=>'List Descuentosatributos','url'=>array('index')),
	array('label'=>'Create Descuentosatributos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('penaraex-grid', {
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
              <td width="6%" align="center"><?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE REMITENTES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
       	 echo CHtml::link($image, array('rcdarchivo/radicadosexternos/admin/'),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
		 echo CHtml::link($image, array('rcdarchivo/enexraex/detail','id'=>$model->RAEX_ID),$htmlOptions );  
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
		 echo CHtml::link($image, array('rcdarchivo/enexraex/create','id'=>$model->RAEX_ID),$htmlOptions ); 
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
	'id'=>'penaraex-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$Penaraex,
	'columns'=>array(
	
        //array('name'=>'EERE_ID', 'value'=>'$data->EERE_ID','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'RAEX_ID', 'value'=>'$data->RAEX_ID','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'ENEX_ID', 'value'=>'$data->rel_entesexternos->ENEX_NOMBRE  . " (". $data->rel_entesexternos->ENEX_CIUDAD . ") "','htmlOptions'=>array('width'=>'95'),),
		//array('name'=>'ENEX_ID', 'value'=>'$data->ENEX_ID','htmlOptions'=>array('width'=>'95'),),
			
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',
              'buttons'=>array(       
			   'view' => array(
			    'url'=>'Yii::app()->controller->createUrl("rcdarchivo/radicadosinternos/view", array("id"=>$data[RAIN_ID],))',
				),
			  ),
			  
			),
	),
)); ?>

    </td>
  </tr>
</table>