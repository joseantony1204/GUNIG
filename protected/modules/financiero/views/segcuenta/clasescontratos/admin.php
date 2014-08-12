<?php
$this->breadcrumbs=array(
	'Clasescontratos'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Clasescontratos','url'=>array('index')),
	array('label'=>'Create Clasescontratos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('clasescontratos-grid', {
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
             	<?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl); ?>
              </td>
              <td width="63%"><strong><span><em>ADMINISTRACION DE CLASESCONTRATOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/financiero/tcuentascpanel',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/clasescontratos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/clasescontratos/create',),$htmlOptions ); 
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
	'id'=>'clasescontratos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'TICO_ID', 'value'=>'$data->rel_tipos_contratos->TICO_NOMBRE','filter'=>Contratos::getTiposcontratos(),
		'htmlOptions'=>array('width'=>'60'),),
		array('name'=>'CLCO_NOMBRE', 'value'=>'$data->CLCO_NOMBRE','htmlOptions'=>array('width'=>'150'),),
		array('name'=>'CLCO_DESCRIPCION', 'value'=>'$data->CLCO_DESCRIPCION','htmlOptions'=>array('width'=>'100'),),
		
		
		array('name'=>'DESCUENTOS', 'filter' => false, 
		'value'=> '$data->DESCUENTOS."&nbsp;&nbsp;&nbsp;&nbsp;".CHtml::link(CHtml::image(Yii::app()->baseurl."/images/icon_cuentas.png"),
		Yii::app()->createUrl("financiero/segcuenta/clasescontratosdescuentos/detail",
		array("id"=>$data->primaryKey)))','type'=>'raw','headerHtmlOptions'=>array('colspan'=>'1'),
		'htmlOptions'=>array('style'=>'text-align: right', 'title' => 'Agregar descuentos a la clase de contrato', 'alt' => 'Agregar descuentos a la clase de contrato', 'width'=>'30'),),	
		
		),
		)); 
?>	

    </td>
  </tr>
</table>
