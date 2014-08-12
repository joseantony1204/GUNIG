<?php
$this->breadcrumbs=array(
	'Radicadosinternos'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Radicadosinternos','url'=>array('index')),
	array('label'=>'Create Radicadosinternos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('radicadosinternos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE RADICADOS INTERNOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('archivocpanel/index',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/radicadosinternos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/radicadosinternos/create',),$htmlOptions ); 
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
   <td colspan="2">
   <?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
   </td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'radicadosinternos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	array('name'=>'RAIN_ID', 'value'=>'$data->RAIN_ID', 'htmlOptions'=>array('width'=>'90'),),
	array('name'=>'RAIN_FECHA', 'value'=>'$data->RAIN_FECHA', 'htmlOptions'=>array('width'=>'175'),),
	array('name'=>'RAIN_ASUNTO', 'value'=>'$data->RAIN_ASUNTO', 'htmlOptions'=>array('width'=>'400'),),
	//array('name'=>'RAIN_NUMEROANEXOS', 'value'=>'$data->RAIN_NUMEROANEXOS', 'htmlOptions'=>array('width'=>'150'),),
	array('name'=>'RAIN_TIPO','filter'=>array('Interno a Interno'=> 'Interno a Interno', 'Interno a Externo' => 'Interno a Externo'), 'htmlOptions'=>array('width'=>'140'),),
	array( 
			  'name'=>'DE',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link($data->ENVIA,array("rcdarchivo/penarainenvia/detail","id"=>$data[RAIN_ID],))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'50',
								   'title' => 'Ver Pers. Envian',
								   'alt' => 'Ver Pers. Envian'
								  ), 
			  ),
	array( 
			  'name'=>'PARA: INTERNO',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link($data->DESTINOINTERNO,array("rcdarchivo/penaraindestino/detail","id"=>$data[RAIN_ID],))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'60',
								   'title' => 'Ver Pers. Reciben',
								   'alt' => 'Ver Pers. Reciben'
								  ), 
			  ),
	array( 
			  'name'=>'PARA: EXTERNO',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link($data->DESTINOEXTERNO,array("rcdarchivo/rainenex/detail","id"=>$data[RAIN_ID],))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'60',
								   'title' => 'Ver Pers. Reciben',
								   'alt' => 'Ver Pers. Reciben'
								  ), 
			  ),
			  
	/*array( 
			  'name'=>'RECIBIDOS',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link(CHtml::image($data->imagenRecibidos),array("rcdarchivo/recibidos/detail",
			                                                                 "id"=>$data[RAIN_ID],))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'80',
								   'title' => 'Recibidos',
								   'alt' => 'Recibidos'
								  ), 
			  ),*/
	array( 
			  'name'=>'RAIN_ESTADO',
			  'type'=>'html',
			  'filter'=>array('0'=> 'ACTIVO', '1' => 'ANULADO'),
			  'value'=> 'CHtml::link(CHtml::image($data->imagenEstado),array("rcdarchivo/radicadosinternos/changeState",
			                                                                 "radicado"=>$data[RAIN_ID],
																			 "estado"=>$data[RAIN_ESTADO]))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'75',
								   'title' => 'Activar / Anular',
								   'alt' => 'Activar /  Anular'
								  ), 
			  ),
	/*array(
			'name'=>'RAIN_ESCANEORUTA',
					'type'=>'raw',
					'htmlOptions'=>array('style'=>'text-align: center','width'=>'200'),
					'value'=>'CHtml::link("Ver Documento", Yii::app()->baseUrl.$data->RAIN_ESCANEORUTA, array("target"=>"_blank"))',			  
			 ),*/
	
	array( 
			  'name'=>'RAIN_ESCANEORUTA',
			  'type'=>'raw',
			  'filter'=>false,
			  'value'=>  'CHtml::link(Radicadosinternos::getverArchivo($data["RAIN_ESCANEORUTA"]),
									 Radicadosinternos::getLinkValue($data), $data["RAIN_ESCANEORUTA"]==null? array("target"=>"_self") : array("target"=>"_blank")
										)',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'50',
								   'title' => 'Ver Documento',
								   'alt' => 'Ver Documento'
								  ), 
			  ),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{view}',
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
