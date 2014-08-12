<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'representante-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<p><?php //echo $form->errorSummary($model); ?></p>
	
	  
	  <?php //echo $form->textFieldRow($model,'PERS_ID',array('class'=>'span5')); ?> 
	
	     <?php 
		$data=$Personas->nombrePersonasNaturales();   
		$list = CHtml::listData($data,'PERS_ID', 'NOMBRE');  
		//$list = CHtml::listData('PERS_ID', 'NOMBRE');  
		//echo $form->labelEx($model, 'PERS_ID');
		echo "<br/>ELEGIR EL REPRESENTANTE LEGAL - ";
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'PERS_ID',
		  'data'=>$list,
		  'value'=>$list->PERS_ID,
		  'attribute'=>'PERS_ID',
		  'options'=>array(
			'placeholder'=>'Buscar registro en la base de datos',
			'allowClear'=>true,
			'width'=>'370px',
		  ),
		)); 
		?>
	  <?php 	//echo $form->error($Contratos,'PERS_ID'); ?>   
    
    
    
    
    
      
	  <?php echo $form->hiddenField($model,'PEJU_ID',array('class'=>'span5')); ?>
	  
	  
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




