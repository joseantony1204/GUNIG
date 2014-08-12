<?php
Yii::app()->homeUrl = array('/general/');
$this->breadcrumbs=array(
	'Modulo Configuraciones Generales'=>array('/general/'),
	'Estudios'=>array('admin'),
	'Administrar'
);

/*
$this->menu=array(
	array('label'=>'List Estudios','url'=>array('index')),
	array('label'=>'Create Estudios','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('estudios-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<table width="90%" border="0" align="center">
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
		      $image = CHtml::image($imageUrl);
			  echo $image;
			  ?>
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE ESTUDIOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/general/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlconfig/estudios/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlconfig/estudios/create',),$htmlOptions ); 
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
	'id'=>'estudios-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		 array('name'=>'ESTU_ID', 'value'=>'$data->ESTU_ID', 'htmlOptions'=>array('width'=>'100'),),
		 array('name'=>'ESTU_NOMBRE', 'value'=>'$data->ESTU_NOMBRE', 'htmlOptions'=>array('width'=>'500'),),
		 array('name'=>'TIES_ID', 'value'=>'$data->rel_tipos_estudios->TIES_NOMBRE',
		 'filter'=>Tiposestudios::getTiposestudios(),'htmlOptions'=>array('width'=>'150'),),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
