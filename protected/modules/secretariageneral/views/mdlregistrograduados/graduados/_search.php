<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'GRAD_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'GRAD_CEDULA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'GRAD_FECHA_EXPEDICION',array('class'=>'span5')); ?>
    
    <?php echo $form->textFieldRow($model,'GRAD_LUGAR_EXPEDICION',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'GRAD_NOMBRES',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'GRAD_PRIMER_APELLIDO',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'GRAD_SEGUNDO_APELLIDO',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'GRAD_FECHA_NACIMIENTO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SEXO_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
