<?php
$this->breadcrumbs=array(
	'Modulo Financiero'=>array('/financiero/'),
	'cpanel clasescontratosdescuentos'=>array('clasescontratosdescuentoscpanel/'),
	'clases Contratos'=>array('clasescontratos/admin'),
	'clases Contratos Descuentos'=>array('clasescontratosdescuentos/detail','id'=>$Clasescontratosdescuentos->CLCO_ID),
	'Modulos de Clasescontratosdescuentos',
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE DESCUENTOS [<?php echo $model->cLCO->CLCO_NOMBRE; ?>]</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
       	 echo CHtml::link($image, array('segcuenta/clasescontratos/admin/','id'=>$Clasescontratosdescuentos->CLCO_ID),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
		 echo CHtml::link($image, array('segcuenta/clasescontratosdescuentos/detail','id'=>$model->CLCO_ID),$htmlOptions );  
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
		 echo CHtml::link($image, array('segcuenta/clasescontratosdescuentos/create','id'=>$model->CLCO_ID),$htmlOptions ); 
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
	'id'=>'clasescontratosdescuentos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	
        array('name'=>'CCDE_ID', 'value'=>'$data->CCDE_ID','htmlOptions'=>array('width'=>'95'),),
		array('name'=>'CLCO_ID', 'value'=>'$data->cLCO->CLCO_NOMBRE', 'filter'=>Clasescontratosdescuentos::getClasescontratos()),
		array('name'=>'DESC_ID', 'value'=>'$data->dESC->DESC_NOMBRE', 'filter'=>Clasescontratosdescuentos::getDescuentos()),
			
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