<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'USRO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'USRO_NOMBRE',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'USMO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'USSM_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'USCO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'USVI_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'USPU_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
