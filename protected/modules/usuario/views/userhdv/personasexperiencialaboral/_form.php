<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'personasexperiencialaboral-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'PEEL_EMPRESA',array('class'=>'span4','maxlength'=>200)); ?>

	<?php echo $form->textAreaRow($model,'PEEL_TELEFONOEMPRESA',array('rows'=>1, 'class'=>'span4')); ?>

	<?php echo $form->textFieldRow($model,'PEEL_CARGO',array('class'=>'span4','maxlength'=>200)); ?>

    <?php echo $form->labelEx($model,'PEEL_FECHAINICIO'); ?>
			 <?php
             if ($model->PEEL_FECHAINICIO!='') {
             $model->PEEL_FECHAINICIO = date('Y-m-d',strtotime($model->PEEL_FECHAINICIO));
             }
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'PEEL_FECHAINICIO',
             'value'=>$model->PEEL_FECHAINICIO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
			 'showOn' => 'both',
			 'yearRange'=>'1900:2050',
			 'altFormat'=>'dd-mm-yy',
             'defaultDate'=>$model->PEEL_FECHAINICIO,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha inicio',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => 'true',
             'changeYear' => 'true',
             ),
             )); ?>
            <?php echo $form->error($model,'PEEL_FECHAINICIO'); ?>
            
            <?php echo $form->labelEx($model,'PEEL_FECHAFINAL'); ?>
			 <?php
             if ($model->PEEL_FECHAFINAL!='') {
             $model->PEEL_FECHAFINAL = date('Y-m-d',strtotime($model->PEEL_FECHAFINAL));
             }
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'PEEL_FECHAFINAL',
             'value'=>$model->PEEL_FECHAFINAL,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
			 'showOn' => 'both',
			 'yearRange'=>'1900:2050',
			 'altFormat'=>'dd-mm-yy',
             'defaultDate'=>$model->PEEL_FECHAFINAL,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha final',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => 'true',
             'changeYear' => 'true',
             ),
             )); ?>
            <?php echo $form->error($model,'PEEL_FECHAFINAL'); ?>
           
    
    <?php echo $form->labelEx($model,'PEEL_ACTUALMENTE'); ?>
    <?php echo $form->dropDownList($model,'PEEL_ACTUALMENTE',array('NO'=>'NO','SI'=>'SI'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'PEEL_ACTUALMENTE'); ?>

	<?php echo $form->hiddenField($model,'PERS_ID',array('class'=>'span5')); ?>

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




