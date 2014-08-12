<?php
$this->breadcrumbs=array(
	'Modulo Gestion Documental'=>array('/gestiondocumental/'),
	'cpanel penarainenvia'=>array('penarainenviacpanel/'),
	'Radicados Internos'=>array('radicadosinternos/admin'),
	'Penarainenvia'=>array('penarainenvia/detail','id'=>$model->RAIN_ID),
	'Modulos de Penarainenvia',
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
	$.fn.yiiGridView.update('penarainenvia-grid', {
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
       	 echo CHtml::link($image, array('rcdarchivo/radicadosinternos/admin/'),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
		 echo CHtml::link($image, array('rcdarchivo/penarainenvia/detail','id'=>$model->RAIN_ID),$htmlOptions );  
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
		 echo CHtml::link($image, array('rcdarchivo/penarainenvia/create','id'=>$model->RAIN_ID),$htmlOptions ); 
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
	'id'=>'penarainenvia-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$Penarainenvia,
	'columns'=>array(
	
        //array('name'=>'PNRE_ID', 'value'=>'$data->PNRE_ID','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'RAIN_ID', 'value'=>'$data->RAIN_ID','htmlOptions'=>array('width'=>'20'),),
		array('name'=>'PEND_ID', 'value'=>'$data->rel_persnatudependencias->rel_personasnaturales->PENA_NOMBRES  . " ". $data->rel_persnatudependencias->rel_personasnaturales->PENA_APELLIDOS  . " (". $data->rel_persnatudependencias->dEPE->DEPE_NOMBRE  . " - ". $data->rel_persnatudependencias->cARG->CARG_NOMBRE .")"','htmlOptions'=>array('width'=>'400'),),
			
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