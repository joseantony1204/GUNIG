<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'RESO_ID',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'RESO_NUMERO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'RESO_FECHASUSCRIPCION',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'RELI_VALOR',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'RESO_CONCEPTO',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'RESO_FECHAPROCESO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PERS_ID',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'CLRE_ID',array('class'=>'span5')); ?>

	

	<?php //echo $form->textFieldRow($model,'ANAC_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
