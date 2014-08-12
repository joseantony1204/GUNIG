<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Tutorias'=>array('tutoriascpanel/'),
	'Presupuestos Tutorias',
);

/*
$this->menu=array(
	array('label'=>'List Presupuestos','url'=>array('index')),
	array('label'=>'Create Presupuestos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('presupuestos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE PRESUPUESTOS</em></span></strong></td>

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
         echo CHtml::link($image, array('mdltutorias/tutoriaspresupuestos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriaspresupuestos/create',),$htmlOptions ); 
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
	'id'=>'presupuestos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'PRES_ID', 'value'=>'$data->PRES_ID', 'type'=>'number','htmlOptions'=>array('width'=>'10'),),
		array('name'=>'PRES_NUM_CERTIFICADO', 'value'=>'$data->PRES_NUM_CERTIFICADO', 'type'=>'number','htmlOptions'=>array('width'=>'130'),),
		array('name'=>'PRES_DESCRIPCION', 'value'=>'$data->PRES_DESCRIPCION', 'type'=>'text','htmlOptions'=>array('width'=>'360'),),
		array('name'=>'PRES_SECCION', 'value'=>'$data->PRES_SECCION', 'type'=>'number','htmlOptions'=>array('width'=>'60'),),
		array('name'=>'PRES_CODIGO', 'value'=>'$data->PRES_CODIGO', 'type'=>'text','htmlOptions'=>array('width'=>'60'),),
		array('name'=>'PRES_MONTO', 'value'=>'$data->PRES_MONTO', 'type'=>'number','htmlOptions'=>array('width'=>'100','align'=>'center'),),
		array('name'=>'TOTALCONTRATADO', 'value'=>'($data->PRES_MONTO - $data->TOTALCONTRATADO)', 
	       'type'=>'number','filter'=>false,'htmlOptions'=>array('width'=>'100','align'=>'center'),),
		array('name'=>'PRES_FECHA_VIGENCIA', 'value'=>'$data->PRES_FECHA_VIGENCIA', 'type'=>'text','htmlOptions'=>array('width'=>'110'),),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
