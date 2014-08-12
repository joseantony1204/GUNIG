<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'CATE_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CATE_NOMBRE',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'CATE_VALOR',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CATE_VALORENLETRAS',array('class'=>'span5','maxlength'=>200)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
