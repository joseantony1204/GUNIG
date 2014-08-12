<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'catedraticoscontratos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'CACO_ANIO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CACO_VALORHORA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CACO_FECHAPROCESO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CACO_NUMORDEN',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'PECO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PENC_ID',array('class'=>'span5')); ?>

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




