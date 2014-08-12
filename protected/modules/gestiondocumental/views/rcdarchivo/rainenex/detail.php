<?php
$this->breadcrumbs=array(
	'Modulo Gestion Documental'=>array('/gestiondocumental/'),
	'cpanel rainenex'=>array('rainenexcpanel/'),
	'Radicados Internos'=>array('radicadosinternos/admin'),
	'Rainenex'=>array('rainenex/detail','id'=>$model->RAIN_ID),
	'Modulos de Rainenex',
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
	$.fn.yiiGridView.update('rainenex-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE DESTINATARIOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
       	 echo CHtml::link($image, array('rcdarchivo/radicadosinternos/admin/'),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
		 echo CHtml::link($image, array('rcdarchivo/rainenex/detail','id'=>$model->RAIN_ID),$htmlOptions );  
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
		 echo CHtml::link($image, array('rcdarchivo/rainenex/create','id'=>$model->RAIN_ID),$htmlOptions ); 
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
	'id'=>'rainenex-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$Rainenex,
	'columns'=>array(
	    //array('name'=>'RIEE_ID', 'value'=>'$data->RIEE_ID','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'RAIN_ID', 'value'=>'$data->RAIN_ID','htmlOptions'=>array('width'=>'50'),),
		array('name'=>'RIEE_GUIAENVIO', 'value'=>'$data->RIEE_GUIAENVIO','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'ENEX_ID', 'value'=>'$data->rel_entesexternos->ENEX_NOMBRE  . " (". $data->rel_entesexternos->ENEX_CIUDAD . ") "','htmlOptions'=>array('width'=>'300'),),
		array('name'=>'MENS_ID', 'value'=>'$data->mENS->rel_personasnaturales->PENA_NOMBRES. " ". $data->mENS->rel_personasnaturales->PENA_APELLIDOS','htmlOptions'=>array('width'=>'300'),),
		array('name'=>'RIEE_RECIBIO', 'value'=>'$data->RIEE_RECIBIO','htmlOptions'=>array('width'=>'150'),),
		//array('name'=>'PENA_ID', 'value'=>'$data->rel_personasnaturales->nombreCompleto', 'filter'=>Persnatudependencias::getPersonas()),
		//array('name'=>'ENEX_ID', 'value'=>'$data->rel_entesexternos->ENEX_NOMBRE', 'filter'=>Rainenex::getEntesexternos()),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}{update}',
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