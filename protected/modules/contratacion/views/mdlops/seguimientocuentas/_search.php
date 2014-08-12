<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'SECU_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SECU_ESTADO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SECU_FECHAINGRESO',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'SECU_NUMORDENPAGO',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'SECU_VRORDENPAGO',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'SECU_CODIGOCDP',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'SECU_NUMCHECQUE',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'SECU_VALORCHEQUE',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'SECU_FECHAPAGO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SEUD_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CUEN_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
