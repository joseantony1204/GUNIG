<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'radicadosexternos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well','enctype' => 'multipart/form-data'),
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->labelEx($model,'EMCO_ID'); ?>
	<?php echo $form->dropDownList($model,'EMCO_ID', CHtml::listData(Empresascorreos::model()->findAll(array('order'=>'EMCO_NOMBRE')), 'EMCO_ID','EMCO_NOMBRE'), array('empty'=>' '));?>
	<?php echo $form->error($model,'EMCO_ID'); ?>
	
	<?php echo $form->hiddenField($model,'RAEX_FECHARECIBIDO',array('value'=>date("Y-m-d").' '.date("h:i:s"),)); ?>
	<br>
	
	<?php echo $form->textFieldRow($model,'RAEX_GUIAENVIO',array('class'=>'span3','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'RAEX_NUMERODOCUMENTO',array('class'=>'span3','maxlength'=>45)); ?>

	<?php echo $form->labelEx($model,'RAEX_FECHADOCUMENTO'); ?>
	
	<?php
             if ($model->RAEX_FECHADOCUMENTO!='') {
             $model->RAEX_FECHADOCUMENTO = date('Y-m-d',strtotime($model->RAEX_FECHADOCUMENTO));
             }
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'RAEX_FECHADOCUMENTO',
             'value'=>$model->RAEX_FECHADOCUMENTO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$model->RAEX_FECHADOCUMENTO,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha del Documento',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => 'true',
             'changeYear' => 'true',
             ),
             )); ?>

	<?php echo $form->textFieldRow($model,'RAEX_ASUNTO',array('class'=>'span5','maxlength'=>400)); ?>
		
	<?php echo $form->hiddenField($model,'RAEX_ESCANEORUTA',array('class'=>'span5','maxlength'=>45)); ?>
	
	<?php echo $form->textFieldRow($model,'RAEX_NUMEROANEXOS',array('class'=>'span3','maxlength'=>100)); ?>
	
	<?php echo $form->hiddenField($model,'RAEX_ESTADO',array('class'=>'input input_r input_pryk', 'value'=>'0')); ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$model->isNewRecord ? 'Radicar' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




