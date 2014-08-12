<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'usuarioscontroladores-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'USCO_NOMBRE',array('class'=>'span4','maxlength'=>200)); ?>

	<?php echo $form->textAreaRow($model,'USCO_URL',array('class'=>'span4')); ?>

    <?php echo $form->labelEx($model,'USSM_ID'); ?>
	<?php $data = CHtml::listData(Usuariossubmodulos::model()->findAll(),'USSM_ID','USSM_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'USSM_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
    <?php echo $form->error($model,'USSM_ID'); ?>

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




