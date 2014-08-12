<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/catedraticoscpanel/'),
	'Contratos'=>array('mdlcatedraticos/catedraticoscontratos/admin'),
	'Catedras'=>array('mdlcatedraticos/catedraticoscatedras/admin','id'=>$Catedraticoscatedras->CACO_ID),
	'Asignaturas'=>array('mdlcatedraticos/catedratiasignaturascatedr/admin','id'=>$Catedratiasignaturascatedr->CACA_ID),
	'Agregar',
);

/*
$this->menu=array(
	array('label'=>'List Asignaturas','url'=>array('index')),
	array('label'=>'Create Asignaturas','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('asignaturas-grid', {
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
              <td width="6%" align="center">
              <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="72%"><strong><span><em>ADMINISTRACION DE ASIGNATURAS</em></span></strong></td>

<td width="10%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, 
		 array('mdlcatedraticos/catedratiasignaturascatedr/admin','id'=>$Catedratiasignaturascatedr->CACA_ID,),$htmlOptions ); 
?>         
		 
</td>

<td width="12%" align="center">
  <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, 
		 array('mdlcatedraticos/catedratiasignaturascatedr/create','id'=>$Catedratiasignaturascatedr->CACA_ID,),$htmlOptions ); 
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
	'id'=>'asignaturas-grid',
	'dataProvider'=>$Asignaturas->searchs($Catedratiasignaturascatedr->CACA_ID),
	'type'=>'striped bordered condensed',
    'filter'=>$Asignaturas,
	'columns'=>array(
		array('name'=>'ASIG_ID', 'value'=>'$data->ASIG_ID', 'htmlOptions'=>array('width'=>'10')),
		array('name'=>'ASIG_CODIGO', 'value'=>'$data->ASIG_CODIGO', 'htmlOptions'=>array('width'=>'60')),
		array('name'=>'ASIG_NOMBRE', 'value'=>'$data->ASIG_NOMBRE', 'htmlOptions'=>array('width'=>'300')),	        
        
		array(
          'class'=>'bootstrap.widgets.TbButtonColumn',
          'template'=>'{agregar}',
		  'buttons' => array(
							 'agregar' => array(
                                            'label' => Yii::t("int", "Agegar Asignatura a la catedra"),
                                            'url' => 'Yii::app()->controller->createUrl("mdlcatedraticos/catedratiasignaturascatedr/creates",
											          array("id"=>'.$Catedratiasignaturascatedr->CACA_ID.',"ASIG_ID"=>$data->ASIG_ID))',
                                            'imageUrl' => Yii::app()->baseurl.'/images/ir.png',
											'click' => 'function(data) 
											  {        
												if(!confirm('.CJavaScript::encode(Yii::t('int', 
												 '¿Seguro que quiere agregar esta asginatura a la catedra?')) . ')) return false;
													$.ajax(
														   {
															type: "GET",
														   }
														   );
											   }',
                                            ),  
							 )			  
		 ),
	),
)); ?>

    </td>
  </tr>
</table>
