<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'PERS_IDENTIFICACION',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'PERS_EXP_DOCUMENTO',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'PERS_NOMBRES',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'PERS_APELLIDOS',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'PERS_SEXO',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textAreaRow($model,'PERS_EMAIL',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'PERS_DIRECCION',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'PERS_TELEFONO',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'PERS_FECHA_NACIMIENTO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PERS_LUGAR_NACIMIENTO',array('class'=>'span5','maxlength'=>15)); ?>

	<?php echo $form->textFieldRow($model,'PERS_FECHA_INGRESO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TIDO_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
