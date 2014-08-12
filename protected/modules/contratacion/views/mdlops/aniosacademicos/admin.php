<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Ops'=>array('opscpanel/'),
	'Años Academicos'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Aniosacademicos','url'=>array('index')),
	array('label'=>'Create Aniosacademicos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('aniosacademicos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE ANIOSACADEMICOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('opscpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/aniosacademicos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/aniosacademicos/create',),$htmlOptions ); 
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
	'id'=>'Aniosacademicos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	    array('name'=>'ANAC_NOMBRE', 'value'=>'$data->ANAC_NOMBRE', 'htmlOptions'=>array('width'=>'400'),),
		array('name'=>'ANAC_FECHA_INICIO', 'value'=>'$data->ANAC_FECHA_INICIO', 'htmlOptions'=>array('width'=>'150'),),
		array('name'=>'ANAC_FECHA_FINAL', 'value'=>'$data->ANAC_FECHA_FINAL', 'htmlOptions'=>array('width'=>'150'),),		 
		 array( 
			  'name'=>'ANAC_ESTADO',
			  'type'=>'html',
			  'filter'=>array('0'=> 'ACTIVO', '1' => 'INACTIVO'),
			  'value'=> 'CHtml::link(CHtml::image($data->imagenEstado),array("mdlops/aniosacademicos/changeState",
			                                                                 "periodo"=>$data[ANAC_ID],
																			 "estado"=>$data[ANAC_ESTADO]))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'130',
								   'title' => 'Activar / Desactivar',
								   'alt' => 'Activar / Desactivar'
								  ), 
			  ),
		array(
             'class'=>'bootstrap.widgets.TbButtonColumn',
             'template'=>'{update}&nbsp;&nbsp;&nbsp;{delete}',
             'buttons'=>array(       
			 'update'=>array('url'=>'Yii::app()->controller->createUrl("aniosacademicos/update", array("id"=>$data[ANAC_ID],))',),
			  ),
			 'buttons'=>array(       
			 'delete'=>array('url'=>'Yii::app()->controller->createUrl("aniosacademicos/delete", 
			 array("id"=>$data[ANAC_ID],"command"=>"delete"))',),
			  ),
			),
	),
)); ?>
    </td>
  </tr>
</table>
