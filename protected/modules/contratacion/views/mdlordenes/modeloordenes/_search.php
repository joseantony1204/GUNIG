<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'MOOR_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'MOOR_VALOR',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'MOOR_OBJETO',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'MOOR_ANIOS',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'MOOR_MESES',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'MOOR_DIAS',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CONT_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
