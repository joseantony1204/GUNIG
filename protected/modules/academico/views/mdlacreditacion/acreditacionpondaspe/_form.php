<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'acreditacionpondaspe-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'ACPO_GRUPO1',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACPO_GRUPO2',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACPO_GRUPO3',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACPO_GRUPO4',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACPO_GRUPO5',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACAS_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACPO_FECHA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'USUA_ID',array('class'=>'span5')); ?>

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




