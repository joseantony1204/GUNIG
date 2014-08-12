<table border="0" width="100%">
     <tr>
      <td width="90%">         
			<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
                'id'=>'usuariosroles-form',
                'enableAjaxValidation'=>false,
                'type'=>'vertical',
                'htmlOptions'=>array('class'=>'well'),
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,),
            )); ?>
            
                <p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>
            
                <?php echo $form->errorSummary($model); ?>
                <table width="100%" border="0">
                  <tr>
                    <td width="50%" border="0">	
							<?php echo $form->textFieldRow($model,'USRO_NOMBRE',array('class'=>'span4','maxlength'=>45)); ?>	       	
                            <?php echo $form->labelEx($model,'USMO_ID'); ?><?php $criterio = array('order'=>'USMO_NOMBRE ASC'); ?>
                           <?php 
                              $data = CHtml::listData(Usuariosmodulos::model()->findAll($criterio),'USMO_ID','USMO_NOMBRE');
                              echo $form->dropDownList($model,'USMO_ID',$data,
                                        array(
                                            'ajax' => array(
                                             'type' => 'POST',
                                             'url' => CController::createUrl('roles/usuariosroles/cargarSubModulos'),
                                             'update' => '#'.CHtml::activeId($model,'USSM_ID'),
                                            ),
                                            'prompt' => 'Seleccione un modulo...',
                                            'class'=>'span4',
                                  )
                              );
                        ?>
                        <?php echo $form->error($model,'USMO_ID'); ?>
                            <?php echo $form->labelEx($model,'USSM_ID'); ?>
                            <?php 
                                $lista_uno = array();
                                if(isset($model->USMO_ID)){
                                $id_uno = intval($model->USMO_ID); 
                                $lista_uno = CHtml::listData(Usuariossubmodulos::model()->findAll("USMO_ID = '$id_uno'"),'USSM_ID','USSM_NOMBRE');
                                }
                                echo $form->dropDownList($model,'USSM_ID',$lista_uno,
                                        array(
                                        'ajax' => array(
                                             'type' => 'POST',
                                             'url' => CController::createUrl('roles/usuariosroles/cargarControladores'),
                                             'update' => '#'.CHtml::activeId($model,'USCO_ID'),
                                            ),
                                        
                                        'class'=>'span4',
                                        'prompt'=>'Seleccione un modulo')
                                        ); ?>
                            <?php echo $form->error($model,'USSM_ID'); ?> 
                            <?php echo $form->labelEx($model,'USCO_ID'); ?>
                            <?php 
                                $lista_uno = array();
                                if(isset($model->USSM_ID)){
                                $id_uno = intval($model->USSM_ID); 
                                $lista_uno = CHtml::listData(Usuarioscontroladores::model()->findAll("USSM_ID = '$id_uno'"),'USCO_ID','USCO_NOMBRE');
                                }
                                echo $form->dropDownList($model,'USCO_ID',$lista_uno,
                                        array(
                                        'ajax' => array(
                                             'type' => 'POST',
                                             'url' => CController::createUrl('roles/usuariosroles/cargarVistas'),
                                             'update' => '#td_vistas',//'#'.CHtml::activeId($model,'USVI_ID'),
                                            ),
                                        
                                        'class'=>'span4',
                                        'prompt'=>'Seleccione un sub modulo')
                                        ); ?>
                            <?php echo $form->error($model,'USCO_ID'); ?> 
                            <?php echo $form->labelEx($model,'USPE_ID'); ?>
                            <?php $data = CHtml::listData(Usuariosperfiles::model()->findAll(),'USPE_ID','USPE_NOMBRE') ?>
                            <?php echo $form->dropDownList($model,'USPE_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
                            <?php echo $form->error($model,'USPE_ID'); ?>
                            <?php /* echo $form->labelEx($model,'USVI_ID');?>
                        <?php 
                                $lista_uno = array();
                                if(isset($model->USCO_ID)){
                                $id_uno = intval($model->USCO_ID); 
                                $lista_uno = CHtml::listData(Usuariosvistas::model()->findAll("USCO_ID = '$id_uno'"),'USVI_ID','USVI_NOMBRE');
                                }
                                //$lista_uno = CHtml::listData(Usuariosvistas::model()->findAll(),'USVI_ID','USVI_NOMBRE');
                               // echo $form->dropDownList($model,'USVI_ID',$lista_uno, array('class'=>'span4','prompt'=>'Seleccione controlador')); 
                                echo $form->checkboxlistrow($model,'USVI_ID',$lista_uno, array('class'=>'span4','prompt'=>'Seleccione controlador'));
                                
                            ?>
                        <?php echo $form->error($model,'USVI_ID');*/ ?> 
                    </td>
                    <td  width="5%"  bgcolor="#FFD4FF">&nbsp;</td>
                    <td id="td_vistas" bgcolor="#FFD4FF" width="45%" border="1" align="left" valign="top">
                       
                            <?php $list = array(); 
									echo 'Seleccione las vistas para el rol a crear:';
								 	echo CHtml::checkBoxList('check_vistas','',$list, array('class'=>'span4','prompt'=>'Seleccione controlador'));
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




