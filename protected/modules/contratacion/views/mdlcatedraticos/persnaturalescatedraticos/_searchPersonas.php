<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

    <?php echo $form->labelEx($Personasnaturales,'TIID_ID'); ?>
    <?php $criterio = array('join'=>'INNER JOIN TBL_PERSONAS p ON t.TIID_ID = p.TIID_ID'); ?>
	<?php $data = CHtml::listData(Tiposidentificacion::model()->findAll($criterio),'TIID_ID','TIID_NOMBRE') ?>
    <?php echo $form->dropDownList($Personasnaturales,'TIID_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?>
    <?php echo $form->error($Personasnaturales,'TIID_ID'); ?>

	<?php echo $form->textFieldRow($Personasnaturales,'PERS_IDENTIFICACION',
	array('class'=>'span3', 'placeholder'=>'Ingrese solo identificación', 'prepend'=>'<i class="icon-user"></i>')); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
