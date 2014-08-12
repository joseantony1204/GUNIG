<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'PEAC_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PEAC_NOMBRE',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'PEAC_FECHA_INICIO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PEAC_FECHA_FINAL',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PEAC_ESTADO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ANAC_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
