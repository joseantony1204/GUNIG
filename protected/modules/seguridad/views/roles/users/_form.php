<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'usuarios-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'USUA_USUARIO',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textAreaRow($model,'USUA_CLAVE',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'USUA_SESSION',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'USUA_FECHAALTA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'USUA_FECHABAJA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'USUA_ULTIMOACCESO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'USES_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PENA_ID',array('class'=>'span5')); ?>

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




