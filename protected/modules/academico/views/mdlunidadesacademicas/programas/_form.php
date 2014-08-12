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

	<?php echo $form->textFieldRow($model,'PROG_NOMBRE',array('class'=>'span5','maxlength'=>100)); ?>

<?php echo $form->labelEx($model, 'FACU_ID');
	$criteria=new CDbCriteria;
     $criteria->select='t.FACU_ID, t.FACU_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_FACULTADES c ON t.FACU_ID = c.FACU_ID';	
	 $criteria->order = 't.FACU_NOMBRE ASC';
	 $data = CHtml::listData(Facultades::model()->findAll($criteria),'FACU_ID','FACU_NOMBRE');  ?>
       <?php echo $form->dropDownList($model,'FACU_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'FACU_ID');   ?>

<?php echo $form->labelEx($model, 'NIES_ID');
	$criteria=new CDbCriteria;
     $criteria->select='NIES_ID, NIES_NOMBRE';
	 $data = CHtml::listData(Nivelesestudios::model()->findAll($criteria),'NIES_ID','NIES_NOMBRE');  ?>
       <?php echo $form->dropDownList($model,'NIES_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'NIES_ID');   ?>


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




