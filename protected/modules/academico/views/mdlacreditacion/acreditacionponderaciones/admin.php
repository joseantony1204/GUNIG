<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>

<?php
$this->breadcrumbs=array(
	'Ponderacion'=>array('index'),
	'Administrar',
);

?>

<table width="100%" border="0" align="center">
  <tr>
    <td><table width="100%" border="0" align="center">
      <tr>
        <td>
        <fieldset>
          <table width="100%" border="0" align="center">
            <tr>
              <td width="6%" align="center"><img src="../images/setting.png" width="60" height="70" /></td>
             <td width="63%"><strong><span><em>ADMINISTRACION DE PONDERACIONES</em></span></strong></td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a Inicio');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image,Yii::app()->homeUrl,$htmlOptions ); 
?>         
		 
</td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Refrescar Pagina');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlacreditacion/acreditacionponderaciones/admin',),$htmlOptions ); 
?>         
		 </td>

<td width="7%" align="center">
         <?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/add.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Crear Registro');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlacreditacion/acreditacionponderaciones/create',),$htmlOptions ); 
?>         
		 </td>
            </tr>
          </table>
          </fieldset>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
   <td colspan="2">
   </td>
  </tr>
  <tr>
    <td>

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
        
			  <?php  echo $form->errorSummary($model); ?>              


              <table cellpadding="10">
                    <tr>
                        <td  valign="top">
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
                                                            ),
                                                'prompt' => 'Seleccione un Programa...',
                                                'class'=>'span4',
                                                    )
                                               );                                 ?>
									 </td>
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
                                                   ) 
                                               ); 
                                     ?> </td>
                                </tr><tr>
                                    <td><?php echo $form->labelEx($model_acredi, 'ACCA_ID');  
                                    echo $form->dropDownList($model_acredi, 'ACCA_ID', array(),
                                                array(
                                                'ajax'=>array(
                                                            'type'=>'POST',
                                                            'url'=>CController::createUrl('mdlacreditacion/acreditacionponderaciones/cargar_modeloponderacion'),
                                                           'update'=>'#div_datagrip',
                                                            ),
                                                'prompt' => 'Seleccione un Caracteristica...',
                                                'class'=>'span4',
                                                  ) 
                                               ); 						   
                                                ?> </td>
                                </tr>
                            </table>  
                        </td>
                        <td valign="top">
                             <div id="div_datagrip" >                     		
                                 <?php echo $this->renderPartial('_admin', array('model'=>$model)); ?>					  
                             </div>    
                        </td>
                   </tr>
              </table>	
        
          <?php $this->endWidget(); ?>
            
    </td>      
  </tr>
</table>



    </td>
  </tr>
</table>
