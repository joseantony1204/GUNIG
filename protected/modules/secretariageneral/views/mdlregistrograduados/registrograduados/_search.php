<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'REGR_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'GRAD_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'REGR_ACTA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'FOLI_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'LIBR_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'FEGR_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TITU_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'RECT_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SEGE_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'DECA_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PROG_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'FACU_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TITG_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
