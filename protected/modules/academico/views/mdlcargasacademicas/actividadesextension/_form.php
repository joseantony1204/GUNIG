<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'actividadesextension-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

  
  
    <table border="0" cellspacing="0" cellpadding="7">
  <tr>
    <td><?php  
	 
     echo $form->labelEx($model, 'PENA_ID');
	  $data=Personasnaturales::model()->getNombreCompletoId(); 
	 ?></td>
    <td><?php $list = CHtml::listData($data,'PENA_ID', 'id'); 
	     $this->widget('ext.select2.ESelect2',array(
      'name'=>'PENA_ID',
      'data'=>$list,
      'value'=>$list->PENA_ID,
      'attribute'=>'PENA_ID',
      'options'=>array(
        'placeholder'=>'Buscar registro en la base de datos',
        'allowClear'=>true,
        'width'=>'400px',
      ),
    )); ?>
    </td>
   <td><?php echo $form->error($model,'PENA_ID'); ?></td> 
  </tr>
   <tr>
    <td><?php  echo $form->labelEx($model, 'PEAC_ID');?></td>
    <td><?php
	 $data=Periodosacademicos::model()->getPeriodo();
	 $list = CHtml::listData($data,'PEAC_ID','PEAC_NOMBRE');
	   $this->widget('ext.select2.ESelect2',array(
	  'name'=>'PEAC_ID',
      'data'=>$list,
      'value'=>$list->PEAC_ID,
      'attribute'=>'PEAC_ID',
      'options'=>array(
        'placeholder'=>'Buscar registro en la base de datos',
        'allowClear'=>true,
        'width'=>'400px',
      ),
    ));
	 
	  ?></td>
     <td> <?php echo $form->error($model,'PEAC_ID'); ?></td>
  </tr>
  <tr>
    <td><?php  echo $form->labelEx($model, 'ACEX_ACTIVIDAD_EXTENCION');?></td>
    <td><?php  echo $form->textField($model, 'ACEX_ACTIVIDAD_EXTENCION', array('class'=>'span5','maxlength'=>500, 'style'=>'width:399px'));?></td>
     <td><?php echo $form->error($model,'ACEX_ACTIVIDAD_EXTENCION'); ?></td>
  </tr>
  <tr>
    <td><?php  echo $form->labelEx($model, 'ACEX_HORAS_DEDICACION_SEMANAL');?></td>
    <td><?php  echo $form->textField($model, 'ACEX_HORAS_DEDICACION_SEMANAL', array('class'=>'span5','maxlength'=>70, 'style'=>'width:70px'));?></td>
     <td><?php echo $form->error($model,'ACEX_HORAS_DEDICACION_SEMANAL'); ?></td>
  </tr>
</table>
  
     
	
	
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




