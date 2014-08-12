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

	<?php echo $form->errorSummary($Evaluaciones); ?>
    
    <?php echo $form->labelEx($Evaluaciones,'CONT_FECHAEVALUACION'); ?>
    <?php    
     $Evaluaciones->CONT_FECHAEVALUACION = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Evaluaciones,
     'attribute'=>'CONT_FECHAEVALUACION',
     'value'=>$Evaluaciones->CONT_FECHAEVALUACION,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Evaluaciones->CONT_FECHAEVALUACION,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha de Invitación',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
     
     
    <?php echo $form->error($Evaluaciones,'CONT_FECHAEVALUACION'); ?>  
   
  

  
  

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'success',
			'size'=>'small',
            'label'=>'Descargar Evaluacion',
			'icon'=>'download white',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




