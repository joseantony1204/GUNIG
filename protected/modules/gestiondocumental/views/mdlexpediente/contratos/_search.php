<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'CONT_NUMORDEN',array('class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'PERS_ID',array('class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'TICO_ID',array('class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'CLCO_ID',array('class'=>'span4')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
