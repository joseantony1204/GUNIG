<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'RAEX_ID',array('class'=>'span2')); ?>

	<?php echo $form->labelEx($model,'RAEX_FECHARECIBIDO'); ?>
	
	<?php
             if ($model->RAEX_FECHARECIBIDO!='') {
             $model->RAEX_FECHARECIBIDO = date('Y-m-d',strtotime($model->RAEX_FECHARECIBIDO));
             }
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'RAEX_FECHARECIBIDO',
             'value'=>$model->RAEX_FECHARECIBIDO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$model->RAEX_FECHARECIBIDO,
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

	<?php echo $form->textFieldRow($model,'RAEX_ASUNTO',array('class'=>'span5','maxlength'=>200)); ?>

	<?php //echo $form->textFieldRow($model,'RAEX_NUMEROANEXOS',array('class'=>'span3')); ?>

	<?php //echo $form->textFieldRow($model,'RAEX_ESCANEORUTA',array('class'=>'span5','maxlength'=>100)); ?>

	<?php //echo $form->textFieldRow($model,'RAEX_ESTADO',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'EMCO_ID',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div> 

<?php $this->endWidget(); ?>
