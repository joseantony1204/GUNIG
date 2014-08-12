<?php
Yii::app()->homeUrl = array('/general/');
$this->breadcrumbs=array(
	'Modulo Configuraciones Generales'=>array('/general/'),
	'Jefes De Dependencias'=>array('admin'),
	'Administrar'
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('jefesdependencias-grid', {
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
		      $image = CHtml::image($imageUrl);
			  echo $image;
			  ?>
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE JEFES DE DEPENDENCIAS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/general/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlconfig/jefesdependencias/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlconfig/jefesdependencias/create',),$htmlOptions ); 
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
	'id'=>'jefesdependencias-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'PENA_ID', 'value'=>'$data->rel_personas_naturales->nombreCompleto', 'filter'=>Jefesdependencias::getPersonas()),
		array('name'=>'DEPE_ID', 'value'=>'$data->rel_dependencias->DEPE_NOMBRE', 'filter'=>Jefesdependencias::getDependencias()),
		'JEDE_DESCRIPCION',
		array('name'=>'JEDE_FECHAINICIO', 'value'=>'$data->JEDE_FECHAINICIO','htmlOptions'=>array('width'=>'100'),),
		array('name'=>'JEDE_FECHAFINAL', 'value'=>'$data->JEDE_FECHAFINAL','htmlOptions'=>array('width'=>'100'),),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',
              'buttons'=>array(       
			   'delete'=> array('url'=>'Yii::app()->controller->createUrl("mdlconfig/jefesdependencias/delete", 
			   array("id"=>$data[JEDE_ID],"command"=>"delete"))',),
			  ),
			),
	),
)); ?>

    </td>
  </tr>
</table>
