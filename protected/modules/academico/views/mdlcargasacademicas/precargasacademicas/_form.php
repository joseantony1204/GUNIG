<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'precargasacademicas-form',
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
		/*$data=$model->getPersonas();   
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
		)); */
		?>
 <?php 
	  echo $form->labelEx($model, 'PENA_ID');
	    
	 $criteria=new CDbCriteria;
     $criteria->select='t.PENA_ID, t.PENA_NOMBRES, t.PENA_APELLIDOS';
	 $criteria->join = 'INNER JOIN TBL_PERSONASNATURALES c ON t.PENA_ID = c.PENA_ID';	
	 $criteria->order = 't.PENA_NOMBRES ASC';
	 $data = CHtml::listData(Personasnaturales::model()->findAll($criteria),'PENA_ID','nombreCompleto');  ?>
       <?php echo $form->dropDownList($model,'PENA_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'PENA_ID');   ?>
       
        <?php 
  /*  $criterio = array('order'=>'PENA_NOMBRES ASC');
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
    )); */?>
   
    <?php 
	   echo $form->labelEx($model, 'TICD_ID');
	   $data = CHtml::listData(Tipocontrataciondocentes::model()->findAll(),'TICD_ID','TICD_NOMBRE') ?>
       <?php echo $form->dropDownList($model,'TICD_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'TICD_ID'); ?>
       
       
       <?php 
	   echo $form->labelEx($model, 'FACU_ID');
	   $data = CHtml::listData(Facultades::model()->findAll(),'FACU_ID','FACU_NOMBRE') ?>
       <?php echo $form->dropDownList($model,'FACU_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'FACU_ID'); ?>
       
         <?php 
   /* $criterio = array('order'=>'FACU_NOMBRE ASC');
    $data=Facultades::model()->findAll($criterio);    
    $list = CHtml::listData($data,'FACU_ID', 'FACU_NOMBRE'); 
    
    echo $form->labelEx($model, 'FACU_ID');
    $this->widget('ext.select2.ESelect2',array(
      'name'=>'FACU_ID',
      'data'=>$list,
      'value'=>$list->FACU_ID,
      'attribute'=>'FACU_ID',
      'options'=>array(
        'placeholder'=>'Buscar registro en la base de datos',
        'allowClear'=>true,
        'width'=>'320px',
      ),
    )); */?>
                  
       <?php 
	    $criterio = array('join'=>'WHERE t.ANAC_ID = YEAR(NOW())'); 
	   echo $form->labelEx($model, 'PEAC_ID');
	   $data = CHtml::listData(Periodosacademicos::model()->findAll($criterio),'PEAC_ID','PEAC_NOMBRE') ?>
       <?php echo $form->dropDownList($model,'PEAC_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
       <?php echo $form->error($model,'PEAC_ID'); ?>

	

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




