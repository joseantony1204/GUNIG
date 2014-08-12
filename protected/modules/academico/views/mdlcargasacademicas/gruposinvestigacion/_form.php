<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'gruposinvestigacion-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'GRIN_NOMBRE',array('class'=>'span5','maxlength'=>200)); ?>

	<?php  
	 echo $form->labelEx($model, 'CAGI_ID');
	   $data = CHtml::listData(Categruposinvestigacion::model()->findAll(),'CAGI_ID','CAGI_NOMBRE') ?>
       <?php echo $form->dropDownList($model,'CAGI_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'CAGI_ID');?>

	<?php echo $form->textFieldRow($model,'GRIN_ANIO_CALIFICACION',array('class'=>'span5','maxlength'=>4)); ?>

	<?php echo $form->textFieldRow($model,'GRIN_GRUPLAC',array('class'=>'span5','maxlength'=>200)); ?>

	<?php  
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 $data = CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto');  ?>
       <?php echo $form->dropDownList($model,'PENA_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'PENA_ID'); ?>
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




