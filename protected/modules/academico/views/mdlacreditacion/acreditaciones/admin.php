<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>

<script type="text/javascript">
	function actualizarporid(){
		var ID_PROGRAMA = $.fn.yiiGridView.getSelection('programas-grid');
		$.fn.yiiGridView.update('programas-grid',{ data: ID_PROGRAMA });
	} 	
	
	function scriptselected(target_id){		//alert(target_id);					
		
		/* esconder los botones*/
		document.getElementById("td_boton_programas").style.display='none';
		document.getElementById("td_boton_bitacoras").style.display='none';
		document.getElementById("td_boton_factores").style.display='none';
		document.getElementById("td_boton_caracteristicas").style.display='none';
		document.getElementById("td_boton_aspectos").style.display='none';
		document.getElementById("td_boton_indicadores").style.display='none';
		document.getElementById("td_boton_soportes").style.display='none';
		
		//esconder los div
		document.getElementById("div_programa").style.display='none';
		document.getElementById("div_bitacora").style.display='none';
		document.getElementById("div_factores").style.display='none';
		document.getElementById("div_caracter").style.display='none';
		document.getElementById("div_aspectos").style.display='none';
		document.getElementById("div_indicado").style.display='none';
		document.getElementById("div_soportes").style.display='none';		
		<!-- mostrar lo solicitado -->		
		if(target_id=="acreditaciones_ACPR_ID"){
			document.getElementById("td_boton_bitacoras").style.display='block';
			document.getElementById("div_bitacora").style.display='block'; 
			document.getElementById("acreditaciones_ACBI_ID").focus();
		}		
		if(target_id=="acreditaciones_ACBI_ID"){
			document.getElementById("td_boton_factores").style.display='block'; 
			document.getElementById("div_factores").style.display='block'; 
			document.getElementById("acreditaciones_ACFA_ID").focus();
		}				
		if(target_id=="acreditaciones_ACFA_ID"){
			document.getElementById("td_boton_caracteristicas").style.display='block'; 
			document.getElementById("div_caracter").style.display='block'; 
			document.getElementById("acreditaciones_ACCA_ID").focus();
		}				
		if(target_id=="acreditaciones_ACCA_ID"){
				document.getElementById("td_boton_aspectos").style.display='block';
				document.getElementById("div_aspectos").style.display='block';
				document.getElementById("acreditaciones_ACAS_ID").focus();
		}				
		if(target_id=="acreditaciones_ACAS_ID"){
			document.getElementById("td_boton_indicadores").style.display='block';
			document.getElementById("div_indicado").style.display='block';
			document.getElementById("acreditaciones_ACIN_ID").focus();
		}				
		if(target_id=="acreditaciones_ACIN_ID"){
			document.getElementById("td_boton_soportes").style.display='block';
			document.getElementById("div_soportes").style.display='block';
		}	
	}		
	

function escribir(){
	var variablejs = "contenido de la variable javascript" ;
	variablejs = document.getElementById("acreditaciones_ACPR_ID").value;
	}

</script>



<?php $this->breadcrumbs=array(
	'Acreditacion'=>array('index'),
	'Administrar',
	);	
?>

<table width="100%" align="center" cellpadding="10">
  <tr id="encabezado">
    <td colspan="2">    	
        <fieldset>
          <table width="100%" align="center" id="botones">
                <tr>
                    <td width="7%" align="center">
                            <?php
                                 $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
                                 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => '');
                                 $image = CHtml::image($imageUrl);
                                 echo CHtml::link($image, array('#',),$htmlOptions ); 
                            ?> 
                    </td>
                    <td width="63%"><strong><span><em>ADMINISTRACION DE ACREDITACION</em></span></strong></td>
                    <td align="center">
                             <?php
                                 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
                                 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
                                 $image = CHtml::image($imageUrl);
                                 echo CHtml::link($image, Yii::app()->homeUrl,$htmlOptions ); 
                            ?> 		 
                    </td>
                    <td align="center">
                         <?php
                             $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
                             $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
                             $image = CHtml::image($imageUrl);
                             echo CHtml::link($image, array('acreditaciones/admin',),$htmlOptions ); 
                        ?>         
                    </td>
                    <td id="td_boton_soportes"  style="display:none">									
                        <?php $this->widget('bootstrap.widgets.TbButton', array('htmlOptions'=>array('id'=>'agregar_soporte'),
                            'buttonType'=>'submit',
                            'icon'=>'ok white',
                            'type'=>'success',
                            'size'=>'small',                                        
                            'label'=>'Agregar Soporte',
                            ));
                        ?>                                
                    </td>                                
                </tr>
          </table>
          </fieldset>             
     </td> 
  </tr>
  <tr id="cuerpo">
	<td width="40%" valign="top">
        <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
            'id'=>'acreditacionbitacoras-form',
            'enableAjaxValidation'=>false,
            'type'=>'vertical',
            'htmlOptions'=>array('class'=>'well', 'height'=>'100%', ),
            'enableClientValidation'=>true,
            'clientOptions'=>array(
            'validateOnSubmit'=>true,),
        )); 
		
		   //if(!isset($model_acredi->ACBI_ID))
                $data=acreditacionprogramas::model()->findAll();					    					
                $list = CHtml::listData($data,'ACPR_ID', 'ACPR_NOMBRE','ACPR_ID');
        ?>	
            
            <h4> SELECCIONA TU OPCION: </h4>         
      
            <table id="tbl_select" cellpadding="10">
        
        		<tr>
                   <td> <?php  echo $form->labelEx($model_acredi, 'ACPR_ID');
                                echo $form->dropDownList($model_acredi, 'ACPR_ID', $list,
                                    array(
                                     'onchange'=>'scriptselected(this.id);',//'onclick'=>'scriptclick(id)',											
                                     'ajax'=>array(
                                                'type'=>'POST',
                                                'url'=>CController::createUrl('mdlacreditacion/acreditaciones/cargar_bitacoras'),
                                                'update'=>'#'.CHtml::activeId($model_acredi,'ACBI_ID'),
                                               // 'update'=>'#prueba"',
                                               'beforeSend'=>'function(){   $("#acreditaciones_ACFA_ID").find("option").remove();
											   								$("#acreditaciones_ACCA_ID").find("option").remove();
																			$("#acreditaciones_ACAS_ID").find("option").remove();
																			$("#acreditaciones_ACIN_ID").find("option").remove();
																			$("#acreditaciones_ACSO_ID").find("option").remove();
																	  }'
                                                ),
                                    'prompt' => 'Seleccione un Programa...',
                                    'class'=>'span4',
                                    //'id'=>'sel_programa',
                                        )
                                   );                                 
                        ?> 
                   </td>
                   <td id="td_boton_programas">	<?php /* $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType'=>'submit',
                            'icon'=>'ok white',
                            'type'=>'success',
                            'size'=>'small',                                        
                            'label'=>'Agregar Programa',
							'htmlOptions'=>array('id'=>'agregar_programa'),
                            ));
                       */ ?>                                
                   </td>
                </tr>
                <tr>
                	<td><?php echo $form->labelEx($model_acredi, 'ACBI_ID');   
                echo $form->dropDownList($model_acredi, 'ACBI_ID', array(),
                            array(
                            'ajax'=>array(
                                        'type'=>'POST',
                                        'url'=>CController::createUrl('mdlacreditacion/acreditaciones/cargar_factores'),
                                        'update'=>'#'.CHtml::activeId($model_acredi,'ACFA_ID'),
										 'beforeSend'=>'function(){  		$("#acreditaciones_ACCA_ID").find("option").remove();
																			$("#acreditaciones_ACAS_ID").find("option").remove();
																			$("#acreditaciones_ACIN_ID").find("option").remove();
																			$("#acreditaciones_ACSO_ID").find("option").remove();
																	  }'
                                        ),
                            'prompt' => 'Seleccione un Bitacora...',
                            'class'=>'span4',
                            //'id'=>'sel_bitacora',
                             'onchange'=>'scriptselected(this.id);',//prueba();'onclick'=>'scriptclick(id)',
                             //'empty'=>'Seleccione Primero un Programa..',	
                             'SelectedValue'=>$model_acredi->ACBI_ID,	 										                                          
                                ) 
                           );
                                 ?> 
                    </td>
                    <td id="td_boton_bitacoras"><?php /* $this->widget('bootstrap.widgets.TbButton', array('htmlOptions'=>array('id'=>'agregar_bitacora'),
                                    'buttonType'=>'submit',
                                    'icon'=>'ok white',
                                    'type'=>'success',
                                    'size'=>'small',                                        
                                    'label'=>'Agregar Bitacora',
                                    ));
                                */ ?>                                
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($model_acredi, 'ACFA_ID');  
                    echo $form->dropDownList($model_acredi, 'ACFA_ID', array(),
                                array(
                                'ajax'=>array(
                                            'type'=>'POST',
                                            'url'=>CController::createUrl('mdlacreditacion/acreditaciones/cargar_caracteristicas'),
                                            'update'=>'#'.CHtml::activeId($model_acredi,'ACCA_ID'),
											 'beforeSend'=>'function(){     $("#acreditaciones_ACAS_ID").find("option").remove();
																			$("#acreditaciones_ACIN_ID").find("option").remove();
																			$("#acreditaciones_ACSO_ID").find("option").remove();
																	  }'
                                            ),
                                'prompt' => 'Seleccione un Factor...',
                                'class'=>'span4',
                                //'id'=>'sel_factores',                                           
                                 'onchange'=>'scriptselected(this.id)',//'onclick'=>'scriptclick(id)',											
                                  ) 
                               ); 
                     ?> 
                    </td>
                    <td id="td_boton_factores">									
						<?php /* $this->widget('bootstrap.widgets.TbButton', array(
							'htmlOptions'=>array('id'=>'agregar_factor'),
                            'buttonType'=>'submit',
                            'icon'=>'ok white',
                            'type'=>'success',
                            'size'=>'small',                                        
                            'label'=>'Agregar Factor',
                            ));
                       */ ?>                                
                   	</td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($model_acredi, 'ACCA_ID');  
                    echo $form->dropDownList($model_acredi, 'ACCA_ID', array(),
                                array(
                                'ajax'=>array(
                                            'type'=>'POST',
                                            'url'=>CController::createUrl('mdlacreditacion/acreditaciones/cargar_aspectos'),
                                            'update'=>'#'.CHtml::activeId($model_acredi,'ACAS_ID'),
											 'beforeSend'=>'function(){   $("#acreditaciones_ACIN_ID").find("option").remove();
																			$("#acreditaciones_ACSO_ID").find("option").remove();
																	  }'
                                            ),
                                'prompt' => 'Seleccione un Caracteristica...',
                                'class'=>'span4',
                                //'id'=>'sel_caracter',                                           
                                  'onchange'=>'scriptselected(this.id)',//'onclick'=>'scriptclick(id)',											
                                 ) 
                               ); 						   
                                ?> 
                    </td>
                    <td id="td_boton_caracteristicas">									
                        <?php /* $this->widget('bootstrap.widgets.TbButton', array('htmlOptions'=>array('id'=>'agregar_caracteristica'),
                            'buttonType'=>'submit',
                            'icon'=>'ok white',
                            'type'=>'success',
                            'size'=>'small',                                        
                            'label'=>'Agregar Caracteristica',
                            ));
                       */ ?>                                
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($model_acredi, 'ACAS_ID');  
                    echo $form->dropDownList($model_acredi, 'ACAS_ID', array(),
                                array(
                                'ajax'=>array(
                                            'type'=>'POST',
                                            'url'=>CController::createUrl('mdlacreditacion/acreditaciones/cargar_indicadores'),
                                            'update'=>'#'.CHtml::activeId($model_acredi,'ACIN_ID'),
											 'beforeSend'=>'function(){  
																			$("#acreditaciones_ACSO_ID").find("option").remove();
																	  }'
                                            ),
                                'prompt' => 'Seleccione un Aspecto...',
                                'class'=>'span4',
                                //'id'=>'sel_caracter',                                           
                                  'onchange'=>'scriptselected(this.id)',//'onclick'=>'scriptclick(id)',											
                                 ) 
                               ); 						   
                                ?> 
                    </td>
                    <td id="td_boton_aspectos">									
                        <?php /* $this->widget('bootstrap.widgets.TbButton', array('htmlOptions'=>array('id'=>'agregar_aspecto'),
                            'buttonType'=>'submit',
                            'icon'=>'ok white',
                            'type'=>'success',
                            'size'=>'small',                                        
                            'label'=>'Agregar Aspecto',
                            ));
                       */ ?>                                
                    </td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($model_acredi, 'ACIN_ID');  
                    echo $form->dropDownList($model_acredi, 'ACIN_ID', array(),
                                array(
                                'ajax'=>array(
                                            'type'=>'POST',
                                            'url'=>CController::createUrl('mdlacreditacion/acreditaciones/filtrarsoportes'),
                                            'update'=>'#div_soportes',//.CHtml::activeId($model_soport,'soportes_grid')
                                            ),
                                'prompt' => 'Seleccione un Indicador...',
                                'class'=>'span4',
                                //'id'=>'sel_indicado',                                           
                                 'onchange'=>'scriptselected(this.id)',//'onclick'=>'scriptclick(id)',											 											
                                  ) 
                               ); 
                        ?>
                    </td>
                    <td id="td_boton_indicadores">									
                        <?php /* $this->widget('bootstrap.widgets.TbButton', array('htmlOptions'=>array('id'=>'agregar_indicador'),
                                    'buttonType'=>'submit',
                                    'icon'=>'ok white',
                                    'type'=>'success',
                                    'size'=>'small',                                        
                                    'label'=>'Agregar Indicador',
                                    ));
                              */  ?>                                
                    </td>
                </tr>
            </table>
            <?php /*
            <table id="tbl_botones" cellpadding="10" width="100%">
                <tr>
                    <td id="td_boton_programas" align="center">         
                        <?php  $this->widget('bootstrap.widgets.TbButton', array(	'loadingText'=>'Agregar Programa',
                                    'label'=>'Agregar Programa', //'buttonType'=>'submit',
                                    'type'=>'primary',															
                                    'htmlOptions'=>array('data-toggle'=>'modal',
														'data-target'=>'#VenModal_programas',
														'id'=>'btn_programas',														
													),
												));
						 ?>
				    </td>
                </tr><tr>
                    <td style="display:none" id="td_boton_bitacoras" align="center">         
                        <?php  $this->widget('bootstrap.widgets.TbButton', array(	'loadingText'=>'Agregar Bitacora',
                                    'label'=>'Agregar Bitacora',
                                     'type'=>'primary',															
                                    'htmlOptions'=>array('data-toggle'=>'modal',
														'data-target'=>'#VenModal_bitacoras',
														'id'=>'btn_bitacoras',)
                                )
                            );									 ?>						
                    </td>
                </tr><tr>
                    <td style="display:none" id="td_boton_factores" align="center"> 		  
                        <?php  $this->widget('bootstrap.widgets.TbButton', array(	'loadingText'=>'Agregar Factores',
                                    'label'=>'Agregar Factor',
                                     'type'=>'primary',															
                                    'htmlOptions'=>array('data-toggle'=>'modal',
														'data-target'=>'#VenModal_factores',
														'id'=>'btn_factores',)
                                )
                            );									 ?>
                    </td>
                </tr><tr>
                    <td style="display:none" id="td_boton_caracteristicas" align="center">   
                        <?php  $this->widget('bootstrap.widgets.TbButton', array(	'loadingText'=>'Agregar caracteristicas', 
									'type'=>'primary',															
                                    'htmlOptions'=>array('data-toggle'=>'modal',
														'data-target'=>'#VenModal_caracteristicas',
														'id'=>'btn_caracteristicas',)
                                )
                            );									 ?>
					 </td>
                </tr><tr>
                    <td style="display:none" id="td_boton_aspectos" align="center"> 		  
                        <?php  $this->widget('bootstrap.widgets.TbButton', array(	'loadingText'=>'Agregar Aspectos',
                                    'label'=>'Agregar Aspecto',
                                     'type'=>'primary',															
                                    'htmlOptions'=>array('data-toggle'=>'modal',
														'data-target'=>'#VenModal_aspectos',
														'id'=>'btn_aspectos',)
                                )
                            );									 ?>
					</td>
                </tr><tr>
                    <td style="display:none" id="td_boton_indicadores" align="center">         
                        <?php  $this->widget('bootstrap.widgets.TbButton', array(	'loadingText'=>'Agregar Indicadores',
                                    'label'=>'Agregar Indicador',
                                     'type'=>'primary',															
                                    'htmlOptions'=>array('data-toggle'=>'modal',
														'data-target'=>'#VenModal_indicadores',
														'id'=>'btn_indicadores',)
                                )
                            );									 ?>
					</td>
                </tr><tr>
                    <td style="display:none" id="td_boton_soportes" align="center">         
                        <?php  $this->widget('bootstrap.widgets.TbButton', array(	'loadingText'=>'Agregar Soportes',
                                    'label'=>'Agregar Soportes',
                                    'type'=>'primary',															
                                    'htmlOptions'=>array('data-toggle'=>'modal',
														'data-target'=>'#VenModal_soportes',
														'id'=>'btn_soportes',)
                                )
                            );									 ?>                        
                    </td>
                </tr>
            </table>
            */ ?>
            		<?php /* $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'VenModal_programas')); 
                            echo $this->renderPartial('/mdlacreditacion/acreditacionprogramas/_form',array(
                                'model'=>$model_progra,
                            ));    
                             $this->endWidget(); 
                        ?>
                	<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'VenModal_bitacoras')); 
                            echo $this->renderPartial('/mdlacreditacion/acreditacionbitacoras/_form',array(
                                'model'=>$model_bitaco,
                            ));    
                             $this->endWidget();
                        ?>
                    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'VenModal_factores')); 
                            echo $this->renderPartial('/mdlacreditacion/acreditacionfactores/_form',array(
                                'model'=>$model_progra,
                            ));    
                             $this->endWidget(); 
                        ?>
           			<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'VenModal_caracteristicas')); 
                            echo $this->renderPartial('/mdlacreditacion/acreditacioncaracteristicas/_form',array(
                                'model'=>$model_progra,
                            ));    
                             $this->endWidget(); 
                        ?>
                   	<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'VenModal_aspectos')); 
                            echo $this->renderPartial('/mdlacreditacion/acreditacionaspectos/_form',array(
                                'model'=>$model_aspect,
                            ));    
                             $this->endWidget(); 
                        ?>
                    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'VenModal_indicadores')); 
                            echo $this->renderPartial('/mdlacreditacion/acreditacionindicadores/_form',array(
                                'model'=>$model_indica,
                            ));    
                             $this->endWidget(); 
                        ?>
                    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'VenModal_soportes')); 
                            echo $this->renderPartial('/mdlacreditacion/acreditacionsoportes/_form',array(
                                'model'=>$model_soport,
                            )); $this->endWidget(); */ ?>
							
        <?php $this->endWidget(); ?>
     </td>    
     <td id="listados" valign="top">
                        <div id="div_programa">						
                               <?php $this->renderPartial('_programas', array('model_progra'=>$model_progra)); ?>
                        </div>
                        <div id="div_bitacora" style="display:none">
                               <?php $this->renderPartial('_bitacoras', array('model_bitaco'=>$model_bitaco)); ?>                                                         
                        </div>							
                        <div id="div_factores" style="display:none">
                               <?php $this->renderPartial('_factores', array('model_factor'=>$model_factor)); ?>                                                         
                        </div>
                        <div id="div_caracter" style="display:none">
                               <?php $this->renderPartial('_caracteristicas', array('model_caract'=>$model_caract)); ?>                                                         
                        </div>
                        <div id="div_aspectos" style="display:none">
                               <?php $this->renderPartial('_aspectos', array('model_aspect'=>$model_aspect)); ?>                                                         
                        </div>
                        <div id="div_indicado" style="display:none">
							<?php $this->renderPartial('_indicadores', array('model_indica'=>$model_indica)); ?>                                                         
                        </div>
                        <div id="div_soportes" style="display:none">
                               <?php $this->renderPartial('_soportes', array('model_soport'=>$model_soport)); ?>                                                         
                        </div>
                    </td>
  </tr>
</table>	
  




