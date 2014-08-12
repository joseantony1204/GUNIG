<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'hdveducacioncontinua-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well','enctype' =>'multipart/form-data'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textAreaRow($model,'HECO_NOMBRE',array('rows'=>2, 'cols'=>50, 'class'=>'span4')); ?>
    
	<?php echo $form->textFieldRow($model,'HECO_LUGAR',array('class'=>'span4')); ?>

	<?php echo $form->hiddenField($model,'HECO_RUTA',array('class'=>'span4')); ?>

	<?php echo $form->labelEx($model,'HECO_FECHATERMINACION'); ?>
    <?php
     if ($model->HECO_FECHATERMINACION!='') {
     $model->HECO_FECHATERMINACION = date('Y-m-d',strtotime($model->HECO_FECHATERMINACION));
     }else{
		  $model->HECO_FECHATERMINACION = '0000-00-00';
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'HECO_FECHATERMINACION',
     'value'=>$model->HECO_FECHATERMINACION,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->HECO_FECHATERMINACION,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Culminación',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
    <?php echo $form->error($model,'HECO_FECHATERMINACION'); ?> 
    
    <?php
    echo $form->labelEx($model, 'ARCHIVO');
    echo $form->fileField($model, 'ARCHIVO',array('class'=>'span5','maxlength'=>45,'size' =>57));
    echo $form->error($model, 'ARCHIVO');
    ?>

	<?php echo $form->hiddenField($model,'PERS_ID',array('class'=>'span5')); ?>

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




