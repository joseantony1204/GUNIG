<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'recibidos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->labelEx($model,'RECI_FECHA'); ?>
	
	<?php
             if ($model->RECI_FECHA!='') {
             $model->RECI_FECHA = date('Y-m-d',strtotime($model->RECI_FECHA));
             }
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'RECI_FECHA',
             'value'=>$model->RECI_FECHA,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$model->RECI_FECHA,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha de Recibido',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => 'true',
             'changeYear' => 'true',
             ),
             )); ?>

	
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
			'width'=>'300px',
		  ),
		)); 
		?>	
		<?php echo $form->error($model,'PENA_ID'); ?>

	<?php echo $form->hiddenField($model,'RAIN_ID',array('class'=>'span3')); ?>

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




