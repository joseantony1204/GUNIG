<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Admin Ops'=>array('opscpanel/'),
	'Salarios Minimos'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Salariosminimos','url'=>array('index')),
	array('label'=>'Create Salariosminimos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('salariosminimos-grid', {
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
			<?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
		    ?>
              <td width="6%" align="center"><?php echo $image = CHtml::image($imageUrl); ?></td>
              <td width="63%"><strong><span><em>ADMINISTRACION DE SALARIOSMINIMOS</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlops/salariosminimos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/salariosminimos/create',),$htmlOptions ); 
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
	'id'=>'salariosminimos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'SAMI_ID', 'value'=>'$data->SAMI_ID', 'type'=>'number','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'SAMI_VALOR', 'value'=>'$data->SAMI_VALOR', 'type'=>'number','htmlOptions'=>array('width'=>'200'),),
        array('name'=>'SAMI_ANIO', 'value'=>'$data->SAMI_ANIO','htmlOptions'=>array('width'=>'100'),),		
		array('name'=>'SAMI_VALORX30', 'value'=>'$data->SAMI_VALORX30', 'type'=>'number','htmlOptions'=>array('width'=>'300'),),
		array(
             'class'=>'bootstrap.widgets.TbButtonColumn',
             'template'=>'{update}&nbsp;&nbsp;&nbsp;{delete}',
             'buttons'=>array(       
			 'update'=>array('url'=>'Yii::app()->controller->createUrl("mdlops/salariosminimos/update", 
			                 array("id"=>$data[SAMI_ID],))',),
			  ),
			 'buttons'=>array(       
			 'delete'=>array('url'=>'Yii::app()->controller->createUrl("mdlops/salariosminimos/delete", 
			                  array("id"=>$data[SAMI_ID],"command"=>"delete"))',),
			  ),
			),
	),
)); ?>

    </td>
  </tr>
</table>
