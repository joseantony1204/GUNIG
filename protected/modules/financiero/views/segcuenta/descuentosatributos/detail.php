<?php
$this->breadcrumbs=array(
	'Modulo Financiero'=>array('/financiero/'),
	'cpanel Descuentosatributos'=>array('descuentosatributoscpanel/'),
	'Descuentos Atributos'=>array('descuentos/admin'),
	'Atributos del Descuento'=>array('descuentosatributos/detail','id'=>$Descuentosatributos->DESC_ID),
	'Modulos de Atributos de Descuentos',
);

/*
$this->menu=array(
	array('label'=>'List Descuentosatributos','url'=>array('index')),
	array('label'=>'Create Descuentosatributos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('descuentosatributos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE DESCUENTOS ATRIBUTOS [<?php echo $model->dESC->DESC_NOMBRE; ?>]</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
       	 echo CHtml::link($image, array('segcuenta/descuentos/admin/','id'=>$Descuentosatributos->DESC_ID),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
		 echo CHtml::link($image, array('segcuenta/descuentosatributos/detail','id'=>$model->DESC_ID),$htmlOptions );  
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
		 echo CHtml::link($image, array('segcuenta/descuentosatributos/create','id'=>$model->DESC_ID),$htmlOptions ); 
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
	'id'=>'descuentosatributos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		
		//array('name'=>'DEAT_ID', 'value'=>'$data->DEAT_ID', 'type'=>'number','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'DESC_ID', 'value'=>'$data->dESC->DESC_NOMBRE', 'filter'=>Descuentosatributos::getDescuentos($model->DESC_ID), 'htmlOptions'=>array('width'=>'100')),
		array('name'=>'DEAT_CODIGO', 'value'=>'$data->DEAT_CODIGO', 'htmlOptions'=>array('width'=>'30'),),
		array('name'=>'DEAT_DESCRIPCION', 'value'=>'$data->DEAT_DESCRIPCION', 'htmlOptions'=>array('width'=>'1000'),),
		array('name'=>'DEAT_DESDE', 'value'=>'$data->DEAT_DESDE', 'type'=>'number','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'DEAT_HASTA', 'value'=>'$data->DEAT_HASTA', 'type'=>'number','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'DEAT_VALOR', 'value'=>'$data->DEAT_VALOR', 'htmlOptions'=>array('width'=>'30'),),
		array('name'=>'ANAC_ID', 'value'=>'$data->ANAC_ID', 'htmlOptions'=>array('width'=>'30'),),
		
		
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template' => '{update}&nbsp;&nbsp;{delete}',
              'buttons' => array(
                                			   		  
			                    ),
	          ),
		),
		)); 
?>	

    </td>
  </tr>
</table>