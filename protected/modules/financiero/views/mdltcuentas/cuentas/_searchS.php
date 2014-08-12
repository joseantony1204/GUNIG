<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cuentas-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>
  
    <?php echo $form->labelEx($Cuentas,'CUEN_FECHAINICIO'); ?>
    <?php    
     $Cuentas->CUEN_FECHAINICIO = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Cuentas,
     'attribute'=>'CUEN_FECHAINICIO',
     'value'=>$Cuentas->CUEN_FECHAINICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Cuentas->CUEN_FECHAINICIO,
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
    <?php echo $form->error($Cuentas,'CUEN_FECHAINICIO'); ?>
    
      
    <?php echo $form->labelEx($Cuentas,'CUEN_FECHAFINAL'); ?>
    <?php    
     $Cuentas->CUEN_FECHAFINAL = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Cuentas,
     'attribute'=>'CUEN_FECHAFINAL',
     'value'=>$Cuentas->CUEN_FECHAFINAL,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Cuentas->CUEN_FECHAFINAL,
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
    <?php echo $form->error($Cuentas,'CUEN_FECHAFINAL'); ?>
       
    <?php echo $form->labelEx($Cuentas,'CUEN_ESTADO'); ?>
    <?php echo $form->dropDownList($Cuentas,'CUEN_ESTADO',
	array('1'=>'TRAMITADAS','0'=>'SIN TRAMITAR'),array('class'=>'span3')); ?>
    <?php echo $form->error($Cuentas,'CUEN_ESTADO'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Descargar Reporte',
			'icon'=>'download white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>