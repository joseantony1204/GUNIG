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

	<?php
    echo $form->labelEx($model, 'ARCHIVO');
    echo $form->fileField($model, 'ARCHIVO',array('class'=>'span5','maxlength'=>45,'size' =>57));
    echo $form->error($model, 'ARCHIVO');
    ?>
	
	<?php echo $form->hiddenField($model,'RAIN_ESCANEORUTA',array('class'=>'span5','maxlength'=>45)); ?>
	<br><br>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>'Agregar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




