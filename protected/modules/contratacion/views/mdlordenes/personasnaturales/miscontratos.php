<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/Contratacioncpanel/index'),
	'Personas'=>array('admin'),
	'Hoja de vida'=>array('view', 'id'=>$model->PENA_ID),
	'Mis Contratos',
);


/*
$this->menu=array(
	array('label'=>'List Personasnaturales','url'=>array('index')),
	array('label'=>'Create Personasnaturales','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('personasnaturales-grid', {
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
            $image = CHtml::image($imageUrl);
			?>
              <td width="6%" align="center"> <?php echo $image; ?></td>
             <td><strong><span><em>MI HISTORIAL DE CONTRATACION</em></span></strong></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver a mi Hoja De Vida');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/personasnaturales/view','id'=>$model->PENA_ID),$htmlOptions ); 
?></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlops/personasnaturales/miscontratos','id'=>$model->PENA_ID),$htmlOptions ); 
?></td>
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
	'id'=>'personasnaturales-grid',
	'dataProvider'=>$Personas->obtenerMisContratos(),
	'type'=>'striped bordered condensed',
    'filter'=>$Personas,
	'columns'=>array(
		array('name'=>'OPCO_MESES', 'value'=>'$data->OPCO_MESES', 'type'=>'number', 'htmlOptions'=>array('width'=>'80'),),
		array('name'=>'OPCO_DIAS', 'value'=>'$data->OPCO_DIAS', 'type'=>'number', 'htmlOptions'=>array('width'=>'50'),),
		array('name'=>'OPCO_VALOR_MENSUAL', 'value'=>'$data->OPCO_VALOR_MENSUAL', 'type'=>'number', 'htmlOptions'=>array('width'=>'150'),),
		array('name'=>'DEPE_NOMBRE', 'value'=>'$data->DEPE_NOMBRE',  'htmlOptions'=>array('width'=>'350'),),
		array('name'=>'CONT_FECHAINICIO', 'value'=>'$data->CONT_FECHAINICIO',  'htmlOptions'=>array('width'=>'100'),),
		array('name'=>'CONT_FECHAFINAL', 'value'=>'$data->CONT_FECHAFINAL',   'htmlOptions'=>array('width'=>'100'),),
		array('name'=>'ANAC_NOMBRE', 'value'=>'$data->ANAC_NOMBRE',  'htmlOptions'=>array('width'=>'150'),),
	),
)); ?>

    </td>
  </tr>
</table>
