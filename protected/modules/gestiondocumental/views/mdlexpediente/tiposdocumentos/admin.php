<?php
Yii::app()->homeUrl = array('/gestiondocumental/');
$this->breadcrumbs=array(
	'Modulo Gestión Documental'=>array('/gestiondocumental/'),
	'Panel'=>array('/gestiondocumental/expedientecpanel/'),
	'Tipos de Documentos'=>array('mdlexpediente/tiposdocumentos/admin'),
	'Administrar',
);
/*
$this->menu=array(
	array('label'=>'List Tiposdocumentos','url'=>array('index')),
	array('label'=>'Create Tiposdocumentos','url'=>array('create')),
);
*/

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tiposdocumentos-grid', {
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
              <td width="8%" align="center">
              <?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/archivos.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>         
			               
              </td>
             <td><strong><span><em> EXPEDIENTE ELECTRONICO DE CONTRATOS - TIPOS DE DOCUMENTOS</em></span></strong></td>
             <td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('expedientecpanel/',),$htmlOptions ); 
?></td>

<td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlexpediente/tiposdocumentos/admin',),$htmlOptions ); 
?></td>

<td width="9%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlexpediente/tiposdocumentos/create',),$htmlOptions); 
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
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tiposdocumentos-admin',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'wells'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>
    <table width="100%" border="0" align="center">
     <tr>
      <td colspan="3">
    
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'tiposdocumentos-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
    'filter'=>$model,
	'columns'=>array(
		array('name'=>'TIDO_ID', 'filter'=>false, 'value'=>'$data->TIDO_ID','htmlOptions'=>array('width'=>'20'),),
		array('name'=>'TIDO_NOMBRE', 'value'=>'$data->TIDO_NOMBRE','htmlOptions'=>array('width'=>'300'),), 
		
		array(
        'name'=>'TIDO_ORDEN',
		'filter'=>false,
		'value'=>'CHtml::textField("sortOrder[$data->TIDO_ID]",$data->TIDO_ORDEN,array("class"=>"span1","style"=>"text-align: center",))',
        'type'=>'raw',
        'htmlOptions'=>array('style'=>'text-align: center','width'=>'5px'),
        ),
       
        array(
              'class'=>'bootstrap.widgets.TbButtonColumn',
              'template'=>'{update}&nbsp;&nbsp;{delete}',			  
			),
	),
)); ?>
      </td>
     </tr>
     
     <tr>
     <td width="70%">&nbsp;</td>
     <td width="18%" align="center">
     <div class="form-actionss">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',        
            'label'=>$model->isNewRecord ? 'Actualizar Orden' : 'Actualizar Orden',
          ));		
		?>
	</div>
     
     </td>
     <td width="12%">&nbsp;</td>
     </tr>
   </table>

    </td>
  </tr>
</table>
<?php $this->endWidget(); ?>