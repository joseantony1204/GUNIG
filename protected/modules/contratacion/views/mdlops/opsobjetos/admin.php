<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Tutorias'=>array('opscpanel/'),
	'Objetos Ops'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Opsobjetos','url'=>array('index')),
	array('label'=>'Create Opsobjetos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('opsobjetos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE OPSOBJETOS</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlops/opsobjetos/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/opsobjetos/create',),$htmlOptions ); 
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
	'id'=>'opsobjetos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'OBJE_ID', 'value'=>'$data->OBJE_ID', 'type'=>'number','htmlOptions'=>array('width'=>'50'),),
		array('name'=>'OBJE_NOMBRE', 'value'=>'$data->OBJE_NOMBRE','htmlOptions'=>array('width'=>'600'),),
		array(
             'class'=>'bootstrap.widgets.TbButtonColumn',
             'template'=>'{update}&nbsp;&nbsp;&nbsp;{delete}',
             'buttons'=>array(       
			 'update'=>array('url'=>'Yii::app()->controller->createUrl("opsobjetos/update", array("id"=>$data[OPOB_ID],))',),
			  ),
			 'buttons'=>array(       
			 'delete'=>array('url'=>'Yii::app()->controller->createUrl("mdlops/objetos/delete", 
			 array("id"=>$data[OBJE_ID],"command"=>"delete"))',),
			  ),
			),
	),
)); ?>

    </td>
  </tr>
</table>
