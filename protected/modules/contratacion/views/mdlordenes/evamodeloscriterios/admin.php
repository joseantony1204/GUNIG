<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Cpanel Contratacion'=>array('/contratacion/ordenescpanel/index'),
	'Contratos'=>array('/contratacion/mdlordenes/modeloordenes/adminsupervisores'),
	'Administrar',
	//$_POST['supervisor']
);

/*
$this->menu=array(
	array('label'=>'List Evamodeloscriterios','url'=>array('index')),
	array('label'=>'Create Evamodeloscriterios','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('evamodeloscriterios-grid', {
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
		      $imageUrl = Yii::app()->request->baseUrl . '/images/settings.png';
			  echo $image = CHtml::image($imageUrl);
		    ?>       
			               
              </td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE EVALUACIÓN DE CONTRATOS</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/modeloordenes/viewsupervisores','id'=>$model->MOOR_ID),$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/evamodeloscriterios/admin','id'=>$model->MOOR_ID),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/evamodeloscriterios/create','id'=>$model->MOOR_ID),$htmlOptions ); 
?></td>
            </tr>
          </table>
          </fieldset>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
   <td colspan="2">
<?php //echo CHtml::link('Busqueda Avanzada','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
   <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'EVALUACION');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlordenes/evamodeloscriterios/detail','id'=>$model->MOOR_ID),$htmlOptions ); 
?></td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'evamodeloscriterios-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		//'EMCE_ID',
		//'MOOR_ID',
		//'EVCR_ID',
		//'EVES_ID',
	
		array('name'=>'EVCR_ID', 'filter' => false, 'value'=>'$data->rel_criterios->EVCR_NOMBRE','htmlOptions'=>array('width'=>'800'),),
		array('name'=>'EVES_ID', 'filter' => false, 'value'=>'$data->rel_estados->EVES_NOMBRE','htmlOptions'=>array('width'=>'10'),),
		array('name'=>'VALOR', 'filter' => false, 'value'=>'$data->rel_criterios->EVCR_PUNTO','htmlOptions'=>array('width'=>'10'),),
		

        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              //'template'=>'{update}&nbsp;&nbsp;{delete}',
			  'template'=>'{update}',			  
			),
	),
)); ?>

    </td>
  </tr>
</table>
