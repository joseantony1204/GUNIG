<?php
$this->breadcrumbs=array(
	'Radicadosexternos'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Radicadosexternos','url'=>array('index')),
	array('label'=>'Create Radicadosexternos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('radicadosexternos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE RADICADOS EXTERNOS</em></span></strong></td>

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
         echo CHtml::link($image, array('rcdarchivo/radicadosexternos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('rcdarchivo/radicadosexternos/create',),$htmlOptions ); 
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
<div class="search-form" style="display:none" >
</div><!-- search-form -->
   </td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'radicadosexternos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	array('name'=>'RAEX_ID', 'value'=>'$data->RAEX_ID', 'htmlOptions'=>array('width'=>'90'),),
	array('name'=>'RAEX_FECHARECIBIDO', 'value'=>'$data->RAEX_FECHARECIBIDO', 'htmlOptions'=>array('width'=>'130'),),
	//array('name'=>'RAEX_GUIAENVIO', 'value'=>'$data->RAEX_GUIAENVIO', 'htmlOptions'=>array('width'=>'200'),),
	array('name'=>'RAEX_NUMERODOCUMENTO', 'value'=>'$data->RAEX_NUMERODOCUMENTO', 'htmlOptions'=>array('width'=>'120'),),
	array('name'=>'RAEX_FECHADOCUMENTO', 'value'=>'$data->RAEX_FECHADOCUMENTO', 'htmlOptions'=>array('width'=>'80'),),
	array('name'=>'RAEX_ASUNTO', 'value'=>'$data->RAEX_ASUNTO', 'htmlOptions'=>array('width'=>'320'),),
	//array('name'=>'RAEX_NUMEROANEXOS', 'value'=>'$data->RAEX_NUMEROANEXOS', 'htmlOptions'=>array('width'=>'200'),),
	//array('name'=>'EMCO_ID', 'value'=>'$data->rel_empresascorreos->EMCO_NOMBRE', 'filter'=>Radicadosexternos::getEmpresascorreos()),
	array( 
			  'name'=>'DE',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link($data->DE,array("rcdarchivo/enexraex/detail","id"=>$data[RAEX_ID],))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'30',
								   'title' => 'Ver Pers. Envian',
								   'alt' => 'Ver Pers. Envian'
								  ), 
			  ),
	array( 
			  'name'=>'PARA',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link($data->PARA,array("rcdarchivo/penaraex/detail","id"=>$data[RAEX_ID],))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'30',
								   'title' => 'Ver Pers. Reciben',
								   'alt' => 'Ver Pers. Reciben'
								  ), 
			  ),
	array( 
			  'name'=>'RAEX_ESTADO',
			  'type'=>'html',
			  'filter'=>array('0'=> 'ACTIVO', '1' => 'ANULADO'),
			  'value'=> 'CHtml::link(CHtml::image($data->imagenEstado),array("rcdarchivo/radicadosexternos/changeState",
			                                                                 "radicado"=>$data[RAEX_ID],
																			 "estado"=>$data[RAEX_ESTADO]))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'80',
								   'title' => 'Activar / Anular',
								   'alt' => 'Activar /  Anular'
								  ), 
			  ),
	/*array(
			'name'=>'RAEX_ESCANEORUTA',
					'type'=>'raw',
					'htmlOptions'=>array('style'=>'text-align: center','width'=>'200'),
					'value'=>'CHtml::link("Ver Documento", Yii::app()->baseUrl.$data->RAEX_ESCANEORUTA, array("target"=>"_blank"))',					  
			 ),*/
			 
	array( 
			  'name'=>'RAEX_ESCANEORUTA',
			  'type'=>'raw',
			  'filter'=>false,
			  'value'=>  'CHtml::link(Radicadosexternos::getverArchivo($data["RAEX_ESCANEORUTA"]),
									 Radicadosexternos::getLinkValue($data), $data["RAEX_ESCANEORUTA"]==null? array("target"=>"_self") : array("target"=>"_blank")
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
			    'url'=>'Yii::app()->controller->createUrl("rcdarchivo/radicadosexternos/view", array("id"=>$data[RAEX_ID],))',
				),
			  ),
			  
			),
	),
)); 
?>
    </td>
  </tr>
</table>
