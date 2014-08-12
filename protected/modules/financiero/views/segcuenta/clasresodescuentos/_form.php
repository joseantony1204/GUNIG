<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'clasresodescuentos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'CLRE_ID',array('class'=>'span5')); ?>

	
    
    <?php 
		$data=$model->descuento($model->CLRE_ID);
		$list = CHtml::listData($data,'DESC_ID', 'DESC_NOMBRE'); 
		
		
		echo $form->labelEx($model,'DESC_ID');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'DESC_ID',
		  'data'=>$list,
		  'value'=>$list->DESC_ID,
		  'model'=>$model,
		  'attribute'=>'DESC_ID',
		  'options'=>array(
			'placeholder'=>'Buscar registro en la base de datos',
			'allowClear'=>true,
			'width'=>'300px',
		  ),
		)); 
		?>	
		<?php echo $form->error($model,'DESC_ID'); ?>
		
        <?php 
		$criterio = new CDbCriteria;
		$criterio ->select = 'DESC_ID, DESC_NOMBRE';
		$criterio->order = 'DESC_NOMBRE ASC';    
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




