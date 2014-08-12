<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'horascatedras-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

  <?php 
	   echo $form->labelEx($model, 'TICD_ID');
	   $data = CHtml::listData(Tipocontrataciondocentes::model()->findAll(),'TICD_ID','TICD_NOMBRE') ?>
       <?php echo $form->dropDownList($model,'TICD_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'TICD_ID'); ?>

	<?php echo $form->textFieldRow($model,'HOCA_SEMANAL',array('class'=>'span5')); ?>
	
	<?php echo $form->textFieldRow($model,'HOCA_ACUERDO',array('class'=>'span5','maxlength'=>45)); ?>
    <?php echo $form->labelEx($model,'HOCA_INICIO'); ?>
     <?php
     if ($model->HOCA_INICIO=='') {
     $model->HOCA_INICIO = date('Y-m-d');
     }else{
		  $model->HOCA_INICIO = date('Y-m-d',strtotime($model->HOCA_INICIO));
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'HOCA_INICIO',
     'value'=>$model->HOCA_INICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->HOCA_INICIO,
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
    <?php echo $form->error($model,'HOCA_INICIO'); ?> 
    

	   <?php echo $form->labelEx($model,'HOCA_FIN'); ?> 
     <?php
     if ($model->HOCA_FIN=='') {
     $model->HOCA_FIN = date('Y-m-d');
     }else{
		  $model->HOCA_FIN = date('Y-m-d',strtotime($model->HOCA_FIN));
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'HOCA_FIN',
     'value'=>$model->HOCA_FIN,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->HOCA_FIN,
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
    <?php echo $form->error($model,'HOCA_FIN'); ?> 

	    <?php echo $form->labelEx($model,'HOCA_ESTADOS'); ?>
    <?php echo $form->dropDownList($model,'HOCA_ESTADOS',array('0'=>'ACTIVO','1'=>'INACTIVO'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'HOCA_ESTADOS'); ?>
    
   
       

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




