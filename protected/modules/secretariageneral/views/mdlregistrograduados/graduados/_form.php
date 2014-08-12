<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'graduados-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	

	   
   
   

	

	<?php echo $form->textFieldRow($model,'GRAD_PRIMER_APELLIDO',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'GRAD_SEGUNDO_APELLIDO',array('class'=>'span5','maxlength'=>50)); ?>
     <?php echo $form->textFieldRow($model,'GRAD_NOMBRES',array('class'=>'span5','maxlength'=>200)); ?>
<?php echo $form->textFieldRow($model,'GRAD_CEDULA',array('class'=>'span5')); ?>
 <?php echo $form->textFieldRow($model,'GRAD_LUGAR_EXPEDICION',array('class'=>'span5')); ?>

 <?php echo $form->labelEx($model,'SEXO_ID'); 
 $data=Sexos::model()->getSexos();
 ?>
    <?php echo $form->dropDownList($model,'SEXO_ID',$data, array('class'=>'span4','prompt'=>'Selecciona el sexo...'));?>
    <?php echo $form->error($model,'SEXO_ID'); ?>
    
	   
 <?php echo $form->labelEx($model,'GRAD_FECHA_EXPEDICION'); ?>
     <?php
     if ($model->GRAD_FECHA_EXPEDICION=='') {
     $model->GRAD_FECHA_EXPEDICION = date('Y-m-d');
     }else{
		 if ($model->GRAD_FECHA_EXPEDICION=='0000-00-00') {
		  $model->GRAD_FECHA_EXPEDICION = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'GRAD_FECHA_EXPEDICION',
     'value'=>$model->GRAD_FECHA_EXPEDICION,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->GRAD_FECHA_EXPEDICION,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Ingreso',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
    <?php echo $form->error($model,'GRAD_FECHA_EXPEDICION'); ?>
    

    <?php echo $form->labelEx($model,'GRAD_FECHA_NACIMIENTO'); ?>
     <?php
     if ($model->GRAD_FECHA_NACIMIENTO=='') {
     $model->GRAD_FECHA_NACIMIENTO = date('Y-m-d');
     }else{
		 if ($model->GRAD_FECHA_NACIMIENTO=='0000-00-00') {
		  $model->GRAD_FECHA_NACIMIENTO = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'GRAD_FECHA_NACIMIENTO',
     'value'=>$model->GRAD_FECHA_NACIMIENTO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->GRAD_FECHA_NACIMIENTO,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Ingreso',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
    <?php echo $form->error($model,'GRAD_FECHA_NACIMIENTO'); ?>

<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$model->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	    
         <?php

         
		    echo CHtml::link('Cancelar',array('mdlregistrograduados/registrograduados/create')); 
?>         
	</div>


<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




