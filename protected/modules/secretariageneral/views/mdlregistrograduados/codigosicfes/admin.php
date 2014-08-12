<?php
$this->breadcrumbs=array(
	'Modulo Secretaria General'=>array('/secretariageneral/'),
	'Panel Registro Graduados'=>array('registrograduadoscpanel/'),
	'Resoluciones ICFES'=>array('admin'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Codigosicfes','url'=>array('index')),
	array('label'=>'Create Codigosicfes','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('codigosicfes-grid', {
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
			 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/codigosicfes.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>        
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE NORMAS</em></span></strong></td>

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
         echo CHtml::link($image, array('mdlregistrograduados/codigosicfes/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/codigosicfes/create',),$htmlOptions ); 
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
	'id'=>'codigosicfes-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		'COIC_ID',
		'COIC_CODIGO',
		'COIC_NORMA_APROBACION_UNIGUAJIRA',
		'COIC_NORMA_APROBACION_ICFES',
               array('name'=>'PROG_ID', 'value'=>'$data->rel_programas->PROG_NOMBRE', 'filter'=>Programas::getListadoProgramas(),'htmlOptions'=>array('width'=>'10')),
               array('name'=>'SEDE_ID', 'value'=>'$data->rel_sedes->SEDE_NOMBRE', 'filter'=>Sedes::getSedes(), 'htmlOptions'=>array('width'=>'10'),),
		
		'COIC_FECHA_VENCIMIENTO',
		array('name'=>'COIC_ESTADO',
		  'type'=>'html',
		'filter'=>array('1'=> 'ACTIVO', '0' => 'INACTIVO'), 
		'value'=>'CHtml::link(CHtml::image($data->imagenEstado),array("mdlregistrograduados/codigosicfes/changeState",
			                                                                 "id"=>$data[COIC_ID],
																			 "estado"=>$data[COIC_ESTADO]))', 
	   'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'17',
								   'title' => 'Activar / Desactivar',
								   'alt' => 'Activar / Desactivar'
								  ), 
	  ),
		
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{view}&nbsp;{update}&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
