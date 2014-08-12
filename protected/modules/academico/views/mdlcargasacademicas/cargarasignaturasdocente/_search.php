<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'CAAD_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PRCA_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ASIG_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CAAD_NUMUMERO_GRUPOS',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
