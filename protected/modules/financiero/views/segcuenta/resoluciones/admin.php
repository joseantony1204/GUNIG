<?php
$this->breadcrumbs=array(
	'Resoluciones'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Resoluciones','url'=>array('index')),
	array('label'=>'Create Resoluciones','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('resoluciones-grid', {
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
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE RESOLUCIONES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('/financiero/tcuentascpanel',),$htmlOptions ); 
?>      
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
        echo CHtml::link($image, array('segcuenta/resoluciones/admin',),$htmlOptions );  
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
          
 echo CHtml::link($image, array('segcuenta/resoluciones/create',),$htmlOptions ); ?>        
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
	'id'=>'resoluciones-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	
	
		array('name'=>'RESO_NUMERO', 'value'=>'$data->RESO_NUMERO',  'htmlOptions'=>array('width'=>'20'),),
		array('name'=>'RESO_FECHASUSCRIPCION', 'value'=>'$data->RESO_FECHASUSCRIPCION',  'filter'=>true, 'htmlOptions'=>array('width'=>'20'),),		
		array('name'=>'PERS_ID', 'filter'=>Cuentas::getPersonas(), 'value'=>'$data->pERS->nombrePersona',
		'htmlOptions'=>array('width'=>'220'),),
		
		
		array('name'=>'CLRE_NOMBRE', 'value'=>'$data->CLRE_NOMBRE','htmlOptions'=>array('width'=>'200'),),	
		
		array('name'=>'RELI_VALOR', 'value'=>'$data->RELI_VALOR', 'type'=>'number',
		'htmlOptions'=>array('width'=>'30','style'=>'text-align: right',),),

		
       array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{download}&nbsp;{delete}',
              'buttons'=>array(       
               'download' => array(
			    'label'=>'Descargar Contrato',
				'imageUrl'=>Yii::app()->request->baseUrl.'/images/cont_desc.png',
			    'url'=>'Yii::app()->controller->createUrl("segcuenta/resoluciones/download", array("id"=>$data[RESO_ID]))',
				),
			   'delete' => array(
			    'url'=>'Yii::app()->controller->createUrl("segcuenta/resoluciones/delete", array("id"=>$data[RESO_ID],"command"=>"delete"))',
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
