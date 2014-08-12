<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'presupuestosordenes-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.	</p>
	<table width="100%" border="0">
	  <tr>
	    <td colspan="5"><h5>DISPONIBILIDAD PRESUPUESTAL</h5></td>
	    </tr>
        
	  <tr>
	    <td width="30%">

		<?php echo $form->textFieldRow($Presupuestos,'PRES_NUM_CERTIFICADO',array('class'=>'span2')); ?> </td>
	    <td width="5%">&nbsp;</td>
	    <td width="30%"><?php echo $form->textFieldRow($Presupuestos,'PRES_SECCION',array('class'=>'span2')); ?></td>
	    <td width="5%">&nbsp;</td>
	    <td width="30%"><?php echo $form->textFieldRow($Presupuestos,'PRES_CODIGO',array('class'=>'span2')); ?></td>
	   
        </tr>
      <tr>
	    <td><?php echo $form->textFieldRow($Presupuestos,'PRES_MONTO',array('class'=>'span2')); ?></td>
	    <td>&nbsp;</td>
	    <td><?php echo $form->textFieldRow($Presupuestos,'PRES_DESCRIPCION',array('class'=>'span2')); ?></td>
	    <td>&nbsp;</td>
	    <td><?php echo $form->labelEx($Presupuestos,'PRES_FECHA_VIGENCIA'); ?>
          <?php 
     if ($Presupuestos->PRES_FECHA_VIGENCIA=='') {
     $Presupuestos->PRES_FECHA_VIGENCIA = date('Y-m-d');
     }else{
		 if ($Presupuestos->PRES_FECHA_VIGENCIA=='0000-00-00') {
		  $Presupuestos->PRES_FECHA_VIGENCIA = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Presupuestos,
     'attribute'=>'PRES_FECHA_VIGENCIA',
     'value'=>$Presupuestos->PRES_FECHA_VIGENCIA,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Presupuestos->PRES_FECHA_VIGENCIA,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha de Vigencia del CDP',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
          <?php echo $form->error($Presupuestos,'PRES_FECHA_VIGENCIA');  ?>
     
          </td>
	    </tr>
	  </table>
	<p>&nbsp;</p>
	<p>
	
    <?php echo $form->hiddenField($Presupuestos,'PRES_FECHA_INGRESO',array('value'=>date("Y-m-d").' '.date("h:i:s"),));?>
    
	<?php echo $form->hiddenField($Presupuestosordenes,'MOOR_ID',array('class'=>'span5')); ?>
	<?php echo $form->hiddenField($Presupuestosordenes,'PRES_ID',array('class'=>'span5')); ?>
	
	<?php  echo $form->errorSummary($Presupuestosordenes); ?>
    <?php  echo $form->error($Presupuestosordenes,'MOOR_ID'); ?> 
     <?php echo $form->errorSummary($Presupuestos); ?>
     <?php echo $form->errorSummary($Presupuestosordenes); ?>
     
  	    </p>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Presupuestosordenes->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




