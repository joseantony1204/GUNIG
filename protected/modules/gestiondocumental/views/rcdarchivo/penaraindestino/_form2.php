<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'penaraindestino-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo RADICADO,": ";?><br>
	<strong style="border-bottom-style:groove"><?php echo $model->RAIN_ID; ?> </strong>
	<br><br>
	
	<?php echo DESTINATARIO,": ";?><br>
	<strong style="border-bottom-style:groove"><?php echo $model->rel_persnatudependencias->rel_personasnaturales->PENA_NOMBRES. " ". $model->rel_persnatudependencias->rel_personasnaturales->PENA_APELLIDOS  . " (". $model->rel_persnatudependencias->dEPE->DEPE_NOMBRE  .")". " ". $model->PNRD_GRUPO; ?> </strong>
	<br><br>
	
	<?php echo 'ENTREGADO POR',": ";?><br>
	<strong style="border-bottom-style:groove"><?php echo $model->mENS->rel_personasnaturales->PENA_NOMBRES. " ". $model->mENS->rel_personasnaturales->PENA_APELLIDOS. "  -  ". $model->mENS->MENS_DESCRIPCION; ?> </strong>
	<br><br>
	
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




