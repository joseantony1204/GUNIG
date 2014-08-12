<script type="text/javascript">
	function actualizarporid(){
		var ID_PROGRAMA = $.fn.yiiGridView.getSelection('programas-grid');
		$.fn.yiiGridView.update('programas-grid',{ data: ID_PROGRAMA });
		//document.getElementById("td_boton_programas").style.display='none';
		//document.getElementById("acreditaciones_ACBI_ID").focus();		
	}			
</script>


<table border="0" width="100%">
     <tr>
      <td width="90%">         


  <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'acreditacionponderaciones-form',
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
                <table id="tbl_select" cellpadding="10">
                    <tr>
                        <td> <?php $data=acreditacionprogramas::model()->findAll();					    					
                            $list = CHtml::listData($data,'ACPR_ID', 'ACPR_NOMBRE','ACPR_ID');
                            echo $form->labelEx($model_acredi, 'ACPR_ID');
                        	echo $form->dropDownList($model_acredi, 'ACPR_ID', $list,
                                    array(
                                     'ajax'=>array(
                                                'type'=>'POST',
                                                'url'=>CController::createUrl('mdlacreditacion/acreditacionponderaciones/cargar_bitacoras'),
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
                                                'url'=>CController::createUrl('mdlacreditacion/acreditacionponderaciones/cargar_factores'),
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
                                                'url'=>CController::createUrl('mdlacreditacion/acreditacionponderaciones/cargar_caracteristicas'),
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
                                                'url'=>CController::createUrl('mdlacreditacion/acreditacionponderaciones/cargar_ponderacion'),
                                               'update'=>'#div_datagrip',
                                                ),
                                    'prompt' => 'Seleccione un Caracteristica...',
                                    'class'=>'span4',
                                    //'id'=>'sel_caracter',                                           
                                     // 'onchange'=>'scriptselected(this.id)',//'onclick'=>'scriptclick(id)',											
                                     ) 
                                   ); 						   
                                    ?> </td>
                    </tr>
                </table>
            </td>
            <td valign="top">
                     <div id="div_datagrip" >                     		
	                     <?php echo $this->renderPartial('_create', array('model'=>$model)); ?>					  
                     </div>    
                </td>
           </tr>
      </table>	

		<?php $this->endWidget(); ?>
    
    </td>      
  </tr>
</table>