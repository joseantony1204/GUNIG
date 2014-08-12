<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'presupuestos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($Presupuestos); ?>
    <?php echo $form->errorSummary($Ocasionalespresupuestos); ?>

	<?php echo $form->textFieldRow($Presupuestos,'PRES_NUM_CERTIFICADO',array('class'=>'span3','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($Presupuestos,'PRES_DESCRIPCION',array('class'=>'span4','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($Presupuestos,'PRES_SECCION',array('class'=>'span3','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($Presupuestos,'PRES_CODIGO',array('class'=>'span3','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($Presupuestos,'PRES_MONTO',array('class'=>'span3')); ?>

    <?php echo $form->labelEx($Presupuestos,'PRES_FECHA_VIGENCIA'); ?>
     <?php
     if ($Presupuestos->PRES_FECHA_VIGENCIA=='') {
     $Presupuestos->PRES_FECHA_VIGENCIA = date('Y-m-d');
     }else{
		  $Presupuestos->PRES_FECHA_VIGENCIA = date('Y-m-d',strtotime($Presupuestos->PRES_FECHA_VIGENCIA));
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Presupuestos,
     'attribute'=>'PRES_FECHA_VIGENCIA',
     'value'=>$Presupuestos->PRES_FECHA_VIGENCIA,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Presupuestos->PRES_FECHA_VIGENCIA,
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
    <?php echo $form->error($Presupuestos,'PRES_FECHA_VIGENCIA'); ?> 

    <?php $fecha = date("Y-m-d")." ".date("h:i:s  A"); ?>
    <?php echo $form->hiddenField($Presupuestos,'PRES_FECHA_INGRESO',array('value'=>$fecha)); ?>
    
    <?php echo $form->labelEx($Ocasionalespresupuestos,'FACU_ID'); ?>
	<?php $data = CHtml::listData(Facultades::model()->findAll(),'FACU_ID','FACU_NOMBRE') ?>
    <?php echo $form->dropDownList($Ocasionalespresupuestos,'FACU_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
    <?php echo $form->error($Ocasionalespresupuestos,'FACU_ID'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Ocasionalespresupuestos->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>







