<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'REDE_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'REDE_TARIFA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'DESC_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'RESO_ID',array('class'=>'span5','maxlength'=>4)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
