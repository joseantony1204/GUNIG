<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contratantes-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
    
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
        'width'=>'320px',
      ),
    )); ?>
     <br /><br />
	<?php echo $form->textFieldRow($model,'PECO_DESCRIPCION',array('class'=>'span3','maxlength'=>100)); ?>

    <?php echo $form->labelEx($model,'PECO_FECHAINICIO'); ?>
     <?php
     if ($model->PECO_FECHAINICIO=='') {
     $model->PECO_FECHAINICIO = date('Y-m-d');
     }else{
		 if ($model->PECO_FECHAINICIO=='0000-00-00') {
		  $model->PECO_FECHAINICIO = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'PECO_FECHAINICIO',
     'value'=>$model->PECO_FECHAINICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->PECO_FECHAINICIO,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Ingreso',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
    <?php echo $form->error($model,'PECO_FECHAINICIO'); ?>

    <?php echo $form->labelEx($model,'PECO_FECHAFINAL'); ?>
     <?php
     if ($model->PECO_FECHAFINAL=='') {
     $model->PECO_FECHAFINAL = '0000-00-00';
     }else{
		 if ($model->PECO_FECHAFINAL=='0000-00-00') {
		  $model->PECO_FECHAFINAL = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'PECO_FECHAFINAL',
     'value'=>$model->PECO_FECHAFINAL,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->PECO_FECHAFINAL,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Final',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
    <?php echo $form->error($model,'PECO_FECHAFINAL'); ?>
    
	<?php echo $form->labelEx($model,'REAC_ID'); ?>
	<?php $data = CHtml::listData(Resolucionesacuerdos::model()->findAll(),'REAC_ID','REAC_DESCRIPCION') ?>
    <?php echo $form->dropDownList($model,'REAC_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?>
    <?php echo $form->error($model,'REAC_ID'); ?>

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




