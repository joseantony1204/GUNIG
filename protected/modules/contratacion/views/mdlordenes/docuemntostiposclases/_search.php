<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'DOTC_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'DOCU_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TICO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CLCO_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
