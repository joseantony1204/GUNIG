<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'PRES_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PRES_NUM_CERTIFICADO',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'PRES_DESCRIPCION',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'PRES_SECCION',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'PRES_CODIGO',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'PRES_MONTO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PRES_FECHA_VIGENCIA',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'PRES_NOMBRE',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'PRES_FECHA_INGRESO',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
