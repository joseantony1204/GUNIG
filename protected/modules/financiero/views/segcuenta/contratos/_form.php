<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contratos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textAreaRow($model,'CONT_NUMORDEN',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'CONT_ANIO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CONT_FECHAINICIO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CONT_FECHAFINAL',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CONT_FECHAPROCESO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PERS_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PECO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'TICO_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'CLCO_ID',array('class'=>'span5')); ?>

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




