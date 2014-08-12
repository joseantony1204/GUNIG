<?php
$this->breadcrumbs=array(
	'Directoresprogramas'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Directoresprogramas','url'=>array('index')),
	array('label'=>'Create Directoresprogramas','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('directoresprogramas-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE DIRECTORESPROGRAMAS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('unidadesacademicascpanel/',),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlunidadesacademicas/directoresprogramas/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlunidadesacademicas/directoresprogramas/create',),$htmlOptions ); 
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
	'id'=>'directoresprogramas-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		/*'DIPR_ID',
		'PROG_ID',
		'SEDE_ID',
		'PENA_ID',
		'DIRP_FECHA_INICIO',
		'DIRP_FECHA_FIN',*/
		/*
		'DIPR_ESTADO',
		*/
		array('name'=>'DIPR_ID', 'value'=>'$data->DIPR_ID', 'htmlOptions'=>array('width'=>'2'),),
		array('name'=>'SEDE_ID', 'value'=>'$data->rel_sedes->SEDE_NOMBRE', 'filter'=>DirectoresProgramas::getSedes(), 'htmlOptions'=>array('width'=>'10'),),
		array('name'=>'PROG_ID', 'value'=>'$data->rel_programas->PROG_NOMBRE', 'filter'=>DirectoresProgramas::getProgramas(),'htmlOptions'=>array('width'=>'200'),),
		array('name'=>'PENA_ID', 'value'=>'$data->rel_personasnaturales->nombreCompleto', 'filter'=>DirectoresProgramas::getPersonasnaturales(), 'htmlOptions'=>array('width'=>'200'),),	
		array('name'=>'DIRP_FECHA_INICIO', 'value'=>'$data->DIRP_FECHA_INICIO', 'htmlOptions'=>array('width'=>'20'),),	
		array('name'=>'DIRP_FECHA_FIN', 'value'=>'$data->DIRP_FECHA_FIN', 'htmlOptions'=>array('width'=>'10'),),		 
		 array( 
			  'name'=>'DIPR_ESTADO',
			  'type'=>'html',
			  'filter'=>array('0'=> 'ACTIVO', '1' => 'INACTIVO'),
			  'value'=> 'CHtml::link(CHtml::image($data->imagenEstado),array("mdlunidadesacademicas/directoresprogramas/changeState",
			                                                                 "id"=>$data[DIPR_ID],
																			 "estado"=>$data[DIPR_ESTADO]))',
			  'htmlOptions'=>array(
			                       'style'=>'text-align: center','width'=>'5',
								   'title' => 'Activar / Desactivar',
								   'alt' => 'Activar / Desactivar'
								  ), 
								  ),
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
