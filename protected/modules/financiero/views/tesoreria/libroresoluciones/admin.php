<?php
$this->breadcrumbs=array(
	'Libro de Resoluciones'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List resoluciones','url'=>array('index')),
	array('label'=>'Create resoluciones','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('libroresoluciones-grid', {
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
             <td width="63%"><strong><span><em>LIBRO DE RESOLUCIONES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/tesoreria/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/tesoreria/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('tesoreria/libroresoluciones/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/tesoreria/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('tesoreria/libroresoluciones/create',),$htmlOptions ); 
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
	'id'=>'libroresoluciones-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
						'LIRE_ID',
						'LIRE_CONCEPTO',
						'LIRE_FECHA',
						array('name'=>'PERS_ID', 
							'value'=>'$data->pERS->nombrePersona',
							'filter'=>libroresoluciones::Personas(),
							'htmlOptions'=>array('width'=>'150'),),
	
						array('header'=>'VALOR',
								'name'=>'LIRE_VALOR',
								'type'=>'raw', // sierve para reconocer textos de programacion php en el campo value
								'value'=> '"$ ".number_format($data["LIRE_VALOR"], 0, ",", "."); ',
								'htmlOptions'=>array( 
												   'style'=>'text-align: right','width'=>'200',
												   'title' => 'Cargado / Pendiente',
												   'alt' => 'Cargado /  Pendiente'
												  ), 
							  ),
						array('header'=>'ARCHIVO',
							  'type'=>'raw', //sierve para reconocer textos de programacion php en el campo value
							  'filter'=>array(!null=>'CARGADO',null=>'PENDIENTE'),
							  'value'=>  'CHtml::link(Escaneados::getEstadoArc($data["LIRE_ID"]),
													  Escaneados::getLinkValue($data["LIRE_ID"]), 
													  Escaneados::getEstadoArc($data["LIRE_ID"])=="PENDIENTE"? array("target"=>"_self") : array("target"=>"_blank")
													)',
							  'htmlOptions'=>array( 
												   'style'=>'text-align: center','width'=>'200',
												   'title' => 'Cargado / Pendiente',
												   'alt' => 'Cargado /  Pendiente'
												  ), 
							  ),			  			  
						array('header'=>'OPERACIONES',
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=>'{view}   {update}   {delete} ',//  {download_EXCEL}   {download_PDF}
				'buttons'=>array(
			  					'download_PDF' => array(
												  'label'=>'Descargar en Pdf',
												  'imageUrl'=>Yii::app()->request->baseUrl.'/images/financiero/tesoreria/apdf2.png',
												  'url'=>'Yii::app()->controller->createUrl("tesoreria/libroresoluciones/pdf", array("id"=>$data["LIRE_ID"]))',
												  ),       
							  'download_EXCEL' => array(
												  'label'=>'Descargar en Excel',
												  'imageUrl'=>Yii::app()->request->baseUrl.'/images/financiero/tesoreria/aexcel2.png',
												  'url'=>'Yii::app()->controller->createUrl("tesoreria/libroresoluciones/excel", array("id"=>$data["LIRE_ID"]))',
												  ),
								
								),				  
			 ),
			 		)//fin columnas
)); ?>

    </td>
  </tr>
</table>
