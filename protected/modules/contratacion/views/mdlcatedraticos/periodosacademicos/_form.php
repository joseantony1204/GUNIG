<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'semestralesp-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'PEAC_NOMBRE',array('class'=>'span3','maxlength'=>50)); ?>

    <?php echo $form->labelEx($model,'PEAC_FECHA_INICIO'); ?>
     <?php
     if ($model->PEAC_FECHA_INICIO=='') {
     $model->PEAC_FECHA_INICIO = date('Y-m-d');
     }else{
		  $model->PEAC_FECHA_INICIO = date('Y-m-d',strtotime($model->PEAC_FECHA_INICIO));
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'PEAC_FECHA_INICIO',
     'value'=>$model->PEAC_FECHA_INICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->PEAC_FECHA_INICIO,
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
    <?php echo $form->error($model,'PEAC_FECHA_INICIO'); ?> 
    
    <?php echo $form->labelEx($model,'PEAC_FECHA_FINAL'); ?>
     <?php
     if ($model->PEAC_FECHA_FINAL=='') {
     $model->PEAC_FECHA_FINAL = date('Y-m-d');
     }else{
		  $model->PEAC_FECHA_FINAL = date('Y-m-d',strtotime($model->PEAC_FECHA_FINAL));
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'PEAC_FECHA_FINAL',
     'value'=>$model->PEAC_FECHA_FINAL,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->PEAC_FECHA_FINAL,
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
    <?php echo $form->error($model,'PEAC_FECHA_FINAL'); ?> 

    <?php echo $form->labelEx($model,'PEAC_ESTADO'); ?>
    <?php echo $form->dropDownList($model,'PEAC_ESTADO',array('0'=>'ACTIVO','1'=>'INACTIVO'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'PEAC_ESTADO'); ?>	

    <?php echo $form->labelEx($model,'ANAC_ID'); ?>
    <?php $data = CHtml::listData(Aniosacademicos::model()->findAll(),'ANAC_ID','ANAC_NOMBRE') ?>
	<?php echo $form->dropDownList($model,'ANAC_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?>
    <?php echo $form->error($model,'ANAC_ID'); ?>

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




