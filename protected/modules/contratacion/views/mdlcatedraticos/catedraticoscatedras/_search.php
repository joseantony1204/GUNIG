<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'CACA_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CACA_NOMBRE',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'CACA_INTENSIDAD',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CACA_INTENSIDADENLETRAS',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'CACA_ESTADO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PROG_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CAPR_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CACO_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
