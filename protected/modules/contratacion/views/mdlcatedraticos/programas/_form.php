<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'programas-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'PROG_NOMBRE',array('class'=>'span4','maxlength'=>100)); ?>


    <?php echo $form->labelEx($model,'FACU_ID'); ?>
    <?php $data = CHtml::listData(Facultades::model()->findAll(),'FACU_ID','FACU_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'FACU_ID',$data, array('class'=>'span4','prompt'=>'Elige...')); ?>
    <?php echo $form->error($model,'FACU_ID'); ?>
    
    <?php echo $form->labelEx($model,'NIES_ID'); ?>
    <?php $data = CHtml::listData(Nivelesestudios::model()->findAll(),'NIES_ID','NIES_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'NIES_ID',$data, array('class'=>'span4','prompt'=>'Elige...')); ?>
    <?php echo $form->error($model,'NIES_ID'); ?>
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




