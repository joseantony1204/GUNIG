<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Tutorias'=>array('tutoriascpanel/'),
	'Sub Programas Tutorias',
);
/*
$this->menu=array(
	array('label'=>'List Tutoriassubprogramas','url'=>array('index')),
	array('label'=>'Create Tutoriassubprogramas','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tutoriassubprogramas-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE TUTORIASSUBPROGRAMAS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('tutoriascpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriassubprogramas/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdltutorias/tutoriassubprogramas/create',),$htmlOptions ); 
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
	'id'=>'tutoriassubprogramas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'TUSP_ID', 'value'=>'$data->TUSP_ID', 'type'=>'number','htmlOptions'=>array('width'=>'50'),),
		array('name'=>'TUSP_NOMBRE', 'value'=>'$data->TUSP_NOMBRE', 'htmlOptions'=>array('width'=>'450'),),
		array('name'=>'TUPR_ID', 'value'=>'$data->rel_programas->TUPR_NOMBRE', 'filter'=>Tutoriassubprogramas::getProgramas()),
		array('name'=>'CONTRATOS', 'filter'=>false, 'value'=>'$data->CONTRATOS', 'type'=>'number',
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'170'),),	
			array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'&nbsp;&nbsp;{download}&nbsp;&nbsp;{update}&nbsp;&nbsp;{delete}',
			  'htmlOptions'=>array('width'=>'80'),
              'buttons'=>array(       
               'download' => array(
			    'label'=>'Descargar Contratos de este Programa',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/cont_desc.png',
			    'url'=>'Yii::app()->controller->createUrl("mdltutorias/tutoriascontratos/download", array("sbp"=>$data[TUSP_ID]))',
				),
				'update'=>array('url'=>'Yii::app()->controller->createUrl("mdltutorias/tutoriassubprogramas/update", 
			                    array("id"=>$data[TUSP_ID],))',),
			 
			   'delete'=>array('url'=>'Yii::app()->controller->createUrl("mdltutorias/tutoriassubprogramas/delete", 
			                    array("id"=>$data[TUSP_ID],"command"=>"delete"))',
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
