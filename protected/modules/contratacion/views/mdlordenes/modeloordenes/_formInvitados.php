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

	<?php echo $form->errorSummary($Invitaciones); ?>
    
    <?php echo $form->labelEx($Invitaciones,'CONT_FECHAINVITACION'); ?>
    <?php    
     $Invitaciones->CONT_FECHAINVITACION = date("Y-m-d");	 
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Invitaciones,
     'attribute'=>'CONT_FECHAINVITACION',
     'value'=>$Invitaciones->CONT_FECHAINVITACION,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Invitaciones->CONT_FECHAINVITACION,
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
     
     
    <?php echo $form->error($Invitaciones,'CONT_FECHAINVITACION'); ?>  
   
  
  <?php echo $form->textFieldRow($Invitaciones,'CONT_PRESUPUESTOOFICIAL',array('class'=>'span2')); ?>
  
  

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'success',
			'size'=>'small',
            'label'=>'Descargar Invitacion',
			'icon'=>'download white',
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




