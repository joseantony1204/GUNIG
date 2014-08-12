<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/ocasionalescpanel/'),
	'Presupuestos'=>array('mdlocasionales/ocasionalespresupuestos/admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Ocasionalespresupuestos','url'=>array('index')),
	array('label'=>'Create Ocasionalespresupuestos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ocasionalespresupuestos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE PRESUPUESTOS PARA DOCENTES OCASIONALES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('ocasionalescpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlocasionales/ocasionalespresupuestos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlocasionales/ocasionalespresupuestos/create',),$htmlOptions ); 
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
	'id'=>'ocasionalespresupuestos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(		
	 array('name'=>'PRES_NUM_CERTIFICADO', 'value'=>'$data->PRES_NUM_CERTIFICADO', 'type'=>'number','htmlOptions'=>array('width'=>'120'),),
	 array('name'=>'PRES_DESCRIPCION', 'value'=>'$data->PRES_DESCRIPCION','htmlOptions'=>array('width'=>'300'),),
	 array('name'=>'PRES_SECCION', 'value'=>'$data->PRES_SECCION','htmlOptions'=>array('width'=>'60'),),
	 array('name'=>'PRES_CODIGO', 'value'=>'$data->PRES_CODIGO','htmlOptions'=>array('width'=>'60'),),
	 array('name'=>'PRES_MONTO', 'value'=>'$data->PRES_MONTO', 'type'=>'number','htmlOptions'=>array('width'=>'100','align'=>'center'),),
	 array('name'=>'TOTALCONTRATADO', 'value'=>'($data->PRES_MONTO - $data->TOTALCONTRATADO)', 
	       'type'=>'number','filter'=>false,'htmlOptions'=>array('width'=>'100','align'=>'center'),),
	 array('name'=>'PRES_FECHA_VIGENCIA', 'value'=>'$data->PRES_FECHA_VIGENCIA','htmlOptions'=>array('width'=>'90'),),
	 array('name'=>'FACU_ID', 'value'=>'$data->rel_facultades->FACU_NOMBRE', 'filter'=>Ocasionalespresupuestos::getFacultades()),
	 array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',
              'buttons'=>array(       
			   'update' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlocasionales/ocasionalespresupuestos/update", array("id"=>$data[OCPR_ID],))',
				),
				'delete' => array(
			    'url'=>'Yii::app()->controller->createUrl("mdlocasionales/presupuestos/delete",
				 array("id"=>$data[PRES_ID],"command"=>"delete"))',
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
