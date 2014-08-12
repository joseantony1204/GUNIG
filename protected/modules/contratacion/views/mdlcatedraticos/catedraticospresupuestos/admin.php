<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Catedráticos'=>array('catedraticoscpanel/'),
	'Presupuestos',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('catedraticospresupuestos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE PRESUPUESTOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('catedraticoscpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedraticospresupuestos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedraticospresupuestos/create',),$htmlOptions ); 
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
	'id'=>'catedraticospresupuestos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	 array('name'=>'PRES_NUM_CERTIFICADO', 'value'=>'$data->PRES_NUM_CERTIFICADO','htmlOptions'=>array('width'=>'120'),),
	 array('name'=>'PRES_DESCRIPCION', 'value'=>'$data->PRES_DESCRIPCION', 'type'=>'text','htmlOptions'=>array('width'=>'350'),),
	 array('name'=>'PRES_SECCION', 'value'=>'$data->PRES_SECCION', 'type'=>'number','htmlOptions'=>array('width'=>'60'),),
	 array('name'=>'PRES_CODIGO', 'value'=>'$data->PRES_CODIGO', 'type'=>'text','htmlOptions'=>array('width'=>'60'),),
	 array('name'=>'PRES_MONTO', 'value'=>'$data->PRES_MONTO', 'type'=>'number','htmlOptions'=>array('width'=>'100','align'=>'center'),),
	 array('name'=>'TOTALCONTRATADO', 'value'=>'($data->PRES_MONTO - $data->TOTALCONTRATADO)', 
	       'type'=>'number','filter'=>false,'htmlOptions'=>array('width'=>'100','align'=>'center'),),
	 array('name'=>'PRES_FECHA_VIGENCIA', 'value'=>'$data->PRES_FECHA_VIGENCIA', 'type'=>'text','htmlOptions'=>array('width'=>'90'),),
	 array('name'=>'FACU_ID', 'value'=>'$data->rel_facultades->FACU_NOMBRE', 'filter'=>Catedraticospresupuestos::getFacultades()),
	 array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',
              'buttons'=>array(       
			   'update' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlcatedraticos/catedraticospresupuestos/update", array("id"=>$data[CAPR_ID],))',
				),
				'delete' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlcatedraticos/presupuestos/delete", array("id"=>$data[PRES_ID],"command"=>"delete"))',
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
