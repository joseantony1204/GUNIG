<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'personasnaturalesestudios-form',
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
	$criterio = array('order'=>'ESTU_NOMBRE ASC');
	$data=Estudios::model()->findAll($criterio);    
	$list = CHtml::listData($data,'ESTU_ID', 'ESTU_NOMBRE'); 
	
	echo $form->labelEx($model, 'ESTU_ID');
	$this->widget('ext.select2.ESelect2',array(
	  'name'=>'ESTU_ID',
	  'data'=>$list,
	  'value'=>$list->ESTU_ID,
	  'attribute'=>'ESTU_ID',
	  'options'=>array(
		'placeholder'=>'Buscar registro en la base de datos',
		'allowClear'=>true,
		'width'=>'370px',
	  ),
	)); 
	
	?>
  <br /> <br />
	<?php echo $form->textFieldRow($model,'PENE_LUGAR',array('class'=>'span4','maxlength'=>200)); ?>
    <?php echo $form->labelEx($model,'PENE_FECHACULMINACION'); ?>
    <?php
     if ($model->PENE_FECHACULMINACION!='') {
     $model->PENE_FECHACULMINACION = date('Y-m-d',strtotime($model->PENE_FECHACULMINACION));
     }else{
		  $model->PENE_FECHACULMINACION = '0000-00-00';
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'PENE_FECHACULMINACION',
     'value'=>$model->PENE_FECHACULMINACION,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->PENE_FECHACULMINACION,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Culminación',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
    <?php echo $form->error($model,'PENE_FECHACULMINACION'); ?> 

	<?php echo $form->hiddenField($model,'PENA_ID',array('class'=>'span5')); ?>

    
	<?php echo $form->labelEx($model,'ESES_ID'); ?>
	<?php $data = CHtml::listData(Estadosestudios::model()->findAll(),'ESES_ID','ESES_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'ESES_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
    <?php echo $form->error($model,'ESES_ID'); ?>

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




