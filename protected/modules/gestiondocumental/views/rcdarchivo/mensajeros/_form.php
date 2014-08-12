<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'mensajeros-form',
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
		
       <br><br>
	<?php echo $form->labelEx($model,'MENS_DESCRIPCION'); ?>
    <?php echo $form->dropDownList($model,'MENS_DESCRIPCION',array('MENSAJERO INTERNO'=>'MENSAJERO INTERNO','MENSAJERO EXTERNO'=>'MENSAJERO EXTERNO','APOYO A MENSAJERIA'=>'APOYO A MENSAJERIA','SELLO DE RESPONSABILIDAD'=>'SELLO DE RESPONSABILIDAD (AUTOENTREGA)'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'MENS_DESCRIPCION'); ?>

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




