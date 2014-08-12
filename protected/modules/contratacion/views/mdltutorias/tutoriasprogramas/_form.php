<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tutoriasprogramas-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'TUPR_NOMBRE',array('class'=>'span5','maxlength'=>200)); ?>
    
    <?php 
    $criterio = array('order'=>'PENA_NOMBRES ASC');
    $data=Personasnaturales::model()->findAll($criterio);    
    $list = CHtml::listData($data,'PENA_ID', 'nombreCompleto'); 
    
    echo $form->labelEx($model, 'PENA_ID');
    $this->widget('ext.select2.ESelect2',array(
      'name'=>'PENA_ID',
      'data'=>$list,
      'value'=>$list->PENA_ID,
      'attribute'=>'PENA_ID',
      'options'=>array(
        'placeholder'=>'Buscar registro en la base de datos',
        'allowClear'=>true,
        'width'=>'470px',
      ),
    )); ?>
    <br /><br />
	<?php echo $form->textFieldRow($model,'TUPR_SUPERVISOR',array('class'=>'span5','maxlength'=>100)); ?>

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




