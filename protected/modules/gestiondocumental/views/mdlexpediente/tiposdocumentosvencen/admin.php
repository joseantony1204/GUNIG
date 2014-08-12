<?php
Yii::app()->homeUrl = array('/gestiondocumental/');
$this->breadcrumbs=array(
	'Modulo Gestión Documental'=>array('/gestiondocumental/'),
	'Panel'=>array('/gestiondocumental/expedientecpanel/'),
	'Tipos Docuentos Vencen'=>array('mdlexpediente/tiposdocumentosvencen/admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Tiposdocumentosvencen','url'=>array('index')),
	array('label'=>'Create Tiposdocumentosvencen','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tiposdocumentosvencen-grid', {
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
			 $imageUrl = Yii::app()->request->baseUrl . '/images/archivos.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION EXPEDIENTE ELECTRONICO DE CONTRATOS - TIPOS DE DOCUMENTOS QUE VENCEN</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('expedientecpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlexpediente/tiposdocumentosvencen/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlexpediente/tiposdocumentosvencen/create',),$htmlOptions ); 
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
	'id'=>'tiposdocumentosvencen-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'TIDV_ID', 'filter'=>false, 'value'=>'$data->TIDV_ID','htmlOptions'=>array('width'=>'20'),),
		array('name'=>'TIDO_ID', 'value'=>'$data->rel_tipos_documentos->TIDO_NOMBRE','htmlOptions'=>array('width'=>'300'),),		
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
