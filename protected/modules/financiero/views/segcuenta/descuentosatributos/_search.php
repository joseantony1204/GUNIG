<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'DEAT_ID',array('class'=>'span5','maxlength'=>11)); ?>
    
    
    <?php echo $form->textFieldRow($model,'DEAT_CODIGO',array('class'=>'span5','maxlength'=>10)); ?>


	<?php echo $form->textFieldRow($model,'DEAT_DESCRIPCION',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'DEAT_DESDE',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'DEAT_HASTA',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'DEAT_VALOR',array('class'=>'span5')); ?>

	<?php echo $form->hiddenField($model,'DESC_ID'); ?>

	<?php echo $form->textFieldRow($model,'ANAC_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
