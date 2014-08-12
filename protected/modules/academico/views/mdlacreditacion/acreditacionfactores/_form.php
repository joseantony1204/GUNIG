<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'acreditacionfactores-form',
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
             if($model->ACBI_ID == ""){
								  ?>
                                      <p class="note">Seleccione la ubicacion de la Bitacora.</p>                   
                                      <table id="tbl_select" cellpadding="10">
                    <tr>
                        <td> <?php   $data=acreditacionprogramas::model()->findAll();					    					
                            $list = CHtml::listData($data,'ACPR_ID', 'ACPR_NOMBRE','ACPR_ID');
                           echo $form->labelEx($model_acredi, 'ACPR_ID');
                        echo $form->dropDownList($model_acredi, 'ACPR_ID', $list,
                                    array(
                                     //'onchange'=>'scriptselected(this.id)',//'onclick'=>'scriptclick(id)',											
                                     'ajax'=>array(
                                                'type'=>'POST',
                                                'url'=>CController::createUrl('mdlacreditacion/acreditacionfactores/cargar_bitacoras'),
                                                'update'=>'#'.CHtml::activeId($model_acredi,'ACBI_ID'),
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
                                    'prompt' => 'Seleccione un Bitacora...',
                                    'class'=>'span4',
                                    //'onchange'=>'scriptselected(this.id);',//prueba();'onclick'=>'scriptclick(id)',
                                     //'empty'=>'Seleccione Primero un Programa..',	
                                     //'SelectedValue'=>$model->ACBI_ID,	 										                                          
                                        ) 
                                   );
                                         ?> </td>                
                    </tr>
                </table>  
								<?PHP
							 }else{								 
								 ?><strong>BITACORA SELECCIONADA No. </strong><p>&nbsp;</p>
								 <h3><?php echo $model->REL_BITA_FACT->ACBI_NUMERO .' del '.$model->REL_BITA_FACT->ACBI_FECHA; ?></h3>
								 <?PHP }
					 ?>
                
	 		</td>
            <td>
           		 <p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

				<?php echo $form->textFieldRow($model,'ACFA_NUMERO',array('class'=>'span2','maxlength'=>10,'readonly'=>"readonly",)); ?>
            
                <?php echo $form->textFieldRow($model,'ACFA_DESCRIPCION',array('class'=>'span5','maxlength'=>100)); ?>

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




