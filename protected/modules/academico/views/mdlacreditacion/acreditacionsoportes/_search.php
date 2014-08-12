<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'ACSO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACSO_NUMERO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACSO_DESCRIPCION',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'ACSO_URL',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'ACSO_RESPUESTA',array('class'=>'span5','maxlength'=>2000)); ?>

	<?php echo $form->textFieldRow($model,'ACSO_FUENTE',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'ACSO_ESTADOPM',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'ACIN_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
