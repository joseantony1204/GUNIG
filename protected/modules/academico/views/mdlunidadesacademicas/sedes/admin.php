<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel Unidades Académicas'=>array('unidadesacademicascpanel/'),
	'Sedes'=>array('admin'),
	'Administrar',
);
/*
$this->menu=array(
	array('label'=>'List Sedes','url'=>array('index')),
	array('label'=>'Create Sedes','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('sedes-grid', {
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
              <td width="6%" align="center"><img src="../images/setting.png" width="60" height="70" /></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE SEDES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('unidadesacademicascpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlunidadesacademicas/sedes/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlunidadesacademicas/sedes/create',),$htmlOptions ); 
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
	'id'=>'sedes-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'SEDE_ID', 'value'=>'$data->SEDE_ID', 'type'=>'number','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'SEDE_NOMBRE', 'value'=>'$data->SEDE_NOMBRE', 'htmlOptions'=>array('width'=>'300'),),
		array('name'=>'UNIV_ID', 'value'=>'$data->rel_universidades->UNIV_NOMBRE', 'filter'=>Sedes::getUniversidades()),   array('class'=>'bootstrap.widgets.TbButtonColumn', 
		'template'=>'{update}&nbsp;&nbsp;{delete}',	),),
			
)); ?>

    </td>
  </tr>
</table>
