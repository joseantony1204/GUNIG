<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('opscpanel/'),
	'Presupuestos Adicionales',
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
              <td width="6%" align="center">
              <?php         
		      $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
			  echo $image = CHtml::image($imageUrl);
		      ?>
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE PRESUPUESTOS PARA ADICIONALES</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlops/adicionalespresupuestos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/adicionalespresupuestos/create',),$htmlOptions ); 
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
	 array('name'=>'PRES_NUM_CERTIFICADO', 'value'=>'$data->PRES_NUM_CERTIFICADO', 'type'=>'number','htmlOptions'=>array('width'=>'120'),),
	 array('name'=>'PRES_DESCRIPCION', 'value'=>'$data->PRES_DESCRIPCION', 'type'=>'text','htmlOptions'=>array('width'=>'380'),),
	 array('name'=>'PRES_SECCION', 'value'=>'$data->PRES_SECCION', 'type'=>'number','htmlOptions'=>array('width'=>'60'),),
	 array('name'=>'PRES_CODIGO', 'value'=>'$data->PRES_CODIGO', 'type'=>'text','htmlOptions'=>array('width'=>'60'),),
	 array('name'=>'PRES_MONTO', 'value'=>'$data->PRES_MONTO', 'type'=>'number','htmlOptions'=>array('width'=>'100','align'=>'center'),),
	 array('name'=>'TOTALCONTRATADO', 'value'=>'($data->PRES_MONTO - $data->TOTALCONTRATADO)', 
	       'type'=>'number','filter'=>false,'htmlOptions'=>array('width'=>'100','align'=>'center'),),
	 array('name'=>'PRES_FECHA_VIGENCIA', 'value'=>'$data->PRES_FECHA_VIGENCIA', 'type'=>'text','htmlOptions'=>array('width'=>'90'),),
	 array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',
              'buttons'=>array(       
			   'update' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlops/adicionalespresupuestos/update", array("id"=>$data[ADPR_ID],))',
				),
				'delete' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlops/presupuestos/delete", array("id"=>$data[PRES_ID],"command"=>"delete"))',
				),
			  ),
			  'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/crosse.png',
			  'deleteConfirmation'=>'Seguro que quiere eliminar el elemento?', // mensaje de confirmación de borrado
			  'afterDelete'=>'function(link,success,data){ if(success) alert("Elemento borrado exitosamente..."); }',
			),
					
	),
)); ?>

    </td>
  </tr>
</table>
