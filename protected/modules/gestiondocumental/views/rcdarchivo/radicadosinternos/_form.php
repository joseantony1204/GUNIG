<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'radicadosinternos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well','enctype' => 'multipart/form-data'),
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->hiddenField($model,'RAIN_FECHA',array('value'=>date("Y-m-d").' '.date("h:i:s"),)); ?>
	
	<?php echo $form->textFieldRow($model,'RAIN_ASUNTO',array('class'=>'span5','maxlength'=>400)); ?>
		
	<?php echo $form->hiddenField($model,'RAIN_ESCANEORUTA',array('class'=>'span5','maxlength'=>45)); ?>
	
	<?php echo $form->textFieldRow($model,'RAIN_NUMEROANEXOS',array('class'=>'span3','maxlength'=>100)); ?>
	
	<?php echo $form->labelEx($model,'RAIN_TIPO'); ?>
    <?php echo $form->dropDownList($model,'RAIN_TIPO',array('Interno a Interno'=>'Interno a Interno','Interno a Externo'=>'Interno a Externo'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'RAIN_TIPO'); ?>
	
	<?php echo $form->hiddenField($model,'RAIN_ESTADO',array('class'=>'input input_r input_pryk', 'value'=>'0')); ?>
	
	<?php echo $form->textFieldRow($model,'RAIN_UBICACION',array('class'=>'span3')); ?>
		
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$model->isNewRecord ? 'Radicar' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




