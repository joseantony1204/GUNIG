<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'COPRO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SEDE_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PENA_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'DECA_FECHA_INICIO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'DECA_FECHA_FIN',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'COPRO_ESTADO',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
