<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'CONT_ID',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'CONT_NUMORDEN',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'CONT_ANIO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CONT_FECHAINICIO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CONT_FECHAFINAL',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CONT_FECHAPROCESO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PERS_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PECO_ID',array('class'=>'span5')); ?>

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
