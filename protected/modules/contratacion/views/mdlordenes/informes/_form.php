<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'objetos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($Informes); ?>
    
    <?php echo $form->labelEx($Informes,'CONT_FECHAINICIO'); ?>
    <?php    
     $Informes->CONT_FECHAINICIO = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Informes,
     'attribute'=>'CONT_FECHAINICIO',
     'value'=>$Informes->CONT_FECHAINICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Informes->CONT_FECHAINICIO,
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
     
     
    <?php echo $form->error($Informes,'CONT_FECHAFINAL'); ?>  
    <?php echo $form->labelEx($Informes,'CONT_FECHAFINAL'); ?>
    <?php    
     $Informes->CONT_FECHAFINAL = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Informes,
     'attribute'=>'CONT_FECHAFINAL',
     'value'=>$Informes->CONT_FECHAFINAL,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Informes->CONT_FECHAFINAL,
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
    <?php echo $form->error($Informes,'CONT_FECHAFINAL'); ?>   
    
    <?php //echo $form->textFieldRow($Informes,'CONT_NUMORDEN',array('class'=>'span2')); ?>
   
   <?php  //no es php/<p class="note"> Para este campo puede utilizar los compraradores < > ó =. Ej: >=100.</p> ?> 

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'success',
			'size'=>'small',
            'label'=>'Descargar Reporte',
			'icon'=>'download white',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




