<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'opsobjetos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($Objetos); ?>
    <?php echo $form->errorSummary($Opsobjetos); ?>

	<?php echo $form->textAreaRow($Objetos,'OBJE_NOMBRE',array('class'=>'span7','rows'=>2, 'cols'=>80,)); ?>
   
    <?php $fecha = date("Y-m-d").' '.date("h:i:s"); ?>
    
    <?php echo $form->hiddenField($Objetos,'OBJE_FECHA_INGRESO',array('value'=>$fecha)); ?>    
    <?php echo $form->hiddenField($Opsobjetos,'OPOB_FECHA_INGRESO',array('class'=>'span5', 'value'=>$fecha)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Opsobjetos->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




