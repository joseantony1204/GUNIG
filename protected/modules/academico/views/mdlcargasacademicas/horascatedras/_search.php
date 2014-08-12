<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'HOCA_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'HOCA_SEMANAL',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TICD_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'HOCA_ACUERDO',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'HOCA_INICIO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'HOCA_FIN',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'HOCA_ESTADOS',array('class'=>'span5','maxlength'=>1)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
