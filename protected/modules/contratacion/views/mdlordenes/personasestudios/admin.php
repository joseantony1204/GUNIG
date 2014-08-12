<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel'=>array('ordenescpanel/'),
	'Personas'=>array('personas/admin'),
	'Hoja de vida'=>array('personas/view','id'=>$model->PERS_IDENTIFICACION),
	'Estudios', 
);

/*
$this->menu=array(
	array('label'=>'List Personalestudios','url'=>array('index')),
	array('label'=>'Create Personalestudios','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('personasestudios-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE PERSONASESTUDIOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/personas/view','id'=>$model->PERS_IDENTIFICACION),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/personasestudios/admin','id'=>$model->PERS_IDENTIFICACION),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/personasestudios/create','id'=>$model->PERS_IDENTIFICACION),$htmlOptions ); 
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
	'id'=>'personasestudios-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
	'columns'=>array(
		array('name'=>'PEES_ID', 'value'=>'$data->PEES_ID','htmlOptions'=>array('width'=>'10'),),
		array('name'=>'ESTU_ID', 'value'=>'$data->rel_estudio->ESTU_NOMBRE','htmlOptions'=>array('width'=>'200'),),
		array('name'=>'PEES_LUGAR', 'value'=>'$data->PEES_LUGAR','htmlOptions'=>array('width'=>'150'),),
		array('name'=>'PEES_FECHA', 'value'=>'$data->PEES_FECHA','htmlOptions'=>array('width'=>'40'),),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',

			  'deleteConfirmation'=>'Seguro que quiere eliminar el elemento?', // mensaje de confirmación de borrado
			  'afterDelete'=>'function(link,success,data){ if(success) alert("Elemento borrado exitosamente..."); }',
			),
	),
)); ?>

    </td>
  </tr>
</table>
