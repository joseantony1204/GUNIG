<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Tutorias'=>array('tutoriascpanel/'),
	'Periodos Academicos',
);

/*
$this->menu=array(
	array('label'=>'List Semestralesp','url'=>array('index')),
	array('label'=>'Create Semestralesp','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('semestralesp-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE PERIODOS ACADEMICOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('tutoriascpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/periodosacademicos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/periodosacademicos/create',),$htmlOptions ); 
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
	'id'=>'Periodosacademicos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	    array('name'=>'PEAC_NOMBRE', 'value'=>'$data->PEAC_NOMBRE', 'htmlOptions'=>array('width'=>'400'),),
		array('name'=>'PEAC_FECHA_INICIO', 'value'=>'$data->PEAC_FECHA_INICIO', 'htmlOptions'=>array('width'=>'150'),),
		array('name'=>'PEAC_FECHA_FINAL', 'value'=>'$data->PEAC_FECHA_FINAL', 'htmlOptions'=>array('width'=>'150'),),		 
		 array( 
			  'name'=>'PEAC_ESTADO',
			  'type'=>'html',
			  'filter'=>array('0'=> 'ACTIVO', '1' => 'INACTIVO'),
			  'value'=> 'CHtml::link(CHtml::image($data->imagenEstado),array("mdltutorias/periodosacademicos/changeState",
			                                                                 "periodo"=>$data[PEAC_ID],
																			 "estado"=>$data[PEAC_ESTADO]))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'130',
								   'title' => 'Activar / Desactivar',
								   'alt' => 'Activar / Desactivar'
								  ), 
			  ),
		
		array('name'=>'ANAC_ID', 'value'=>'$data->rel_aniosacademicos->ANAC_NOMBRE', 
		      'filter'=>Periodosacademicos::getAniosacademicos(),'htmlOptions'=>array('width'=>'200')),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
