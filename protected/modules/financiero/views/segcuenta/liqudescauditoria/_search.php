<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'LDAU_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'LDAU_TARIFA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'LDAU_ACCION',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'LDAU_FECHAPROCESO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'LIQU_ID',array('class'=>'span5','maxlength'=>7)); ?>

	<?php echo $form->textFieldRow($model,'DESC_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'USUA_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
