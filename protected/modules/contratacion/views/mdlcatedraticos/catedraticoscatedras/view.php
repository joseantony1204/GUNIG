<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/catedraticoscpanel/'),
	'Catedras'=>array('mdlcatedraticos/catedraticoscatedras/view'),
	'Administrar',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('catedraticoscatedras-grid', {
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
             <td width="67%"><strong><span><em>ADMINISTRACION DE  GENERAL DE CATEDRAS</em></span></strong></td>

<td width="8%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('catedraticoscpanel/',),$htmlOptions ); 
?></td>
<td width="8%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedraticoscatedras/view',),$htmlOptions ); 
?></td>

<td width="9%" align="center">
         <?php
		 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/liquiall.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Aprobar todas las catedras para la liquidación');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedraticoscatedras/liquidacion',),$htmlOptions ); 
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
	'id'=>'catedraticoscatedras-grid',
	'dataProvider'=>$model->catedras(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'CACO_ID', 'value'=>'$data->rel_catedraticos_contratos->rel_personas_naturales_catedraticos->
		rel_personas_naturales->nombreCompleto', 'filter'=>Catedraticoscatedras::getPersonas(),
		'htmlOptions'=>array('width'=>'300')),
		
		array('name'=>'PROG_ID', 'value'=>'$data->rel_programas->PROG_NOMBRE', 'filter'=>Catedraticoscatedras::getPrograma(),
		'htmlOptions'=>array('width'=>'280'),),
		
		array('name'=>'CACA_INTENSIDAD', 'value'=>'$data->CACA_INTENSIDAD', 
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'80'),),
		
		array('name'=>'CAPR_ID', 'value'=>'$data->rel_catedraticos_presupuestos->Presupuesto->PRES_NOMBRE', 'filter'=>false,
		'htmlOptions'=>array('width'=>'380')),
		
		array( 
			  'name'=>'ASIGNATURAS',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> '$data->ASIGNATURAS',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'10',
								   'title' => 'Ver Catedras',
								   'alt' => 'Ver Catedras'
								  ), 
			  ),
			  
	     array( 
			  'name'=>'CACA_ESTADO',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=>'CHtml::image($data->estadoCatedra)',			  
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'10',
								   'title' => 'Pendiente / Tramitando / Aprobada ' , 
								   'alt' => 'Pendiente / Tramitando / Aprobada '), 
			 ),		  	
	),
)); ?>

    </td>
  </tr>
</table>
