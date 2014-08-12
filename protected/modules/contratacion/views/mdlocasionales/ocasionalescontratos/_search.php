<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

    <?php echo $form->textFieldRow($model,'PERS_IDENTIFICACION',array('class'=>'span4')); ?>
    
    <?php echo $form->textFieldRow($model,'PENA_NOMBRES',array('class'=>'span4')); ?>
    
    <?php echo $form->textFieldRow($model,'PENA_APELLIDOS',array('class'=>'span4')); ?>
    
	<?php echo $form->textFieldRow($model,'OCCO_RESOLUCION',array('class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'OCCO_MESES',array('class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'OCCO_DIAS',array('class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'OCCO_VALORMENSUAL',array('class'=>'span4')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
