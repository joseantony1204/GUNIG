<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'TUTO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TUTO_INTENSIDAD',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TUTO_VALOR',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TUTO_PLAZO',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'TUSP_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SEDE_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PRES_ID',array('class'=>'span5')); ?>

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
