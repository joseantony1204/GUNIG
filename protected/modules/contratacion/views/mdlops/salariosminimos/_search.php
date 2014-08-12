<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'SAMI_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SAMI_VALOR',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SAMI_ANIO',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'SAMI_VALORX30',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SAMI_FECGA_INGRESO',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
