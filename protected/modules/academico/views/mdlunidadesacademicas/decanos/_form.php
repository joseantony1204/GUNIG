<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'decanos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->labelEx($model, 'FACU_ID');
	$criteria=new CDbCriteria;
     $criteria->select='t.FACU_ID, t.FACU_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_FACULTADES c ON t.FACU_ID = c.FACU_ID';	
	 $criteria->order = 't.FACU_NOMBRE ASC';
	 $data = CHtml::listData(Facultades::model()->findAll($criteria),'FACU_ID','FACU_NOMBRE');  ?>
       <?php echo $form->dropDownList($model,'FACU_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'FACU_ID');   ?>

	 <?php 
	  echo $form->labelEx($model, 'PENA_ID');
	    
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 $data = CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto');  ?>
       <?php echo $form->dropDownList($model,'PENA_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'PENA_ID');   ?>

	   <?php echo $form->labelEx($model,'DECA_FECHA_INICIO'); ?>
     <?php
     if ($model->DECA_FECHA_INICIO=='') {
     $model->DECA_FECHA_INICIO = date('Y-m-d');
     }else{
		 if ($model->DECA_FECHA_INICIO=='0000-00-00') {
		  $model->DECA_FECHA_INICIO = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'DECA_FECHA_INICIO',
     'value'=>$model->DECA_FECHA_INICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->DECA_FECHA_INICIO,
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
    <?php echo $form->error($model,'DECA_FECHA_INICIO'); ?>

    <?php echo $form->labelEx($model,'DECA_FECHA_FIN'); ?>
     <?php
     if ($model->DECA_FECHA_FIN=='') {
     $model->DECA_FECHA_FIN = date('Y-m-d');
     }else{
		 if ($model->DECA_FECHA_FIN=='0000-00-00') {
		  $model->DECA_FECHA_FIN = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'DECA_FECHA_FIN',
     'value'=>$model->DECA_FECHA_FIN,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->DECA_FECHA_FIN,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Retiro',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
    <?php echo $form->error($model,'DECA_FECHA_FIN'); ?>
    
    <?php echo $form->labelEx($model,'DECA_ESTADO'); ?>
    <?php echo $form->dropDownList($model,'DECA_ESTADO',array('1'=>'ACTIVO','0'=>'INACTIVO'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'DECA_ESTADO'); ?>	

	
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




