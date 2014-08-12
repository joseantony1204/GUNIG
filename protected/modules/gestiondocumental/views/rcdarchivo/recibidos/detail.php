<?php
$this->breadcrumbs=array(
	'Modulo Gestion Documental'=>array('/gestiondocumental/'),
	'cpanel recibidos'=>array('recibidoscpanel/'),
	'Radicados Internos'=>array('radicadosinternos/admin'),
	'Recibidos'=>array('recibidos/detail','id'=>$model->RAIN_ID),
	'Modulos de Recibidos',
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
              <td width="6%" align="center"><img src="../images/setting.png" width="60" height="70" /></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE RECIBIDOS</em></span></strong></td>

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
		 echo CHtml::link($image, array('rcdarchivo/recibidos/detail','id'=>$model->RAIN_ID),$htmlOptions );  
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
		 echo CHtml::link($image, array('rcdarchivo/recibidos/create','id'=>$model->RAIN_ID),$htmlOptions ); 
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
	'id'=>'recibidos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$Recibidos,
	'columns'=>array(
	
        //array('name'=>'RECI_ID', 'value'=>'$data->RECI_ID','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'RAIN_ID', 'value'=>'$data->RAIN_ID','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'RECI_FECHA', 'value'=>'$data->RECI_FECHA','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'PENA_ID', 'value'=>'$data->rel_personasnaturales->nombreCompleto', 'filter'=>Recibidos::getPersonas(),'htmlOptions'=>array('width'=>'300'),),
			
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