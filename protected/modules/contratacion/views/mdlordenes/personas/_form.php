<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'Personas-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
	<table width="100%" border="0">
	  <tr>
	    <td>
    <?php echo $form->labelEx($model,'TIDO_ID'); ?>
    <?php $data = CHtml::listData(TiposDocumento::model()->findAll(),'TIDO_ID','TIDO_NOMBRE') ?>
	<?php echo $form->dropDownList($model,'TIDO_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?>
    <?php echo $form->error($model,'TIDO_ID'); ?>       
        </td>
	    <td>&nbsp;</td>
	    <td><?php echo $form->textFieldRow($model,'PERS_IDENTIFICACION',array('class'=>'span3')); ?></td>
	    </tr>
	  <tr>
	    <td><?php echo $form->textAreaRow($model,'PERS_EXP_DOCUMENTO',array('rows'=>1,'cols'=>50, 'class'=>'span3')); ?></td>
	    <td>&nbsp;</td>
	    <td>
        <?php echo $form->labelEx($model,'PERS_SEXO'); ?>
        <?php echo $form->dropDownList($model,'PERS_SEXO',array('MASCULINO'=>'MASCULINO','FEMENINO'=>'FEMENINO'),
		array('prompt'=>'Elije...','class'=>'span3')); ?>
        <?php echo $form->error($model,'PERS_SEXO'); ?>		
		</td>
	    </tr>
	  <tr>
	    <td><?php echo $form->textFieldRow($model,'PERS_NOMBRES',array('class'=>'span3','maxlength'=>45)); ?></td>
	    <td>&nbsp;</td>
	    <td><?php echo $form->textFieldRow($model,'PERS_APELLIDOS',array('class'=>'span3','maxlength'=>45)); ?></td>
	  </tr>
	  <tr>
	    <td><?php echo $form->textAreaRow($model,'PERS_EMAIL',array('rows'=>1, 'cols'=>50, 'class'=>'span3')); ?></td>
	    <td>&nbsp;</td>
	    <td><?php echo $form->textAreaRow($model,'PERS_DIRECCION',array('rows'=>1, 'cols'=>50, 'class'=>'span3')); ?></td>
	  </tr>
	  <tr>
	    <td><?php echo $form->textAreaRow($model,'PERS_TELEFONO',array('rows'=>1, 'cols'=>50, 'class'=>'span3')); ?></td>
	    <td>&nbsp;</td>
	    <td>
    <?php echo $form->labelEx($model,'PERS_FECHA_NACIMIENTO'); ?>
     <?php
     if ($model->PERS_FECHA_NACIMIENTO!='') {
     $model->PERS_FECHA_NACIMIENTO = date('Y-m-d',strtotime($model->PERS_FECHA_NACIMIENTO));
     }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'PERS_FECHA_NACIMIENTO',
     'value'=>$model->PERS_FECHA_NACIMIENTO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->PERS_FECHA_NACIMIENTO,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Nacimiento',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
    <?php echo $form->error($model,'PERS_FECHA_NACIMIENTO'); ?>        
        </td>
	  </tr>
	  <tr>
	    <td><?php echo $form->textFieldRow($model,'PERS_LUGAR_NACIMIENTO',array('class'=>'span3','maxlength'=>15)); ?></td>
	    <td>&nbsp;</td>
	    <td><?php echo $form->hiddenField($model,'PERS_FECHA_INGRESO',array('value'=>date("Y-m-d"))); ?></td>
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




