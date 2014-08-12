<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'CUEN_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CUEN_NUMERO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CUEN_VALOR',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->textFieldRow($model,'CUEN_FECHAINGRESO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TIPA_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CONT_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
