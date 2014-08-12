<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/catedraticoscpanel/'),
	'Contratos'=>array('mdlcatedraticos/catedraticoscontratos/admin'),
	'Catedras'=>array('mdlcatedraticos/catedraticoscatedras/admin','id'=>$model->CACO_ID),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Catedraticoscatedras','url'=>array('index')),
	array('label'=>'Create Catedraticoscatedras','url'=>array('create')),
);
*/

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
             <td width="56%"><strong><span><em>ADMINISTRACION DE  CATEDRAS DEL CONTRATO</em></span></strong></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedraticoscontratos/admin',),$htmlOptions ); 
?>         
		 
</td>
<td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedraticoscatedras/admin','id'=>$model->CACO_ID),$htmlOptions ); 
?></td>

<td width="9%" align="center"><?php         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_desccontrato.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Descargar Contrato');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedraticoscontratos/download','id'=>$model->CACO_ID),$htmlOptions ); 
         ?></td>

<td width="9%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedraticoscatedras/create','id'=>$model->CACO_ID),$htmlOptions ); 
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
	'id'=>'catedraticoscatedras-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'PROG_ID', 'value'=>'$data->rel_programas->PROG_NOMBRE', 'filter'=>Catedraticoscatedras::getProgramas($_REQUEST['id']),
		'htmlOptions'=>array('width'=>'280'),),
		
		array('name'=>'CACA_INTENSIDAD', 'value'=>'$data->CACA_INTENSIDAD', 
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'80'),),
		
		array('name'=>'CAPR_ID', 'value'=>'$data->rel_catedraticos_presupuestos->Presupuesto->PRES_NOMBRE', 'filter'=>false,
		'htmlOptions'=>array('width'=>'380')),
		
		array( 
			  'name'=>'ASIGNATURAS',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> '$data->ASIGNATURAS."&nbsp;&nbsp;&nbsp;&nbsp; || &nbsp;&nbsp;&nbsp;&nbsp;".
			             CHtml::link(CHtml::image(Yii::app()->baseurl."/images/icon_search.png"),
			             array("mdlcatedraticos/catedratiasignaturascatedr/admin","id"=>$data[CACA_ID],))',
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
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
