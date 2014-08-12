<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'fechasgrados-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

      <?php echo $form->labelEx($model,'FEGR_FECHA'); ?>
     <?php
     if ($model->FEGR_FECHA=='') {
     $model->FEGR_FECHA = date('d-m-Y');
     }else{
		 if ($model->FEGR_FECHA=='0000-00-00') {
		  $model->FEGR_FECHA = date('d-m-y');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'FEGR_FECHA',
     'value'=>$model->FEGR_FECHA,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->FEGR_FECHA,
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
         <?php echo $form->error($model,'FEGR_FECHA'); ?>
    
<?php echo $form->labelEx($model,'SEDE_ID'); ?>
<?php $data3=Sedes::model()->getSedes();?>
   <?php echo $form->dropDownList($model,'SEDE_ID',$data3, array('class'=>'span4','prompt'=>'Elije una sede...')); ?>
             <?php echo $form->error($model,'SEDE_ID'); ?> 


	    
    <?php echo $form->labelEx($model,'FEGR_ESTADO'); ?>
    <?php echo $form->dropDownList($model,'FEGR_ESTADO',array('1'=>'ACTIVO','0'=>'INACTIVO'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'FEGR_ESTADO'); ?>

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




