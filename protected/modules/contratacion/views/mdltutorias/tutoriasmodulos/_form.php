<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tutoriasmodulos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'TUTO_ID',array('class'=>'span5')); ?>

    <?php 
	$criterio = array('select'=>'t.TUMO_ID, t.TUMO_NOMBRE',
	                  'join'=>' WHERE  t.TUMO_ID NOT IN (SELECT TUMO_ID FROM TBL_TUTORIASMODULOSXTUTORIAS tm WHERE tm.TUTO_ID = '.$model->TUTO_ID.') ',
					  'order'=>'TUMO_NOMBRE ASC');
	$data=Modulos::model()->findAll($criterio);    
	$list = CHtml::listData($data,'TUMO_ID', 'TUMO_NOMBRE'); 
	
	echo $form->labelEx($model, 'TUMO_ID');
	$this->widget('ext.select2.ESelect2',array(
	  'name'=>'TUMO_ID',
	  'data'=>$list,
	  'value'=>$list->TUMO_ID,
	  'attribute'=>'TUMO_ID',
	  'options'=>array(
		'placeholder'=>'Buscar de modulo en la base de datos',
		'allowClear'=>true,
		'width'=>'480px',
	  ),
	)); 
	?>
  <p><p/>
	<?php echo $form->textFieldRow($model,'TUMT_GRUPO',array('class'=>'span4','maxlength'=>45)); ?>

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




