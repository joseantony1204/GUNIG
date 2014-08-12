<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'penarainenvia-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	
	<?php 
		$data=$model->personaDependencia();
		$list = CHtml::listData($data,'PEND_ID', 'PERSONA'); 
		
		
		echo $form->labelEx($model,'PEND_ID');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'PEND_ID',
		  'data'=>$list,
		  'value'=>$list->PEND_ID,
		  'attribute'=>'PEND_ID',
		  //'model'=>$model,
		  'options'=>array(
			'placeholder'=>'Buscar registro en la base de datos',
			'allowClear'=>true,
			'width'=>'480px',
		  ),
		)); 
		?>	
		<?php echo $form->error($model,'PEND_ID'); ?>
		
        <?php 
		$criterio = new CDbCriteria;
		$criterio ->select = 'PEND_ID, PERSONA';
		$criterio->order = 'PERSONA ASC';    
       ?>
	
	

	<?php echo $form->hiddenField($model,'RAIN_ID',array('class'=>'span5')); ?>

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




