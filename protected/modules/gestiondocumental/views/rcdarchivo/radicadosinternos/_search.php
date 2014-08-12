<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'RAIN_ID',array('class'=>'span2')); ?>

	<?php echo $form->labelEx($model,'RAIN_FECHA'); ?>
	
	<?php
             if ($model->RAIN_FECHA!='') {
             $model->RAIN_FECHA = date('Y-m-d',strtotime($model->RAIN_FECHA));
             }
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'RAIN_FECHA',
             'value'=>$model->RAIN_FECHA, 
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$model->RAIN_FECHA,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha del Documento',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => true,
             'changeYear' => true,
             ),
             )); ?>

	<?php echo $form->textFieldRow($model,'RAIN_ASUNTO',array('class'=>'span5','maxlength'=>200)); ?>

	<?php //echo $form->textFieldRow($model,'RAIN_ESCANEORUTA',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'RAIN_NUMEROANEXOS',array('class'=>'span3')); ?>

	<?php //echo $form->textFieldRow($model,'RAIN_ESTADO',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'RAIN_TIPO',array('class'=>'span5','maxlength'=>20)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
