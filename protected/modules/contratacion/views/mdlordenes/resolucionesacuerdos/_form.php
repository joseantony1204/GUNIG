

<table border="0" width="100%">
     <tr>
      <td width="90%">         


    <p>
      <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'resolucionesacuerdos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>
    </p>
    <p>    Los campos marcados con <span class="required">*</span> son requeridos.
      
    </p>
    <table width="100%" border="0">
      <tr>
	    <td colspan="5"><h5>INFORMACIÓN DEL ENCARGO</h5></td>
	    </tr>
	  <tr>
	    <td width="27%"> 
       
		<?php 
		$data=$Contratantes->nombrePersonasNaturales();   
		$list = CHtml::listData($data,'PENA_ID', 'NOMBRE');  
		echo $form->labelEx($Contratantes, 'PENA_ID');
		$this->widget('ext.select2.ESelect2',array(
		  'name'=>'PENA_ID',
		  'data'=>$list,
		  'value'=>$list->PENA_ID,
		  'attribute'=>'PENA_ID',
		  'options'=>array(
			'placeholder'=>'Buscar registro en la base de datos',
			'allowClear'=>true,
			'width'=>'300px',
		  ),
		)); 
		?>
	     
          
          </td>
	    <td width="19%">&nbsp;</td>
	    <td colspan="3">
		
		<?php echo $form->labelEx($Contratantes,'PECO_DESCRIPCION');  ?>
		<?php echo $form->dropDownList($Contratantes,'PECO_DESCRIPCION',array('Rector'=>'Rector',
																'Rector(e)'=>'Rector(e)',
																'Rectora'=>'Rectora',
																'Rectora(e)'=>'Rectora(e)'),array('prompt'=>'Seleccionar condición...  ','class'=>'span3')); ?> <?php echo $form->error($Contratantes,'PECO_DESCRIPCION'); ?></td>
	    </tr>
	  <tr>
	    <td><?php echo $form->labelEx($Contratantes,'PECO_FECHAINICIO'); ?>
	      <?php 
     if ($Contratantes->PECO_FECHAINICIO=='') {
     $Contratantes->PECO_FECHAINICIO = date('Y-m-d');
     }else{
		 if ($Contratantes->PECO_FECHAINICIO=='0000-00-00') {
		  $Contratantes->PECO_FECHAINICIO = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Contratantes,
     'attribute'=>'PECO_FECHAINICIO',
     'value'=>$Contratantes->PECO_FECHAINICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Contratantes->PECO_FECHAINICIO,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Inicio',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
	      <?php echo $form->error($Contratantes,'PECO_FECHAINICIO'); ?></td>
	    <td>&nbsp;</td>
	    <td><?php echo $form->labelEx($Contratantes,'PECO_FECHAFINAL'); ?>
	      <?php 
     if ($Contratantes->PECO_FECHAFINAL=='') {
     $Contratantes->PECO_FECHAFINAL = date('Y-m-d');
     }else{
		 if ($Contratantes->PECO_FECHAFINAL=='0000-00-00') {
		  $Contratantes->PECO_FECHAFINAL = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Contratantes,
     'attribute'=>'PECO_FECHAFINAL',
     'value'=>$Contratantes->PECO_FECHAFINAL,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Contratantes->PECO_FECHAFINAL,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Inicio',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
	      <?php echo $form->error($Contratantes,'PECO_FECHAFINAL'); ?></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td width="45%">&nbsp;</td>
	    <td width="1%">&nbsp;</td>
	    <td width="8%">&nbsp;</td>
	    </tr>
	  <tr>
	    <td colspan="5"><h5>INFORMACIÓN DE RESOLUCIÓN</h5></td>
	    </tr>
	  <tr>
	    <td><?php echo $form->textFieldRow($model,'REAC_NUMERO',array('class'=>'span2','maxlength'=>45)); ?></td>
	    <td>&nbsp;</td>
	    <td colspan="3"><?php //echo $form->textFieldRow($model,'REAC_FECHA',array('class'=>'span3')); ?> 
	      
	      <?php echo $form->labelEx($model,'REAC_FECHA'); ?>
	      <?php 
     if ($model->REAC_FECHA=='') {
     $model->REAC_FECHA = date('Y-m-d');
     }else{
		 if ($model->REAC_FECHA=='0000-00-00') {
		  $model->REAC_FECHA = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'REAC_FECHA',
     'value'=>$model->REAC_FECHA,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->REAC_FECHA,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha de la Resolución',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
	      <?php echo $form->error($model,'REAC_FECHA'); ?>
	      </td>
	    </tr>
	  </table>
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




