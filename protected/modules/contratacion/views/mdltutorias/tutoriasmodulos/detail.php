<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Tutorias'=>array('tutoriascpanel/'),
	'Contratos Tutorias'=>array('mdltutorias/tutoriascontratos/admin'),
	'Tutorias del Contrato'=>array('mdltutorias/tutorias/detail','id'=>$Tutorias->TUCO_ID),
	'Modulos de Tutoria',
);

/*
$this->menu=array(
	array('label'=>'List Tutoriasmodulos','url'=>array('index')),
	array('label'=>'Create Tutoriasmodulos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tutoriasmodulos-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE TUTORIASMODULOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutorias/detail/','id'=>$Tutorias->TUCO_ID),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriasmodulos/detail','id'=>$model->TUTO_ID),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriasmodulos/create','id'=>$model->TUTO_ID),$htmlOptions ); 
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
	'id'=>'tutoriasmodulos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		//'TUMT_ID',
		//'TUTO_ID',
		array('name'=>'TUMT_ID', 'value'=>'$data->TUMT_ID','htmlOptions'=>array('style'=>'text-align: center','width'=>'20'),),
		array('name'=>'TUMO_ID', 'value'=>'$data->Modulos->TUMO_NOMBRE','htmlOptions'=>array('style'=>'text-align: center','width'=>'300'),),
		array('name'=>'TUMT_GRUPO', 'value'=>'$data->TUMT_GRUPO','htmlOptions'=>array('style'=>'text-align: center','width'=>'150'),),
		
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',
			  'buttons'=>array(       
			   'delete' => array('url'=>'Yii::app()->controller->createUrl("mdltutorias/tutoriasmodulos/delete", 
			   array("id"=>$data[TUMT_ID],"command"=>"delete"))',),
			  ),
			),
	),
)); ?>

    </td>
  </tr>
</table>
