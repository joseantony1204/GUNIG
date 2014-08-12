<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'GARA_ID',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'GARA_NOMBRE',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'GARA_ANIO',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'GARA_MES',array('class'=>'span5','maxlength'=>2)); ?>

	<?php echo $form->textFieldRow($model,'GARA_PORCENTAJE',array('class'=>'span5','maxlength'=>5)); ?>

	<?php echo $form->textAreaRow($model,'GARA_DESCRIPCION',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

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
