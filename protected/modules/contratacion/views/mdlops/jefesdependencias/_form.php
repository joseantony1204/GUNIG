<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'jefesdependencias-form',
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
        'width'=>'370px',
      ),
    )); ?>
     <br /><br />

    <?php echo $form->labelEx($model,'DEPE_ID'); $criteria  = array('order'=>'DEPE_NOMBRE ASC'); ?>
	<?php $data = CHtml::listData(Dependencias::model()->findAll($criteria),'DEPE_ID','DEPE_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'DEPE_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
    <?php echo $form->error($model,'DEPE_ID'); ?>

	<?php echo $form->textFieldRow($model,'JEDE_DESCRIPCION',array('class'=>'span4','maxlength'=>100, 'value'=>'el/la director(a) de :')); ?>

    <?php echo $form->labelEx($model,'JEDE_FECHAINICIO'); ?>
     <?php
     if ($model->JEDE_FECHAINICIO=='') {
     $model->JEDE_FECHAINICIO = date('Y-m-d');
     }else{
		 if ($model->JEDE_FECHAINICIO=='0000-00-00') {
		  $model->JEDE_FECHAINICIO = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'JEDE_FECHAINICIO',
     'value'=>$model->JEDE_FECHAINICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->JEDE_FECHAINICIO,
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
    <?php echo $form->error($model,'JEDE_FECHAINICIO'); ?>

    <?php echo $form->labelEx($model,'JEDE_FECHAFINAL'); ?>
     <?php
     if ($model->JEDE_FECHAFINAL=='') {
     $model->JEDE_FECHAFINAL = date('Y-m-d');
     }else{
		 if ($model->JEDE_FECHAFINAL=='0000-00-00') {
		  $model->JEDE_FECHAFINAL = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'JEDE_FECHAFINAL',
     'value'=>$model->JEDE_FECHAFINAL,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->JEDE_FECHAFINAL,
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
    <?php echo $form->error($model,'JEDE_FECHAFINAL'); ?>

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




