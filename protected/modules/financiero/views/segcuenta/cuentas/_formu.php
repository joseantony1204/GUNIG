<table border="0" width="100%"> 
     <tr> 
      <td width="90%">          


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'id'=>'cuentas-form', 
    'enableAjaxValidation'=>false, 
    'type'=>'vertical', 
    'htmlOptions'=>array('class'=>'well'), 
    'enableClientValidation'=>true, 
    'clientOptions'=>array( 
        'validateOnSubmit'=>true,), 
)); ?>

    		
    <?php echo $form->labelEx($model,'CUEN_FECHAINICIO'); ?>
			 <?php
             if($model->CUEN_FECHAINICIO!='') {
             $model->CUEN_FECHAINICIO = date('Y-m-d',strtotime($model->CUEN_FECHAINICIO));
             }else{
				  $model->CUEN_FECHAINICIO = date('Y-m-d');
				  }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'CUEN_FECHAINICIO',
             'value'=>$model->CUEN_FECHAINICIO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$model->CUEN_FECHAINICIO,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha Inico',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => 'true',
             'changeYear' => 'true',
             ),
             )); ?>
            <?php echo $form->error($model,'CUEN_FECHAINICIO'); ?>
            
             <?php echo $form->labelEx($model,'CUEN_FECHAFINAL'); ?>
			 <?php
             if($model->CUEN_FECHAFINAL!='') {
             	$model->CUEN_FECHAFINAL = date('Y-m-d',strtotime($model->CUEN_FECHAFINAL));
             }else{
				  $model->CUEN_FECHAFINAL = date('Y-m-d');
				  }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'CUEN_FECHAFINAL',
             'value'=>$model->CUEN_FECHAFINAL,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$model->CUEN_FECHAFINAL,
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
            <?php echo $form->error($model,'CUEN_FECHAFINAL'); ?>
            
               <?php echo $form->labelEx($model,'CUEN_ESTADO'); ?>
            <?php echo $form->dropDownList($model, 'CUEN_ESTADO', array('Estado de cuentas'=>array(
				'1'=>'Cuentas pendientes',
				'3'=>'Cuentas tramitadas',
				'2'=>'Cuentas devueltas',),	));
			?>
            <?php echo $form->error($model,'CUEN_ESTADO'); ?>
						
   
    <div class="form-actions"> 
        <?php $this->widget('bootstrap.widgets.TbButton', array( 
            'buttonType'=>'submit', 
            'icon'=>'ok white', 
            'type'=>'success', 
            'size'=>'small', 
            'label'=>$model->isNewRecord ? 'Descargar' : 'Actualizar', 
        )); ?>
    </div> 

<?php $this->endWidget(); ?>

</td> 
       
     </tr> 
    </table>  