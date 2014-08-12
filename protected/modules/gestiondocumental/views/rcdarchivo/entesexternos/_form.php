<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'entesexternos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?> 

	<?php echo $form->textFieldRow($model,'ENEX_NOMBRE',array('class'=>'span4','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'ENEX_CIUDAD',array('class'=>'span3','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'ENEX_TELEFONO',array('class'=>'span3','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'ENEX_DIRECCION',array('class'=>'span3','maxlength'=>50)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$model->isNewRecord ? 'Agregar' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




