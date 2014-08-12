<?php
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel Carga Académica'=>array('cargasacademicascpanel/'),
	'Agregar Asignaturas a Docente'=>array('admin'),
	'Administrar',
);
/*
$this->menu=array(
	array('label'=>'List Cargarasignaturasdocente','url'=>array('index')),
	array('label'=>'Create Cargarasignaturasdocente','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cargarasignaturasdocente-grid', {
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
			 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/cargaacademica.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>   
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE AGREGAR ASIGNATURAS A DOCENTE</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/cargasacademicas/admin',),$htmlOptions ); 
?>         
		 
</td>

<!--<td width="7%" align="center">-->
         <?php

         
		 /*$imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/cargarasignaturasdocente/admin',),$htmlOptions ); */
?>         
	<!--	 </td>-->

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcargasacademicas/cargarasignaturasdocente/create',),$htmlOptions ); 
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
	'id'=>'cargarasignaturasdocente-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		/*'CAAD_ID',
		'PRCA_ID',
		'ASIG_ID',
		'CAAD_NUMUMERO_GRUPOS',*/
		
	
		array('name'=>'CAAD_ID', 'value'=>'$data->CAAD_ID', 'htmlOptions'=>array('width'=>'2'),),
		array('name'=>'PENA_ID', 'value'=>'$data->NOMBRE_DOCENTE', 'filter'=>$model->getPersonas(), 'htmlOptions'=>array('width'=>'300'),),
		array('name'=>'ASIG_CODIGO', 'value'=>'$data->ASIG_CODIGO', /*'filter'=>$model->getAsignaturas(), */ 'htmlOptions'=>array('width'=>'4'),),
		array('name'=>'ASIG_NOMBRE', 'value'=>'$data->ASIG_NOMBRE', 'htmlOptions'=>array('width'=>'4'),),
		array('name'=>'ASIG_NUMERO_CREDITOS', 'value'=>'$data->ASIG_NUMERO_CREDITOS', 'htmlOptions'=>array('width'=>'4'),),
		array('name'=>'CAAD_NUMUMERO_GRUPOS', 'value'=>'$data->CAAD_NUMUMERO_GRUPOS', 'htmlOptions'=>array('width'=>'4'),),
		array('name'=>'PROG_NOMBRE', 'value'=>'$data->PROG_NOMBRE', 'filter'=>$model->getPrograma(), 'htmlOptions'=>array('width'=>'300'),),
		
        
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
