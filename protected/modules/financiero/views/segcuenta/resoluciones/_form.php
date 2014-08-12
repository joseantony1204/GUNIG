<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'resoluciones-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>



	<span class="note">
<?php echo $form->errorSummary($Resoluciones); ?>
<?php echo $form->errorSummary($Presupuestos); ?>
<?php echo $form->errorSummary($Resolucionesliquidaciones); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	  
    <table width="200" border="0">
  <tr>
    <td><?php echo $form->textFieldRow($Resoluciones,'RESO_NUMERO',array('class'=>'span2')); ?>
        </td>
    <td>
        
</td>
  </tr>
  
  <tr>
    <td><?php echo $form->labelEx($Resolucionesliquidaciones,'CLRE_ID'); ?>
		<?php echo $form->dropDownList($Resolucionesliquidaciones,'CLRE_ID',CHtml::listData(Clasesresoluciones::model()->findAll(array('order'=>'CLRE_NOMBRE ASC')),'CLRE_ID','CLRE_NOMBRE'), array('empty'=>' '));?>
        <?php echo $form->error($Resolucionesliquidaciones,'CLRE_ID'); ?>
        </td>
    <td>
        
        
</td>
  </tr>
  
  
  <tr>
    <td>
    <?php 
		$data=$Resoluciones->Personas();
		$list = CHtml::listData($data,'PERS_ID', 'PERSONA'); 
		
		
		echo $form->labelEx($Resoluciones,'PERS_ID');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'PERS_ID',
		  'data'=>$list,
		  'value'=>$list->PERS_ID,
		  'attribute'=>'PERS_ID',
		  //'model'=>$Resoluciones,
		  'options'=>array(
			'placeholder'=>'Buscar registro en la base de datos',
			'allowClear'=>true,
			'width'=>'480px',
		  ),
		)); 
		?>	
        <?php echo $form->error($Resoluciones,'PERS_ID'); ?>
    
   </td>
    <td></td>
  </tr>
  <tr>
   <td colspan="2"><?php echo $form->textAreaRow($Resoluciones,'RESO_CONCEPTO',array('rows'=>4, 'cols'=>40, 'class'=>'span5')); ?></td>
  </tr>
  <tr>
    <td>
<?php echo $form->labelEx($Resoluciones,'RESO_FECHASUSCRIPCION'); ?>
			 <?php
             if($Resoluciones->RESO_FECHASUSCRIPCION!='') {
             $Resoluciones->RESO_FECHASUSCRIPCION = date('Y-m-d',strtotime($Resoluciones->RESO_FECHASUSCRIPCION));
             }else{
				  $Resoluciones->RESO_FECHASUSCRIPCION = date('Y-m-d');
				  }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$Resoluciones,
             'attribute'=>'RESO_FECHASUSCRIPCION',
             'value'=>$Resoluciones->RESO_FECHASUSCRIPCION,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span4'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$Resoluciones->RESO_FECHASUSCRIPCION,
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
            <?php echo $form->error($Resoluciones,'RESO_FECHASUSCRIPCION'); ?>

</td>
    <td>
   <?php echo $form->labelEx($Resolucionesliquidaciones,'ANAC_ID'); ?>
<?php echo $form->dropDownList($Resolucionesliquidaciones,'ANAC_ID',CHtml::listData(Aniosacademicos::model()->findAll(array('order'=>'ANAC_ID DESC')),'ANAC_ID','ANAC_ID'));?>
<?php echo $form->error($Resolucionesliquidaciones,'ANAC_ID'); ?>
    </td>
  </tr>
  <tr>
    <td>
	<?php echo $form->textFieldRow($Resolucionesliquidaciones,'RELI_VALOR',array('class'=>'span2')); ?>
	
</td>
    <td></td>
  </tr>
  <tr>
    <td><?php echo $form->hiddenField($Resoluciones,'RESO_FECHAPROCESO',array('value'=>date("Y-m-d").' '.date("h:i:s"),));?></td>
    <td><?php echo $form->hiddenField($Resolucionesliquidaciones,'RESO_ID',array('class'=>'span2')); ?></td>
  </tr>
</table>
    
  
  
<h5>DISPONIBILIDAD PRESUPUESTAL</h5>
<table width="300" border="0">
  <tr>
    <td  width="50"><?php echo $form->textFieldRow($Presupuestos,'PRES_NUM_CERTIFICADO',array('class'=>'span2')); ?></td>
    <td  colspan="2"><?php echo $form->textFieldRow($Presupuestos,'PRES_SECCION',array('class'=>'span2')); ?></td>
    <td  colspan="5"><?php echo $form->textFieldRow($Presupuestos,'PRES_CODIGO',array('class'=>'span2')); ?></td>
  </tr>
  <tr>
    <td  width="50"><?php echo $form->textFieldRow($Presupuestos,'PRES_MONTO',array('class'=>'span2')); ?></td>
    <td  colspan="2"><?php echo $form->textFieldRow($Presupuestos,'PRES_DESCRIPCION',array('class'=>'span2')); ?></td>
    <td colspan="3"></td>
  </tr>
</table>
	
    <?php echo $form->labelEx($Presupuestos,'PRES_FECHA_VIGENCIA'); ?>
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
	      <?php echo $form->error($Presupuestos,'PRES_FECHA_VIGENCIA'); ?>

    

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Resoluciones->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
</tr>
</table>