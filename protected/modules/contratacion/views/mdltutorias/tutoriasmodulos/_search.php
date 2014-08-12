<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'TUMT_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TUTO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TUMO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TUMT_GRUPO',array('class'=>'span5','maxlength'=>45)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
