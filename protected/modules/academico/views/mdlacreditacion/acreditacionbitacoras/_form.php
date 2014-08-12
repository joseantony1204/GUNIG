<script>
	function cargar_numero(target_id){		
	    var id = document.getElementById(target_id).options[document.getElementById(target_id).selectedIndex].value;
		$.getJSON('<?php echo Yii::app()->controller->createUrl('mdlacreditacion/acreditacionbitacoras/cargar_numero'); ?>?id='+id,
					function(data){
						$('#acreditacionbitacoras_ACBI_NUMERO').val(data.num);
					}
				);
	}
</script>

<table border="0" width="100%">
     <tr>
      <td width="90%">         
		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
            'id'=>'acreditacionbitacoras-form',
            'enableAjaxValidation'=>false,
            'type'=>'vertical',
            'htmlOptions'=>array('class'=>'well'),
            'enableClientValidation'=>true,
            'clientOptions'=>array(
                'validateOnSubmit'=>true,),
        )); ?>
            <table width="100%"  cellpadding="30">
                 <tr>
                  <td valign="top">  

					<?php echo $form->errorSummary($model); 
					 		 if($model->ACPR_ID == ""){
								  ?>
                                      <p class="note">Seleccione la ubicacion de la Bitacora.</p>                   
                                 <?php  					 
									$data=acreditacionprogramas::model()->findAll();					    					
									$list = CHtml::listData($data,'ACPR_ID', 'ACPR_NOMBRE','ACPR_ID');
									echo $form->labelEx($model, 'ACPR_ID');
									echo $form->dropDownList($model, 'ACPR_ID', $list,
												array( 	'prompt' => 'Seleccione un Programa...',
														'class'=>'span4',
														'onchange'=>'cargar_numero(this.id)',										
													)
											   );
									 }else{									 
									 ?><strong>PROGRAMA SELECCIONADO: </strong><p>&nbsp;</p>
									<h3><?php echo $model->REL_PROG_BITA->ACPR_NOMBRE; } ?></h3>                                      
                  </td>
                  <td>
                            <p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>
                           
                    <?php echo $form->textFieldRow($model,'ACBI_NUMERO',array('class'=>'span2','readonly'=>"readonly",
							)); ?>
                
                    <?php //echo $form->textFieldRow($model,'ACBI_FECHA',array('class'=>'span5'));                     
						echo $form->labelEx($model, 'ACBI_FECHA');								
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
							'model'=>$model,
							'attribute'=>'ACBI_FECHA',
							'value'=>$model->ACBI_FECHA,
							'language' => 'es',
							'htmlOptions' => array('readonly'=>"readonly"),
							'options'=>array(
							'autoSize'=>true,
							'defaultDate'=>$model->ACBI_FECHA,
							'dateFormat'=>'yy-mm-dd',
							'buttonImage'=>Yii::app()->baseUrl.'/images/academico/acreditacion/date.png',
							'buttonImageOnly'=>true,
							'buttonText'=>'ACBI_FECHA',
							'selectOtherMonths'=>true,
							'showAnim'=>'slide',
							'showButtonPanel'=>true,
							'showOn'=>'button',
							'showOtherMonths'=>true,
							'changeMonth' => 'true',
							'changeYear' => 'true',
							//'minDate'=>'date("Y-m-d")', //fecha minima
							//'maxDate'=> "+20Y", //fecha maxima
							),
							)); 
						?>
					<?php echo $form->error($model,'ACBI_FECHA'); ?>

                
                    <?php //echo $form->textFieldRow($model,'ACPR_ID',array('class'=>'span5')); ?>
                </td>
		</tr>
</table>

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

