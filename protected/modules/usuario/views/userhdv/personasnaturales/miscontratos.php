<?php
Yii::app()->homeUrl = array('/usuario/');
$this->breadcrumbs=array(
	'Modulo De Usuario'=>array('/usuario/'),
	'Personas Naturales'=>array('admin'),
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
         echo CHtml::link($image, array('userhdv/personasnaturales/view','id'=>$model->PENA_ID),$htmlOptions ); 
?></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('userhdv/personasnaturales/miscontratos','id'=>$model->PENA_ID),$htmlOptions ); 
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
		array('name'=>'CONT_NUMORDEN', 'value'=>'$data->CONT_NUMORDEN', 'type'=>'number', 'htmlOptions'=>array('width'=>'110'),),
		array('name'=>'OPCO_MESES', 'value'=>'$data->OPCO_MESES', 'type'=>'number', 'htmlOptions'=>array('width'=>'70'),),
		array('name'=>'OPCO_DIAS', 'value'=>'$data->OPCO_DIAS', 'type'=>'number', 'htmlOptions'=>array('width'=>'40'),),
		array('name'=>'OPCO_VALOR_MENSUAL', 'value'=>'$data->OPCO_VALOR_MENSUAL', 'type'=>'number', 'htmlOptions'=>array('width'=>'130'),),
		array('name'=>'DEPE_NOMBRE', 'value'=>'$data->DEPE_NOMBRE',  'htmlOptions'=>array('width'=>'330'),),
		array('name'=>'CONT_FECHAINICIO', 'value'=>'$data->CONT_FECHAINICIO',  'htmlOptions'=>array('width'=>'100'),),
		array('name'=>'CONT_FECHAFINAL', 'value'=>'$data->CONT_FECHAFINAL',   'htmlOptions'=>array('width'=>'100'),),
		array('name'=>'ANAC_NOMBRE', 'value'=>'$data->ANAC_NOMBRE',  'htmlOptions'=>array('width'=>'160'),),
         
		array( 
			  'name'=>'DOCUMENTOS',
			  'type'=>'html',
			  'filter'=>false,
			  'value'=> 'CHtml::link(CHtml::image($data->estadoExpediente),array("userhdv/expedientedocumentos/admin",
			                                                           "id"=>$data[CONT_ID],))',
			  'htmlOptions'=>array('style'=>'text-align: center',
			                       'width'=>'10',
								   'title' => 'Ver Documentos del contrato' , 
								   'alt' => 'Ver Documentos del contrato'), 
			  ),
	),
)); ?>

    </td>
  </tr>
</table>
