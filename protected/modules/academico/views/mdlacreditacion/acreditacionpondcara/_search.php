<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'ACPO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACPO_GRUPO1',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACPO_GRUPO2',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACPO_GRUPO3',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACPO_GRUPO4',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACPO_GRUPO5',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACCA_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ACPO_FECHA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'USUA_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
