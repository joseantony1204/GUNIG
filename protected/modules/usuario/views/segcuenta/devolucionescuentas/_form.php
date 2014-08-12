<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'devolucionescuentas-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textAreaRow($model,'DECU_MOTIVO',array('class'=>'span4','maxlength'=>200)); ?>

    <?php echo $form->labelEx($model,'TIDO_ID'); ?>
	<?php $data = CHtml::listData(Tiposdocumentos::model()->findAll(),'TIDO_ID','TIDO_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'TIDO_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
    <?php echo $form->error($model,'TIDO_ID'); ?>
    
    
             <?php echo $form->labelEx($model,'DECU_FECHADEVOLUCION'); ?>
			 <?php
             if($model->DECU_FECHADEVOLUCION!='') {
             $model->DECU_FECHADEVOLUCION = $model->DECU_FECHADEVOLUCION;
             }else{
				  $model->DECU_FECHADEVOLUCION =date('Y-m-d');
				  }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'DECU_FECHADEVOLUCION',
             'value'=>$model->DECU_FECHADEVOLUCION,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$model->DECU_FECHADEVOLUCION,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha Devolucion',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => 'true',
             'changeYear' => 'true',
             ),
             )); ?>
            <?php echo $form->error($model,'DECU_FECHADEVOLUCION'); ?>

	<?php echo $form->hiddenField($model,'SECU_ID',array('class'=>'span5')); ?>

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




