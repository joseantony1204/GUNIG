<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Tutorias'=>array('tutoriascpanel/'),
	'Personas Naturales'=>array('mdltutorias/personasnaturales/admin/'),
	'Hoja de vida'=>array('mdltutorias/personasnaturales/view/','id'=>$model->PENA_ID),
	'Estudios'=>array('admin','id'=>$model->PENA_ID),
	'Administrar', 
);

/*
$this->menu=array(
	array('label'=>'List Personasnaturalesestudios','url'=>array('index')),
	array('label'=>'Create Personasnaturalesestudios','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('personasnaturalesestudios-grid', {
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
             <?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; ?>
             <?php $image = CHtml::image($imageUrl); ?>
              
              <td width="6%" align="center"><?php echo $image; ?></td>
             <td width="63%"><strong><span><em>ESTUDIOS DE PERSONAS NATURALES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/personasnaturales/view','id'=>$model->PENA_ID),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/personasnaturalesestudios/admin','id'=>$model->PENA_ID),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/personasnaturalesestudios/create','id'=>$model->PENA_ID),$htmlOptions ); 
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
	'id'=>'personasnaturalesestudios-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'PENE_ID', 'value'=>'$data->PENE_ID','htmlOptions'=>array('width'=>'10'),),
		array('name'=>'ESTU_ID', 'value'=>'$data->rel_estudios->ESTU_NOMBRE','htmlOptions'=>array('width'=>'350'),),
		array('name'=>'PENE_LUGAR', 'value'=>'$data->PENE_LUGAR','htmlOptions'=>array('width'=>'280'),),
		array('name'=>'PENE_FECHACULMINACION', 'value'=>'$data->PENE_FECHACULMINACION','htmlOptions'=>array('width'=>'150'),),
		array('name'=>'ESES_ID', 'value'=>'$data->rel_estados_estudio->ESES_NOMBRE','filter'=>Estadosestudios::getEstadosestudios()),
		array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
