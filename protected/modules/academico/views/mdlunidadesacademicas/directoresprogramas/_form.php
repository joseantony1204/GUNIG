<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'directoresprogramas-form',
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
	  echo $form->labelEx($model, 'SEDE_ID');
	    
	 $criteria=new CDbCriteria;
     $criteria->select='t.SEDE_ID, t.SEDE_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_SEDES c ON t.SEDE_ID = c.SEDE_ID';	
	 $criteria->order = 't.SEDE_NOMBRE ASC';
	 $data = CHtml::listData(Sedes::model()->findAll($criteria),'SEDE_ID','SEDE_NOMBRE');  ?>
       <?php echo $form->dropDownList($model,'SEDE_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'SEDE_ID');   ?>
       
       <?php 
	  echo $form->labelEx($model, 'PROG_ID');
	    
	 $criteria=new CDbCriteria;
     $criteria->select='t.PROG_ID, t.PROG_NOMBRE';
	 $criteria->join = 'INNER JOIN TBL_PROGRAMAS c ON t.PROG_ID = c.PROG_ID';	
	 $criteria->order = 't.PROG_NOMBRE ASC';
	 $data = CHtml::listData(Programas::model()->findAll($criteria),'PROG_ID','PROG_NOMBRE');  ?>
       <?php echo $form->dropDownList($model,'PROG_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'PROG_ID');   ?>
	
    
    
   
	 <?php 
	  echo $form->labelEx($model, 'PENA_ID');
	    
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 $data = CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto');  ?>
       <?php echo $form->dropDownList($model,'PENA_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'PENA_ID');   ?>

	   <?php echo $form->labelEx($model,'DIRP_FECHA_INICIO'); ?>
     <?php
     if ($model->DIRP_FECHA_INICIO=='') {
     $model->DIRP_FECHA_INICIO = date('Y-m-d');
     }else{
		 if ($model->DIRP_FECHA_INICIO=='0000-00-00') {
		  $model->DIRP_FECHA_INICIO = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'DIRP_FECHA_INICIO',
     'value'=>$model->DIRP_FECHA_INICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->DIRP_FECHA_INICIO,
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
    <?php echo $form->error($model,'DIRP_FECHA_INICIO'); ?>

    <?php echo $form->labelEx($model,'DECA_FECHA_FIN'); ?>
     <?php
     if ($model->DIRP_FECHA_FIN=='') {
     $model->DIRP_FECHA_FIN = date('Y-m-d');
     }else{
		 if ($model->DIRP_FECHA_FIN=='0000-00-00') {
		  $model->DIRP_FECHA_FIN = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$model,
     'attribute'=>'DIRP_FECHA_FIN',
     'value'=>$model->DIRP_FECHA_FIN,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$model->DIRP_FECHA_FIN,
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
    <?php echo $form->error($model,'DIRP_FECHA_FIN'); ?>
    
    <?php echo $form->labelEx($model,'DIPR_ESTADO'); ?>
    <?php echo $form->dropDownList($model,'DIPR_ESTADO',array('1'=>'ACTIVO','0'=>'INACTIVO'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'DIPR_ESTADO'); ?>	

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




