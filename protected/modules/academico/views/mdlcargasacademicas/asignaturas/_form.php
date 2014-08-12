<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'asignaturas-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'ASIG_CODIGO',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'ASIG_NOMBRE',array('class'=>'span5','maxlength'=>500)); ?>

	<?php echo $form->textFieldRow($model,'ASIG_NUMERO_CREDITOS',array('class'=>'span5')); ?>

	<?php  
	 $criteria=new CDbCriteria;
     $criteria->select='t.PROG_ID, t.PROG_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PROGRAMAS c ON t.PROG_ID = c.PROG_ID';	
	 $criteria->order = 't.PROG_NOMBRE ASC';
	 $data = CHtml::listData(Programas::model()->findAll($criteria),'PROG_ID','PROG_NOMBRE');  ?>
       <?php echo $form->dropDownList($model,'PROG_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'PROG_ID'); ?>

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




