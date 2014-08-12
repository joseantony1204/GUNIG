<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'enexraex-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'RAEX_ID',array('class'=>'span5')); ?>

	<?php 
		$data=$model->ente();
		$list = CHtml::listData($data,'ENEX_ID', 'ENTE'); 
		
		
		echo $form->labelEx($model,'ENEX_ID');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'ENEX_ID',
		  'data'=>$list,
		  'value'=>$list->ENEX_ID,
		  'attribute'=>'ENEX_ID',
		  //'model'=>$model,
		  'options'=>array(
			'placeholder'=>'Buscar registro en la base de datos',
			'allowClear'=>true,
			'width'=>'480px',
		  ),
		)); 
		?>	
		<?php echo $form->error($model,'ENEX_ID'); ?>
		
        <?php 
		$criterio = new CDbCriteria;
		$criterio ->select = 'ENEX_ID, ENTE';
		$criterio->order = 'ENTE ASC';    
       ?>


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




