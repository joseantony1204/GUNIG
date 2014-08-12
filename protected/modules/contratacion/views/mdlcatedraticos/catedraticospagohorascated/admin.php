<?php
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratación'=>array('/contratacion/'),
	'Panel'=>array('/contratacion/catedraticoscpanel/'),
	'Pago De Horas Catedras'=>array('mdlcatedraticos/catedraticospagohorascated/admin'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('catedraticospagohorascated-grid', {
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
             <td width="73%"><strong><span><em>ADMINISTRACION DE PAGO DE HORAS CATEDRAS</em></span></strong></td>

<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('catedraticoscpanel/',),$htmlOptions ); 
?></td>
<td width="7%" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedraticospagohorascated/admin',),$htmlOptions ); 
?></td>

<td width="7%" align="center">
<?php
		 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/catedras/hrsNomina.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Reporte Horas Cátedras para Nómina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlcatedraticos/catedraticospagohorascated/download',),$htmlOptions ); 
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
	    'id'=>'catedraticospagohorascated-form',
	    'enableAjaxValidation'=>false,
	    'type'=>'vertical',
	    'htmlOptions'=>array('class'=>'well'),
	    'enableClientValidation'=>true,
	    'clientOptions'=>array(
		'validateOnSubmit'=>true,),
        )); 
		?>
      <table width="100%" border="0">
       <tr>
        <td width="65%" align="right"><div class="tab"><strong>Digite el porcentaje de horas a pagar</strong> :</div></td>
        <td width="8%" align="center">
		<?php echo $form->textField($Cform,'CPHC_PORCENTAJE',array('class'=>'span1')); ?> 
        <?php echo $form->error($Cform,'CPHC_PORCENTAJE'); ?>       
        </td>
        <td width="3%" align="left"><div class="tab">%</div></td>
        <td width="12%" align="center">
        <div class="form-actionsv">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'edit white',
			'type'=>'success',
			'size'=>'small',
			'label'=>'Calcular',
		)); ?>
	    </div>
        </td>
        <td width="12%" align="center">
        <div class="form-actionsv">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>'Guardar',
		)); ?>
	    </div>
        </td>
       </tr>
      </table>
      <?php $this->endWidget(); ?>

    </td>
  </tr>
  <tr>
    <td>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'catedraticospagohorascated-grid',
	'dataProvider'=>$Catedraticospagohorascated->search($Cform),
	'type'=>'striped bordered condensed',
    'filter'=>$Catedraticospagohorascated,
	'columns'=>array(
		array('name'=>'CACA_NOMBRE', 'value'=>'$data->CACA_NOMBRE','htmlOptions'=>array('width'=>'250'),),
		array('name'=>'CACA_INTENSIDAD', 'value'=>'$data->CACA_INTENSIDAD','htmlOptions'=>array('style'=>'text-align: right','width'=>'50'),),
		
		array('name'=>'CPHC_HORASPAGADAS', 'value'=>'$data->CPHC_HORASPAGADAS',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'80'),),
		
		array('name'=>'CPHC_HORASRESTANTES', 'value'=>'$data->CPHC_HORASRESTANTES',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'80'),),
		
		array('name'=>'CPHC_HORASXPAGAR', 'value'=>'$data->CPHC_HORASXPAGAR',
		'htmlOptions'=>array('style'=>'text-align: right','width'=>'80'),),
		
		array('name'=>'CPHC_PORCPAGADO', 'value'=>'$data->CPHC_PORCPAGADO."%"',
		'htmlOptions'=>array('style'=>'text-align: center','width'=>'80'),),
	),
)); ?>

    </td>
  </tr>
</table>
