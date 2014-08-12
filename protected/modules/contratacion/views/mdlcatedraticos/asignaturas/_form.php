<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'asignaturas-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'ASIG_CODIGO',array('class'=>'span4','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'ASIG_NOMBRE',array('class'=>'span4','maxlength'=>500)); ?>
    
	<?php echo $form->labelEx($model,'PROG_ID'); ?>
    <?php $data = CHtml::listData(Programas::model()->findAll(),'PROG_ID','PROG_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'PROG_ID',$data, array('class'=>'span4','prompt'=>'Elige...')); ?>
    <?php echo $form->error($model,'PROG_ID'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$model->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




