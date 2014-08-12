<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'INVI_ID',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'INVI_NOMBRE',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'INVI_DIRECCION',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'INVI_LUGAR',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'INVI_TELEFONO',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'INV_DESCRIPCION',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'MOOR_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
