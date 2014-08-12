<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'descuentosatributos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'DEAT_CODIGO',array('class'=>'span5','maxlength'=>10)); ?>
    
	<?php echo $form->textFieldRow($model,'DEAT_DESCRIPCION',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'DEAT_DESDE',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'DEAT_HASTA',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'DEAT_VALOR',array('class'=>'span5')); ?>

	<?php echo $form->hiddenField($model,'DESC_ID'); ?>
    
    <?php echo $form->labelEx($model,'ANAC_ID'); ?>
	<?php echo $form->dropDownList($model,'ANAC_ID', CHtml::listData(Aniosacademicos::model()->findAll(), 'ANAC_ID','ANAC_ID'), array('empty'=>' '));?>
	<?php echo $form->error($model,'ANAC_ID'); ?>
        
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




