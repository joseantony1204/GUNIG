<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'garantias-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<table width="100%" border="0">
	  <tr>
	    <td width="47%"><?php echo $form->textFieldRow($model,'GARA_NOMBRE',array('class'=>'span3','maxlength'=>100)); ?></td>
	    <td width="5%">&nbsp;</td>
	    <td width="10%"><?php echo $form->textFieldRow($model,'GARA_ANIO',array('class'=>'span1','maxlength'=>1)); ?></td>
	    <td width="8%">&nbsp;</td>
	    <td width="12%"><?php echo $form->textFieldRow($model,'GARA_MES',array('class'=>'span1','maxlength'=>2)); ?></td>
	    <td width="3%">&nbsp;</td>
	    <td width="15%"><?php echo $form->textFieldRow($model,'GARA_PORCENTAJE',array('class'=>'span1','maxlength'=>3)); ?></td>
	    </tr>
	  </table>
	<p>
	  
	  
	  
	  <?php /*echo $form->textAreaRow($model,'GARA_DESCRIPCION',array('rows'=>6, 'cols'=>50, 'class'=>'span8'));*/ ?>
	  
	  <?php echo $form->hiddenField($model,'MOOR_ID',array('class'=>'span5')); ?>	  </p>
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




