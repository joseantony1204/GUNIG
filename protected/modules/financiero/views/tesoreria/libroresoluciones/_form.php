<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'libroresoluciones-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,),
)); ?>
	
	<?php echo $form->errorSummary($model); ?>

<p>&nbsp;</p>

	<p class="note">Los campos marcados con <span class="required" >*</span> son requeridos.</p>

	<?php echo $form->textFieldRow($model,'LIRE_NUMERO',array('class'=>'span3')); ?>

	<?php  echo $form->labelEx($model, 'PERS_ID');
		$data=Libroresoluciones::Personas();
		$list=CHtml::listData($data,'PERS_ID', 'NOMBRE'); 
		
		$this->widget('ext.select2.ESelect2',array(
      		'name'=>'PERS_ID',
      		'data'=>$list,
      		'value'=>$list->PERS_ID,
      		'attribute'=>'PERS_ID',
      		'options'=>array(
        				'placeholder'=>'Buscar registro en la base de datos',
       					'allowClear'=>true,
        				'width'=>'400px',
      				),
    		));
	
	echo $form->error($model,'PERS_ID'); ?>
	<p></p>
	<?php echo $form->textFieldRow($model,'LIRE_CONCEPTO',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'LIRE_VALOR',array('class'=>'span3')); ?>

	<?php echo $form->labelEx($model,'LIRE_FECHA'); ?>
						
						<?php	if ($model->LIRE_FECHA!='') {
									$model->LIRE_FECHA=date('d-m-Y',strtotime($model->LIRE_FECHA));
								}
								$this->widget('zii.widgets.jui.CJuiDatePicker', array(
								'model'=>$model,
								'attribute'=>'LIRE_FECHA',
								'value'=>$model->LIRE_FECHA,
								'language' => 'es',
								'htmlOptions' => array('readonly'=>"readonly"),
								'options'=>array(
								'autoSize'=>true,
								'defaultDate'=>$model->LIRE_FECHA,
								'dateFormat'=>'yy-mm-dd',
								'buttonImage'=>Yii::app()->baseUrl.'/images/financiero/tesoreria/date.png',
								'buttonImageOnly'=>true,
								'buttonText'=>'FECHA',
								'selectOtherMonths'=>true,
								'showAnim'=>'slide',
								'showButtonPanel'=>true,
								'showOn'=>'button',
								'showOtherMonths'=>true,
								'changeMonth' => 'true',
								'changeYear' => 'true',
								//'minDate'=>'+20Y', //fecha minima
								'maxDate'=> "date('Y-m-d')", //fecha maxima
								),
								)); 
							?>
							
						<?php echo $form->error($model,'LIRE_FECHA'); ?>
								
				
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




