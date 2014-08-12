<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'titulos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->textAreaRow($model,'TITU_NOMBRE',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
    
    <?php echo $form->labelEx($model,'PROG_ID'); ?><?php $data=Programas::model()->getListadoProgramas();?>
  <?php echo $form->dropDownList($model,'PROG_ID',$data, array('class'=>'span2','prompt'=>'Selecciona...')); ?>
    <?php echo $form->error($model,'PROG_ID'); ?>

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




