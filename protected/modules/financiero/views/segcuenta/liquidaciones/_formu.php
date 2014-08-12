<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'liquidaciones-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>
<span class="note">			
<?php echo $form->errorSummary($Liquidaciones); ?>
<?php echo $form->errorSummary($Liquidacionesdescuentos); ?></span>
	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($Liquidaciones); ?>
	
     <?php echo $form->labelEx($Liquidaciones,'ANAC_ID'); ?>
        <?php echo $form->dropDownList($Liquidaciones,'ANAC_ID', CHtml::listData(Aniosacademicos::model()->findAll(array('order'=>'ANAC_ID DESC')), 'ANAC_ID','ANAC_ID') );?>
        <?php echo $form->error($Liquidaciones,'ANAC_ID'); ?>
    
    <?php echo $form->hiddenField($Liquidaciones,'LIQU_FECHA',array('value'=>date("Y-m-d").' '.date("h:i:s"),));?>
    
    
    <?php echo $form->textFieldRow($Liquidaciones,'LIQU_EJECUTADO',array('class'=>'span3')); ?>
    <?php echo $form->textFieldRow($Liquidaciones,'LIQU_UTILIDAD',array('class'=>'span3')); ?>
    <?php echo $form->textFieldRow($Liquidaciones,'LIQU_AMOTIZACION',array('class'=>'span3')); ?>
    <?php echo $form->textFieldRow($Liquidaciones,'LIQU_IVA',array('class'=>'span3')); ?>
    
    <?php echo $form->textAreaRow($Liquidaciones,'LIQU_CONCEPTO',array('rows'=>4, 'cols'=>40, 'class'=>'span5')); ?>
    

	<?php echo $form->hiddenField($Liquidaciones,'CUEN_ID',array('class'=>'span5','maxlength'=>11)); ?>
   
    
   
    
    
    
    <?php echo $form->errorSummary($Liquidacionesdescuentos); ?>

    <?php echo $form->hiddenField($Liquidacionesdescuentos,'LIDE_TARIFA',array('class'=>'span5')); ?>

	<?php echo $form->hiddenField($Liquidacionesdescuentos,'DESC_ID',array('class'=>'span5')); ?>   
    
    
    <?php 
		$data=$Liquidaciones->descuentoAtributo($Liquidaciones->CUEN_ID);
		$list = CHtml::listData($data,'DEAT_ID', 'DESCRIPCION'); 		
		echo $form->labelEx($Liquidaciones,'DEAT_ID');
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
		<?php echo $form->error($Liquidaciones,'DEAT_ID'); ?>
		
        <?php 
		$criterio = new CDbCriteria;
		$criterio ->select = 'DEAT_ID, DEAT_DESCRIPCION';
		$criterio->order = 'DEAT_DESCRIPCION ASC';    
       ?>


    
    
    <?php 
		$data=$Liquidaciones->descuentoAtributo1($Liquidaciones->CUEN_ID);
		$list = CHtml::listData($data,'DEAT_ID', 'DESCRIPCION'); 		
		echo $form->labelEx($Liquidaciones,'DEAT_IDD');
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
		<?php echo $form->error($Liquidaciones,'DEAT_IDD'); ?>
		
        <?php 
			$criterio = new CDbCriteria;
			$criterio ->select = 'DEAT_ID, DESCRIPCION';
			$criterio->order = 'DESCRIPCION ASC';    
       ?>



    
    
    <?php /*
		$data=$Liquidaciones->descuentoAtributo2($Liquidaciones->CUEN_ID);
		$list = CHtml::listData($data,'DEAT_ID', 'DESCRIPCION'); 		
		echo $form->labelEx($Liquidaciones,'DEAT_IDDD');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'DEAT_IDDD',
		  'data'=>$list,
		  'value'=>$list->DEAT_IDDD,
		  'attribute'=>'DEAT_IDDD',
		  'options'=>array(
		  'placeholder'=>'Buscar registro en la base de datos',
		  'allowClear'=>true,
		  'width'=>'700px',
		  ),
		)); 
		?>	
		<?php echo $form->error($Liquidaciones,'DEAT_IDDD'); ?>		
        <?php 
			$criterio = new CDbCriteria;
			$criterio ->select = 'DEAT_ID, DESCRIPCION';
			$criterio->order = 'DESCRIPCION ASC';  */  
       ?>

       
        
        
        
		<p>&nbsp;</p>
		<?php $data = array('1'=>'Si','2'=>'No')?>
		<?php echo	$form->radioButtonListInlineRow($Liquidaciones, 'LIQU_APLICAIVA', $data);?>


       
    
        
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Liquidaciones->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
</tr>
</table>