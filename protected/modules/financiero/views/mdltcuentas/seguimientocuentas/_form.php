<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'seguimientocuentas-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>
<?php 
   if ($model->DEPENDENCIA==1) {
	  $var1 = '';
	  $var12 = '';
	  $var3 = '';
	  $var5 = '';
	  $var51 = '';
	  $var52 ='';

   }else{
         if($model->DEPENDENCIA==17) {
      $var1 = $form->textFieldRow($model,'SECU_NUMORDENPAGO',array('class'=>'span3',));
	  $var12 = $form->textFieldRow($model,'SECU_VRORDENPAGO',array('class'=>'span3',));
	  $var3 = '';
	  $var5 = '';
	  $var51 = '';
	  $var52 = '';
         }else{
			   if($model->DEPENDENCIA==18) {
			   	  $var1 = '';
				  $var12 = '';
				  $var3 = $form->textFieldRow($model,'SECU_CODIGOCDP',array('class'=>'span3',));
				  $var5 = '';
				  $var51 = '';
				  $var52 = '';
               }else{
				   if($model->DEPENDENCIA==8) {
					 	  $var1 = '';
						  $var12 = '';
						  $var3 = '';
						  $var5 = '';
						  $var51 = '';
						  $var52 = ''; 
					}else{
						  if ($model->DEPENDENCIA==4) {
						   $var1 = '';
						   $var12 = '';
						   $var3 = '';
						   $var5 = $form->textFieldRow($model,'SECU_NUMCHECQUE',array('class'=>'span3',));
						   $var51  = $form->labelEx($model,'SECU_VALORCHEQUE');
                           $var51 .= $form->dropDownList($model,'SECU_VALORCHEQUE',array('CHECHE'=>'CHECHE','TRANSFERENCIA'=>'TRANSFERENCIA',),
						   array('prompt'=>'Elige...','class'=>'span3')); 
                           $var51 .= $form->error($model,'SECU_VALORCHEQUE'); 
					$var52 = $form->textFieldRow($model,'SECU_FECHAPAGO',array('class'=>'span3','value'=>date("Y-m-d").' '.date("h:i:s"),));
						  }else{
							 
							    }
						 }
			 
			        }
			  }
	    }
   
?>

<table border="0" width="100%">
     <tr>
      <td width="90%">         




	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>
	<?php echo $form->errorSummary($model); ?>

        <?php echo $form->labelEx($model,'SECU_ESTADO'); $data = array('0'=>'TRAMITADA','1'=>'DEVUELTA'); ?>        
        <?php echo $form->dropDownList($model,'SECU_ESTADO',$data,array('class'=>'span3')); ?>
        <?php echo $form->error($model,'SECU_ESTADO'); ?> 

         <?php echo $form->labelEx($model,'SECU_FECHAINGRESO'); ?>
		 <?php
         if($model->SECU_FECHAINGRESO!=''){
         $model->SECU_FECHAINGRESO = date('Y-m-d',strtotime($model->SECU_FECHAINGRESO));
         }else{
		     $model->SECU_FECHAINGRESO = date('Y-m-d').' '.date("h:i:s");
			 } 
         $this->widget('zii.widgets.jui.CJuiDatePicker', array(
         'model'=>$model,
         'attribute'=>'SECU_FECHAINGRESO',
         'value'=>$model->SECU_FECHAINGRESO,
         'language' => 'es',
         'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
             
         'options'=>array(
         'autoSize'=>true,
         'defaultDate'=>$model->SECU_FECHAINGRESO,
         'dateFormat'=>'yy-mm-dd',
         'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
         'buttonImageOnly'=>true,
         'buttonText'=>'Fecha Tramite',
         'selectOtherMonths'=>true,
         'showAnim'=>'slide',
         'showButtonPanel'=>true,
         'showOn'=>'button',
         'showOtherMonths'=>true,
         'changeMonth' => 'true',
         'changeYear' => 'true',
         ),
         )); ?>
        <?php echo $form->error($model,'SECU_FECHAINGRESO'); ?>
 
	    <?php echo $var1; ?>
        <?php echo $var12; ?>
		<?php echo $var3; ?>
		<?php echo $var5; ?>
	    <?php echo $var51; ?>
	    <?php echo $var52; ?>

	<?php echo $form->hiddenField($model,'SEUD_ID',array('class'=>'span3')); ?>
    
    <?php echo $form->hiddenField($model,'DEPENDENCIA',array('class'=>'span3')); ?>

	<?php echo $form->hiddenField($Cuentas,'CUEN_ID',array('class'=>'span3')); ?>

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




