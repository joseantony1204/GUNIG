<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'cargarasignaturasdocente-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php // echo $form->textFieldRow($model,'PRCA_ID',array('class'=>'span5')); ?>
    
    <?php  
	/*  echo $form->labelEx($model, 'PRCA_ID');
	 $connection = Yii::app()->db;
	 $string='SELECT t.PRCA_ID, CONCAT(pern.PENA_NOMBRES," ",pern.PENA_APELLIDOS) AS NOMBRE_DOCENTE
FROM TBL_PRECARGASACADEMICAS t INNER JOIN TBL_PERSONASNATURALES pern ON pern.PENA_ID=t.PENA_ID';
$data = $connection->createCommand($string)->queryRow(); ?>
       <?php echo $form->dropDownList($model,'PRCA_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'PRCA_ID');  */?>
    
    
     <?php 
	 $connection = Yii::app()->db;
	 $string='SELECT t.PRCA_ID, CONCAT(pern.PENA_NOMBRES," ",pern.PENA_APELLIDOS) AS NOMBRE_DOCENTE
FROM TBL_PRECARGASACADEMICAS t INNER JOIN TBL_PERSONASNATURALES pern ON pern.PENA_ID=t.PENA_ID';
$data = $connection->createCommand($string)->queryAll();
 $list = CHtml::listData($data,'PRCA_ID', 'NOMBRE_DOCENTE'); 
    
    echo $form->labelEx($model, 'NOMBRE DOCENTE');
    $this->widget('ext.select2.ESelect2',array(
      'name'=>'PRCA_ID',
      'data'=>$list,
      'value'=>$list->PRCA_ID,
      'attribute'=>'PRCA_ID',
      'options'=>array(
        'placeholder'=>'Buscar registro en la base de datos',
        'allowClear'=>true,
        'width'=>'320px',
      ),
    )); ?>

	<?php //echo $form->textFieldRow($model,'ASIG_ID',array('class'=>'span5')); ?>
    
      
     <?php 
	 
    $data=Asignaturas::model()->getAsignaturas();  
    $list = CHtml::listData($data,'ASIG_ID', 'CODINOMBRE'); 
    
    echo $form->labelEx($model, 'ASIG_ID');
    $this->widget('ext.select2.ESelect2',array(
      'name'=>'ASIG_ID',
      'data'=>$list,
      'value'=>$list->ASIG_ID,
      'attribute'=>'ASIG_ID',
      'options'=>array(
        'placeholder'=>'Buscar registro en la base de datos',
        'allowClear'=>true,
        'width'=>'320px',
      ),
    )); ?>
	<?php echo $form->textFieldRow($model,'CAAD_NUMUMERO_GRUPOS',array('class'=>'span5')); ?>

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




