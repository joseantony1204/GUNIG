<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'PENA_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PENA_NOMBRES',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'PENA_APELLIDOS',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'PENA_LUGAREXPIDENTIDAD',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'PENA_FECHAEXPIDENTIDAD',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PENA_FECHANACIMIENTO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PERS_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PAIS_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'DEPA_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'MUNI_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SEXO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ESCI_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
