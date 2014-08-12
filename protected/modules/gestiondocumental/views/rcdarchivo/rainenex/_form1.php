<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'rainenex-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo RADICADO,": ";?><br>
	<strong style="border-bottom-style:groove"><?php echo $model->RAIN_ID; ?> </strong>
	<br><br>
	
	<?php echo GUIA,": ";?><br>
	<strong style="border-bottom-style:groove"><?php echo $model->RIEE_GUIAENVIO; ?> </strong>
	<br><br>
	
	<?php echo DESTINATARIO,": ";?><br>
	<strong style="border-bottom-style:groove"><?php echo $model->rel_entesexternos->ENEX_NOMBRE  . " (". $model->rel_entesexternos->ENEX_CIUDAD . ") "; ?> </strong>
	<br><br>

	<?php echo $form->textFieldRow($model,'RIEE_RECIBIO',array('class'=>'span5','maxlength'=>200)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$model->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




