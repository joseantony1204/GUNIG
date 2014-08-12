<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'evamodeloscriterios-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'MOOR_ID',array('class'=>'span5')); ?>
    
    <?php $dataV = CHtml::listData(Evacriterios::model()->findAll(), 'EVCR_ID', 'EVCR_NOMBRE');  ?>
	<?php echo	$form->checkBoxListInlineRow($model, 'EVCR_ID', $dataV);    ?> 
    

	<?php //echo $form->textFieldRow($model,'EVCR_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EVES_ID',array('class'=>'span5')); ?>

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



