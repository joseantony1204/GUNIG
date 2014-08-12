<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'folios-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'FOLI_NOMBRE',array('class'=>'span5')); ?>

	   
    <?php 
	  echo $form->labelEx($model, 'LIBR_ID');
	    
	 $criteria=new CDbCriteria;
     $criteria->select='LIBR_ID, LIBR_ESTADO';
	 $criteria->addCondition('LIBR_ESTADO=1');
	 $criteria->order = 'LIBR_ID DESC';
	 $data = CHtml::listData(Libros::model()->findAll($criteria),'LIBR_ID','LIBR_ID');  ?>
       <?php echo $form->dropDownList($model,'LIBR_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'LIBR_ID');   ?>

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




