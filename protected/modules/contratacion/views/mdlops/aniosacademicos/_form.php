<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'aniosacademicos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'ANAC_ID',array('class'=>'span3', 'value'=>date("Y"))); ?>

	<?php echo $form->textFieldRow($model,'ANAC_NOMBRE',array('class'=>'span3','maxlength'=>50,)); ?>

	<?php echo $form->labelEx($model,'ANAC_FECHA_INICIO'); ?>
     <?php
     if ($model->ANAC_FECHA_INICIO=='') {
     $model->ANAC_FECHA_INICIO = date('Y-'.'01-01'.'');
     }else{
		  $model->ANAC_FECHA_INICIO = date('Y-m-d',strtotime($model->ANAC_FECHA_INICIO));
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'ANAC_FECHA_INICIO',
     'value'=>$model->ANAC_FECHA_INICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->ANAC_FECHA_INICIO,
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
    <?php echo $form->error($model,'ANAC_FECHA_INICIO'); ?> 
    
    <?php echo $form->labelEx($model,'ANAC_FECHA_FINAL'); ?>
     <?php
     if ($model->ANAC_FECHA_FINAL=='') {
     $model->ANAC_FECHA_FINAL = date('Y-'.'12-31'.'');
     }else{
		  $model->ANAC_FECHA_FINAL = date('Y-m-d',strtotime($model->ANAC_FECHA_FINAL));
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'ANAC_FECHA_FINAL',
     'value'=>$model->ANAC_FECHA_FINAL,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->ANAC_FECHA_FINAL,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Final',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
    <?php echo $form->error($model,'ANAC_FECHA_FINAL'); ?> 

    <?php echo $form->labelEx($model,'ANAC_ESTADO'); ?>
    <?php echo $form->dropDownList($model,'ANAC_ESTADO',array('0'=>'ACTIVO','1'=>'INACTIVO'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'ANAC_ESTADO'); ?>

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




