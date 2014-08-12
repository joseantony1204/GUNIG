<table border="0" width="100%">
     <tr>
      	<td width="90%">         
			<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                'id'=>'usuariosvistas-form',
                'enableAjaxValidation'=>false,
                'type'=>'vertical',
                'htmlOptions'=>array('class'=>'well'),
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,),
            )); ?>                         
                <p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>
				<?php echo $form->errorSummary($model); ?>
                <table border="0" width="100%" >
                   <tr>
                      <td valign="top">  
                            <?php echo $form->labelEx($model,'USCO_ID'); ?>
                            <?php $data = CHtml::listData(Usuarioscontroladores::model()->findAll(),'USCO_ID','USCO_NOMBRE') ?>
                            <?php echo $form->dropDownList($model,'USCO_ID',$data, 
									  array(
                                        /*'ajax' => array(
                                             'type' => 'POST',
                                             'url' => CController::createUrl('roles/usuariosvistas/cargar_formu'),
                                             'update' => '#td_lista_vistas',//'#'.CHtml::activeId($model,'USVI_ID'),
                                            ),   */                                     
                                        'class'=>'span4',
                                        'prompt'=>'Seleccione un sub modulo')); 
								?>
                            <?php echo $form->error($model,'USCO_ID'); ?>
                            
                            <?php echo $form->textFieldRow($model,'USVI_NOMBRE',array('class'=>'span4','maxlength'=>45)); ?>
                        
                            <?php echo $form->textAreaRow($model,'USVI_URL',array('class'=>'span4')); ?>
                        </td>            
                        <td width="20"bgcolor="#FFD4FF"> <p>&nbsp;</p> </td>            
                        <td id="td_lista_vistas" bgcolor="#FFD4FF" width="45%" border="1" align="left" valign="top">
                            
							<?php   // width="5%" 
								if($model->USCO_ID==''){ echo 'SELECCIONE UN CONTROLADOR';}
								else{
									 echo $this->renderPartial('_lista', array('model'=>$model)); 						
								}
							?>                                
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





