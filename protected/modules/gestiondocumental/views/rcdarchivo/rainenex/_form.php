<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'rainenex-form',
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
		<?php //echo $form->error($model,'ENEX_ID'); ?>
		
        <?php 
		$criterio = new CDbCriteria;
		$criterio ->select = 'ENEX_ID, ENTE';
		$criterio->order = 'ENTE ASC';    
       ?>
	   <br><br>
	   <?php echo $form->textFieldRow($model,'RIEE_GUIAENVIO',array('class'=>'span3','maxlength'=>45)); ?>
	   
	   <br><br>
	   <?php 
		$data=$model->personaMensajeros();
		$list = CHtml::listData($data,'MENS_ID', 'MENSAJERO'); 
		
		
		echo $form->labelEx($model,'MENS_ID');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'MENS_ID',
		  'data'=>$list,
		  'value'=>$list->MENS_ID,
		  'attribute'=>'MENS_ID',
		  //'model'=>$model,
		  'options'=>array(
			'placeholder'=>'Buscar registro en la base de datos',
			'allowClear'=>true,
			'width'=>'480px',
		  ),
		)); 
		?>	
		<?php echo $form->error($model,'MENS_ID'); ?>
		
        <?php 
		$criterio = new CDbCriteria;
		$criterio ->select = 'MENS_ID, MENSAJERO';
		$criterio->order = 'MENSAJERO ASC';    
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




