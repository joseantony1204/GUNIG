<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'resolucionesliquidaciones-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>



	<span class="note">
<?php echo $form->errorSummary($Resolucionesliquidaciones); ?>



	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

   
    <table width="200" border="0">
  <tr>
    <td>  
    <?php echo $form->textFieldRow($Resolucionesliquidaciones,'RELI_EJECUTADO',array('class'=>'span3')); ?>
    </td>
  </tr>
   <tr>
    <td>
    <?php echo $form->textFieldRow($Resolucionesliquidaciones,'RELI_UTILIDAD',array('class'=>'span3')); ?>
    </td>
  </tr>
   <tr>
    <td>
    <?php echo $form->textFieldRow($Resolucionesliquidaciones,'RELI_AMOTIZACION',array('class'=>'span3')); ?>
    </td>
  </tr>
    <tr>
    <td>
	<?php echo $form->textFieldRow($Resolucionesliquidaciones,'RELI_IVA',array('class'=>'span3')); ?>
    </td>
  </tr>  
  
    <td> 
    
    <?php 
		$data=$Resolucionesliquidaciones->descuentoAtributo($Resolucionesliquidaciones->RELI_ID);
		$list = CHtml::listData($data,'DEAT_ID', 'DESCRIPCION'); 		
		echo $form->labelEx($Resolucionesliquidaciones,'DEAT_ID');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'DEAT_ID',
		  'data'=>$list,
		  'value'=>$list->DEAT_ID,
		  'attribute'=>'DEAT_ID',
		  'options'=>array(
			'placeholder'=>'Buscar registro en la base de datos',
			'allowClear'=>true,
			'width'=>'700px',
		  ),
		)); 
		?>	
		<?php echo $form->error($Resolucionesliquidaciones,'DEAT_ID'); ?>
		
        <?php 
		$criterio = new CDbCriteria;
		$criterio ->select = 'DEAT_ID, DEAT_DESCRIPCION';
		$criterio->order = 'DEAT_DESCRIPCION ASC';    
       ?>

    </td>
    <td> </td>
  </tr>
  
  <tr>
    <td>
    
    <?php 
		$data=$Resolucionesliquidaciones->descuentoAtributo1($Resolucionesliquidaciones->RELI_ID);
		$list = CHtml::listData($data,'DEAT_ID', 'DESCRIPCION'); 		
		echo $form->labelEx($Resolucionesliquidaciones,'DEAT_IDD');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'DEAT_IDD',
		  'data'=>$list,
		  'value'=>$list->DEAT_IDD,
		  'attribute'=>'DEAT_IDD',
		  'options'=>array(
		  'placeholder'=>'Buscar registro en la base de datos',
		  'allowClear'=>true,
		  'width'=>'700px',
		  ),
		)); 
		?>	
		<?php echo $form->error($Resolucionesliquidaciones,'DEAT_IDD'); ?>
		
        <?php 
			$criterio = new CDbCriteria;
			$criterio ->select = 'DEAT_ID, DESCRIPCION';
			$criterio->order = 'DESCRIPCION ASC';    
       ?>

    </td>
    <td><?php echo $form->hiddenField($Resolucionesliquidaciones,'RELI_ID',array('class'=>'span2')); ?></td>
  </tr>
  
  
</table>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Resolucionesliquidaciones->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




