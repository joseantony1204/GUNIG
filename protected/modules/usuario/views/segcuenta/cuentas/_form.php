<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cuentas-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->labelEx($model,'CUEN_NUMERO'); ?>
    <?php echo $form->dropDownList($model,'CUEN_NUMERO',
    array('1'=>'CUENTA No. 1','2'=>'CUENTA No. 2','3'=>'CUENTA No. 3','4'=>'CUENTA No. 4','5'=>'CUENTA No. 5','6'=>'CUENTA No. 6',
	'7'=>'CUENTA No. 7','8'=>'CUENTA No. 8','9'=>'CUENTA No. 9','10'=>'CUENTA No. 10','11'=>'CUENTA No. 11','12'=>'CUENTA No. 12'),
	array('prompt'=>'Elige...','class'=>'span3')); ?>
    <?php echo $form->error($model,'CUEN_NUMERO'); ?>

	<?php echo $form->textFieldRow($model,'CUEN_VALOR',array('class'=>'span3','maxlength'=>20)); ?>
    
             <?php echo $form->labelEx($model,'CUEN_FECHAINICIO'); ?>
			 <?php
             if($model->CUEN_FECHAINICIO!='') {
             $model->CUEN_FECHAINICIO = date('Y-m-d',strtotime($model->CUEN_FECHAINICIO));
             }else{
				  $model->CUEN_FECHAINICIO = "";
				  }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'CUEN_FECHAINICIO',
             'value'=>$model->CUEN_FECHAINICIO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$model->CUEN_FECHAINICIO,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha Inico',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => 'true',
             'changeYear' => 'true',
             ),
             )); ?>
            <?php echo $form->error($model,'CUEN_FECHAINICIO'); ?>
            
             <?php echo $form->labelEx($model,'CUEN_FECHAFINAL'); ?>
			 <?php
             if($model->CUEN_FECHAFINAL!='') {
             $model->CUEN_FECHAFINAL = date('Y-m-d',strtotime($model->CUEN_FECHAFINAL));
             }else{
				  $model->CUEN_FECHAFINAL = "";
				  }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'CUEN_FECHAFINAL',
             'value'=>$model->CUEN_FECHAFINAL,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$model->CUEN_FECHAFINAL,
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
            <?php echo $form->error($model,'CUEN_FECHAFINAL'); ?>

	<?php echo $form->hiddenField($model,'CUEN_FECHAINGRESO',array('value'=>date("Y-m-d").' '.date("h:i:s"))); ?>

    <?php echo $form->labelEx($model,'TIPA_ID'); ?>
	<?php $data = CHtml::listData(Tipospagos::model()->findAll(),'TIPA_ID','TIPA_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'TIPA_ID',$data, array('class'=>'span3','prompt'=>'elige......')); ?>
    <?php echo $form->error($model,'TIPA_ID'); ?>

	<?php echo $form->hiddenField($model,'CONT_ID',array('class'=>'span3')); ?>

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




