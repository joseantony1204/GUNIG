<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'COAD_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'COAD_NUMADICIONAL',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'COAD_MESES',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'COAD_DIAS',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'COAD_VALOR',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'COAD_FECHAPROCESO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'COAD_FECHAELABORACION',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PECO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TIAD_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CONT_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ADPR_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
