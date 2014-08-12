<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'COIC_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'COIC_CODIGO',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textAreaRow($model,'COIC_NORMA_APROBACION_UNIGUAJIRA',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'COIC_NORMA_APROBACION_ICFES',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'COIC_FECHA_VENCIMIENTO',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'COIC_ESTADO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'JORN_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'METO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TITU_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PROG_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SEDE_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
