<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'sedes-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'SEDE_NOMBRE',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->labelEx($model,'UNIV_ID'); ?>
	<?php $data = CHtml::listData(Universidades::model()->findAll(),'UNIV_ID','UNIV_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'UNIV_ID',$data, array('class'=>'span5','prompt'=>'Elije...')); ?>
    <?php echo $form->error($model,'UNIV_ID'); ?>
	
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




