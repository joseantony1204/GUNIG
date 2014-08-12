<?php
$this->breadcrumbs=array(
	'Liqudescauditoria'=>array('index'),
	'Administrar',
);

/*
$this->menu=array(
	array('label'=>'List Liqudescauditoria','url'=>array('index')),
	array('label'=>'Create Liqudescauditoria','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('liqudescauditoria-grid', {
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
             <td width="63%"><strong><span><em>ADMINISTRACION DE AUDITORIA LIQUIDACIONES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/cuentas/admin','id'=>$model->lIQU->cUEN->CONT_ID),$htmlOptions );  
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('segcuenta/liqudescauditoria/admin','id'=>$model->lIQU->cUEN->CUEN_ID),$htmlOptions );  
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
	'id'=>'liqudescauditoria-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
	
	array('name'=>'LIQU_ID', 'value'=>'$data->LIQU_ID', 'htmlOptions'=>array('width'=>'10'),),
	array('name'=>'LDAU_FECHAPROCESO', 'value'=>'$data->LDAU_FECHAPROCESO', 'htmlOptions'=>array('width'=>'60'),),
	array('name'=>'LDAU_ACCION', 'value'=>'$data->LDAU_ACCION', 'htmlOptions'=>array('width'=>'60'),),
	array('name'=>'DESC_ID', 'value'=>'$data->dESC->DESC_NOMBRE', 'htmlOptions'=>array('width'=>'60'),),
	array('name'=>'LDAU_TARIFA', 'value'=>'$data->LDAU_TARIFA', 'htmlOptions'=>array('width'=>'60'),),
	array('name'=>'USUA_ID', 'value'=>'$data->uSUA->USUA_USUARIO', 'htmlOptions'=>array('width'=>'60'),),
	
	       
       
	),
)); ?>

    </td>
  </tr>
</table>
