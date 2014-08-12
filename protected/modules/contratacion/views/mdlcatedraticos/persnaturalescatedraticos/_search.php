<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>


	<?php echo $form->textFieldRow($model,'PERS_IDENTIFICACION',array('class'=>'span4')); ?>
    
    <?php echo $form->textFieldRow($model,'PENA_NOMBRES',array('class'=>'span4')); ?>
    
    <?php echo $form->textFieldRow($model,'PENA_APELLIDOS',array('class'=>'span4')); ?>
   
    <?php /*echo $form->labelEx($model,'FACU_ID'); ?>
	<?php $data = CHtml::listData(Facultades::model()->findAll(),'FACU_ID','FACU_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'FACU_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
    <?php echo $form->error($model,'FACU_ID'); */?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
