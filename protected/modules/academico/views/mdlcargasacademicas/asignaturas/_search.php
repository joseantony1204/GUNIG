<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'ASIG_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ASIG_CODIGO',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'ASIG_NOMBRE',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'ASIG_NUMERO_CREDITOS',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PROG_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
