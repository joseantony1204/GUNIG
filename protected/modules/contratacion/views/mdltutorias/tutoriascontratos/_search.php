<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'PERS_IDENTIFICACION',
	array('class'=>'span4', 'placeholder'=>'Ingrese solo identificación', 'prepend'=>'<i class="icon-user"></i>')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
