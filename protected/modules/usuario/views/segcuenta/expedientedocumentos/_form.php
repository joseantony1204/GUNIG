<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'expedientedocumentos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well','enctype' => 'multipart/form-data'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>


	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'EXDO_FECHAINGRESO',array('value'=>date("Y-m-d").' '.date("h:i:s"),)); ?>

	<?php echo $form->hiddenField($model,'CONT_ID',array('class'=>'span5')); ?>

    <?php echo $form->labelEx($model,'TIDO_ID'); ?>
	<?php $data = CHtml::listData(Tiposdocumentos::model()->findAll(),'TIDO_ID','TIDO_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'TIDO_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
    <?php echo $form->error($model,'TIDO_ID'); ?>
    
	<?php
    echo $form->labelEx($model, 'ARCHIVO');
    echo $form->fileField($model, 'ARCHIVO',array('class'=>'span5','maxlength'=>45,'size' =>57));
    echo $form->error($model, 'ARCHIVO');
    ?>
    
	<?php echo $form->hiddenField($model,'EXDO_RUTA',array('class'=>'span5','maxlength'=>45)); ?>
    <br><br>
    
   
             <?php echo $form->labelEx($model,'EXDO_FECHAVENCIMIENTO'); ?>
			 <?php
             if($model->EXDO_FECHAVENCIMIENTO!='') {
             $model->EXDO_FECHAVENCIMIENTO = $model->EXDO_FECHAVENCIMIENTO;
             }else{
				  $model->EXDO_FECHAVENCIMIENTO ='0000-00-00';
				  }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'EXDO_FECHAVENCIMIENTO',
             'value'=>$model->EXDO_FECHAVENCIMIENTO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$model->EXDO_FECHAVENCIMIENTO,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha Vencimiento',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => 'true',
             'changeYear' => 'true',
             ),
             )); ?>
            <?php echo $form->error($model,'EXDO_FECHAVENCIMIENTO'); ?>

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




