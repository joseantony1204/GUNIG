<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'presupuestos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'PRES_NUM_CERTIFICADO',array('class'=>'span3','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'PRES_DESCRIPCION',array('class'=>'span3','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'PRES_SECCION',array('class'=>'span3','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'PRES_CODIGO',array('class'=>'span3','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'PRES_MONTO',array('class'=>'span3')); ?>

    <?php echo $form->labelEx($model,'PRES_FECHA_VIGENCIA'); ?>
     <?php
     if ($model->PRES_FECHA_VIGENCIA=='') {
     $model->PRES_FECHA_VIGENCIA = date('Y-m-d');
     }else{
		  $model->PRES_FECHA_VIGENCIA = date('Y-m-d',strtotime($model->PRES_FECHA_VIGENCIA));
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'PRES_FECHA_VIGENCIA',
     'value'=>$model->PRES_FECHA_VIGENCIA,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->PRES_FECHA_VIGENCIA,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Vigencia',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
    <?php echo $form->error($model,'PRES_FECHA_VIGENCIA'); ?> 


    <?php $fecha = date("Y-m-d")." ".date("h:i:s  A"); ?>
    <?php echo $form->hiddenField($model,'PRES_FECHA_INGRESO',array('value'=>$fecha)); ?>

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




