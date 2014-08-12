<?php
$this->breadcrumbs=array(
	'Modulo Secretaria General'=>array('/secretariageneral/'),
	'Panel Registro Graduados'=>array('registrograduadoscpanel/'),
	'Fechas de Grados'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Fechasgrados','url'=>array('index')),
	array('label'=>'Create Fechasgrados','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('fechasgrados-grid', {
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
			 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/fechagrados.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE FECHAS GRADOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('registrograduadoscpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/fechasgrados/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/fechasgrados/create',),$htmlOptions ); 
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
   <td colspan="2">
<?php echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
   </td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'fechasgrados-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
			
		array('name'=>'FEGR_ID', 'value'=>'$data->FEGR_ID', 'type'=>'number','htmlOptions'=>array('width'=>'7'),),
		array('name'=>'FEGR_FECHA', 'value'=>'$data->FEGR_FECHA', 'htmlOptions'=>array('width'=>'30'),),
		//array('name'=>'SEDE_ID', 'value'=>'$data->rel_sedes->SEDE_NOMBRE', 'htmlOptions'=>array('width'=>'30'),),
           array('name'=>'SEDE_ID', 'value'=>'$data->rel_sedes->SEDE_NOMBRE', 'filter'=>Sedes::getSedes(), 'htmlOptions'=>array('width'=>'10'),),

		array('name'=>'FEGR_ESTADO',
		  'type'=>'html',
		'filter'=>array('1'=> 'ACTIVO', '0' => 'INACTIVO'), 
		'value'=>'CHtml::link(CHtml::image($data->imagenEstado),array("mdlregistrograduados/fechasgrados/changeState",
			                                                                 "id"=>$data[FEGR_ID],
																			 "estado"=>$data[FEGR_ESTADO]))', 
	   'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'17',
								   'title' => 'Activar / Desactivar',
								   'alt' => 'Activar / Desactivar'
								  ), 
	  ),
	  
	  
	  array(
          'class'=>'bootstrap.widgets.TbButtonColumn',
          'template' => '{descargar}&nbsp;{update}',
          'buttons' => array(
                             'descargar' => array(
                                            'label' => Yii::t('int', 'Descargar ACTAS'),
                                            'url' => 'Yii::app()->controller->createUrl("mdlregistrograduados/fechasgrados/pdf",
											                                                          array("id"=>$data[FEGR_ID]))',
                                            'imageUrl' => Yii::app()->baseurl.'/images/cont_desc.png',
                                            ),
							 'delete' => array(
                                               'label' => Yii::t('int', 'Eliminar Contrato'),
                                               'url' => 'Yii::app()->controller->createUrl("mdlregistrograduados/fechasgrados/delete",
											                                              array("id"=>$data[FEGR_ID],"command"=>"delete"))',
                                               ),			   		  
			                    ),
			'deleteButtonImageUrl'=>Yii::app()->request->baseUrl.'/images/crosse.png',
			'deleteConfirmation'=>'Seguro que quiere eliminar el elemento?', // mensaje de confirmación de borrado
			'afterDelete'=>'function(link,success,data){ if(success) alert("Elemento borrado exitosamente..."); }',					
	          ),
	  
      /*  
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),*/
	),
)); ?>

    </td>
  </tr>
</table>
