<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'acreditacionsoportes-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>


	<?php echo $form->errorSummary($model); ?>
     <table cellpadding="10">
        <tr>
            <td>
            
             <?PHP
             if($model->ACIN_ID == ""){
								  ?>
                                      <p class="note">Seleccione la ubicacion de la Indicador.</p>                   
                                    <table id="tbl_select" cellpadding="10">
                        <tr>
                            <td> <?php   $data=acreditacionprogramas::model()->findAll();					    					
                                $list = CHtml::listData($data,'ACPR_ID', 'ACPR_NOMBRE','ACPR_ID');
                               echo $form->labelEx($model_acredi, 'ACPR_ID');
                            echo $form->dropDownList($model_acredi, 'ACPR_ID', $list,
                                        array(
                                         'onchange'=>'scriptselected(this.id)',//'onclick'=>'scriptclick(id)',											
                                         'ajax'=>array(
                                                    'type'=>'POST',
                                                    'url'=>CController::createUrl('mdlacreditacion/acreditaciones/cargar_bitacoras'),
                                                    'update'=>'#'.CHtml::activeId($model_acredi,'ACBI_ID'),
                                                    //'update'=>'#prueba"',
                                                    //'success'=>'function() {   alert("Hemos ….");  }'
                                                    ),
                                        'prompt' => 'Seleccione un Programa...',
                                        'class'=>'span4',
                                        //'id'=>'sel_programa',
                                            )
                                       );                                 ?> </td>
                        </tr><tr>
                            <td><?php echo $form->labelEx($model_acredi, 'ACBI_ID');  
                            echo $form->dropDownList($model_acredi, 'ACBI_ID', array(),
                                        array(
                                        'ajax'=>array(
                                                    'type'=>'POST',
                                                    'url'=>CController::createUrl('mdlacreditacion/acreditaciones/cargar_factores'),
                                                    'update'=>'#'.CHtml::activeId($model_acredi,'ACFA_ID'),
                                                    ),
                                        'prompt' => 'Seleccione un Bitacora...',
                                        'class'=>'span4',
                                        //'id'=>'sel_bitacora',
                                        // 'onchange'=>'scriptselected(this.id);',//prueba();'onclick'=>'scriptclick(id)',
                                         //'empty'=>'Seleccione Primero un Programa..',	
                                         //'SelectedValue'=>$model_acredi->ACBI_ID,	 										                                          
                                            ) 
                                       );
                                             ?> </td>
                        </tr><tr>
                            <td><?php echo $form->labelEx($model_acredi, 'ACFA_ID');  
                            echo $form->dropDownList($model_acredi, 'ACFA_ID', array(),
                                        array(
                                        'ajax'=>array(
                                                    'type'=>'POST',
                                                    'url'=>CController::createUrl('mdlacreditacion/acreditaciones/cargar_caracteristicas'),
                                                    'update'=>'#'.CHtml::activeId($model_acredi,'ACCA_ID'),
                                                    ),
                                        'prompt' => 'Seleccione un Factor...',
                                        'class'=>'span4',
                                        //'id'=>'sel_factores',                                           
                                         //'onchange'=>'scriptselected(this.id)',//'onclick'=>'scriptclick(id)',											
                                          ) 
                                       ); 
                             ?> </td>
                        </tr><tr>
                            <td><?php echo $form->labelEx($model_acredi, 'ACCA_ID');  
                            echo $form->dropDownList($model_acredi, 'ACCA_ID', array(),
                                        array(
                                        'ajax'=>array(
                                                    'type'=>'POST',
                                                    'url'=>CController::createUrl('mdlacreditacion/acreditaciones/cargar_aspectos'),
                                                    'update'=>'#'.CHtml::activeId($model_acredi,'ACAS_ID'),
                                                    ),
                                        'prompt' => 'Seleccione un Caracteristica...',
                                        'class'=>'span4',
                                        //'id'=>'sel_caracter',                                           
                                         // 'onchange'=>'scriptselected(this.id)',//'onclick'=>'scriptclick(id)',											
                                         ) 
                                       ); 						   
                                        ?> </td>
                        </tr><tr>
                            <td><?php echo $form->labelEx($model_acredi, 'ACAS_ID');  
                            echo $form->dropDownList($model_acredi, 'ACAS_ID', array(),
                                        array(
                                        'ajax'=>array(
                                                    'type'=>'POST',
                                                    'url'=>CController::createUrl('mdlacreditacion/acreditaciones/cargar_indicadores'),
                                                    'update'=>'#'.CHtml::activeId($model_acredi,'ACIN_ID'),
                                                    ),
                                        'prompt' => 'Seleccione un Aspecto...',
                                        'class'=>'span4',
                                        //'id'=>'sel_caracter',                                           
                                       //   'onchange'=>'scriptselected(this.id)',//'onclick'=>'scriptclick(id)',											
                                         ) 
                                       ); 						   
                                        ?> </td>
                        </tr><tr>
                            <td><?php echo $form->labelEx($model_acredi, 'ACIN_ID');  
                            echo $form->dropDownList($model_acredi, 'ACIN_ID', array(),
                                        array(                       
                                        'prompt' => 'Seleccione un Indicador...',
                                        'class'=>'span4',
                                        //'id'=>'sel_indicado',                                           
                                         //'onchange'=>'scriptselected(this.id)',//'onclick'=>'scriptclick(id)',											 											
                                          ) 
                                       ); 
                                ?> </td>
                        </tr>
                     </table>
                            <?PHP
							 }else{
								 
								 ?> <strong> INDICADOR SELECCIONADO: <?php echo $model->REL_INDI_SOPO->ACIN_DESCRIPCION;?></strong>
								 <?PHP }
					 ?>
                     
              </td>
              <td>
   
                    <p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>
                
                    <?php echo $form->textFieldRow($model,'ACSO_NUMERO',array('class'=>'span5','readonly'=>"readonly")); ?>
                
                    <?php echo $form->textFieldRow($model,'ACSO_DESCRIPCION',array('class'=>'span5','maxlength'=>500)); ?>
                
                    <?php echo $form->textFieldRow($model,'ACSO_URL',array('class'=>'span5','maxlength'=>500)); ?>
                
                    <?php echo $form->textFieldRow($model,'ACSO_RESPUESTA',array('class'=>'span5','maxlength'=>2000)); ?>
                
                    <?php echo $form->textFieldRow($model,'ACSO_FUENTE',array('class'=>'span5','maxlength'=>50)); ?>
                
                    <?php echo $form->textFieldRow($model,'ACSO_ESTADOPM',array('class'=>'span5','maxlength'=>50)); ?>
                    
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




