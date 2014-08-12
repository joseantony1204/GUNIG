<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'invitados-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<p><?php echo $form->errorSummary($model); ?></p>
	<table width="100%" border="0">
	  <tr>
	    <td><?php echo $form->textAreaRow($model,'INVI_NOMBRE',array('class'=>'span4','maxlength'=>200)); ?></td>
	    <td> <?php echo $form->textFieldRow($model,'INVI_DIRECCION',array('class'=>'span4','maxlength'=>100)); ?></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>  <?php echo $form->textFieldRow($model,'INVI_LUGAR',array('class'=>'span4','maxlength'=>100)); ?></td>
	    <td>  <?php echo $form->textFieldRow($model,'INVI_TELEFONO',array('class'=>'span4')); ?></td>
	    </tr>
	  </table>
	<p>&nbsp;</p>
	<p>
	  
</p>
	<p>
	  
	  <?php echo $form->hiddenField($model,'INV_DESCRIPCION',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
	  
	  <?php echo $form->hiddenField($model,'MOOR_ID',array('class'=>'span5')); ?>
	  
	  </p>
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




