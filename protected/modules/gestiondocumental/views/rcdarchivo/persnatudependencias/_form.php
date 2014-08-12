<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'persnatudependencias-form',
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
		$data=$model->personasNaturales();
		$list = CHtml::listData($data,'PENA_ID', 'PERSONA'); 
		
		
		echo $form->labelEx($model,'PENA_ID');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'PENA_ID',
		  'data'=>$list,
		  'value'=>$list->PENA_ID,
		  'attribute'=>'PENA_ID',
		  //'model'=>$model,
		  'options'=>array(
			'placeholder'=>'Buscar registro en la base de datos',
			'allowClear'=>true,
			'width'=>'350px',
		  ),
		)); 
		?>	
		<?php echo $form->error($model,'PENA_ID'); ?>
		
        <?php 
		$criterio = new CDbCriteria;
		$criterio ->select = 'PENA_ID, PERSONA';
		$criterio->order = 'PERSONA ASC';    
       ?><br><br>
	   
	<?php echo $form->labelEx($model,'DEPE_ID'); ?>
	<?php echo $form->dropDownList($model,'DEPE_ID', CHtml::listData(Dependencias::model()->findAll(array('order'=>'DEPE_NOMBRE')), 'DEPE_ID','DEPE_NOMBRE'), array('empty'=>' '));?><?php echo $form->error($model,'DEPE_ID'); ?>

    <?php echo $form->labelEx($model,'CARG_ID'); ?>
	<?php echo $form->dropDownList($model,'CARG_ID', CHtml::listData(Cargos::model()->findAll(array('order'=>'CARG_NOMBRE')), 'CARG_ID','CARG_NOMBRE'), array('empty'=>' '));?>
	<?php echo $form->error($model,'CARG_ID'); ?>

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




