 <table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'personasjurudicas-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<p><?php echo $form->errorSummary($Personasjuridicas); ?>
	  <?php echo $form->errorSummary($Personas); ?></p>
	<table width="100%" border="0">
	  <tr>
	    <td>
        <h5>DATOS BASICOS</h5>
        <fieldset>
        <table width="100%" border="0">
	      <tr>
	        <td>
			 <?php echo $form->labelEx($Personas,'TIID_ID'); ?>
			 <?php $data = CHtml::listData(Tiposidentificacion::model()->findAll(),'TIID_ID','TIID_NOMBRE') ?>
             <?php echo $form->dropDownList($Personas,'TIID_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?>
             <?php echo $form->error($Personas,'TIID_ID'); ?>
			 </td>
	         <td>&nbsp;</td>
	         <td><?php echo $form->textFieldRow($Personas,'PERS_IDENTIFICACION',array('class'=>'span3','maxlength'=>20));?></td>
	         </tr>
           <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	       </tr>
           <tr>
	        <td><?php echo $form->textFieldRow($Personas,'PERS_EMAIL',array('class'=>'span3')); ?></td>
	        <td><?php echo $form->hiddenField($Personas,'PERS_FECHAINGRESO',array('value'=>date("Y-m-d").' '.date("h:i:s"),));?></td>
	        <td><?php echo $form->textFieldRow($Personas,'PERS_TELEFONO',array('class'=>'span3')); ?></td>
	       </tr>
           <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	       </tr>
           <tr>
	        <td><?php echo $form->textFieldRow($Personasjuridicas,'PEJU_NOMBRE',array('class'=>'span3')); ?></td>
	        <td>&nbsp;</td>
	        <td><?php echo $form->textFieldRow($Personasjuridicas,'PEJU_OBJETOCOMERCIAL',array('class'=>'span3')); ?></td>
	       </tr>
           <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	       </tr>
           <tr>
	        <td>
			 <?php echo $form->labelEx($Personas,'TIRE_ID'); ?>
			 <?php $data = CHtml::listData(Tiposregimen::model()->findAll(),'TIRE_ID','TIRE_NOMBRE') ?>
             <?php echo $form->dropDownList($Personas,'TIRE_ID',$data, array('class'=>'span3',)); ?>
             <?php echo $form->error($Personas,'TIRE_ID'); ?>
            </td>
	        <td>&nbsp;</td>
	       <td>&nbsp;</td>
	       </tr>
	       </table>
           </td>
          </tr>
	    <tr>
	     <td>
        <h5>DATOS DE UBICACION</h5>
        <fieldset>
        <table width="100%" border="0">
	       <tr>
	        <td>
             <?php $citerio = array('order'=>'PAIS_NOMBRE'); ?>
             <?php echo $form->labelEx($Personas,'PAIS_ID'); ?>
			 <?php $data = CHtml::listData(Paises::model()->findAll($citerio),'PAIS_ID','PAIS_NOMBRE') ?>
             <?php echo $form->dropDownList($Personas,'PAIS_ID',$data, 
			                                array(
											      'ajax' => array(
                                                                  'type' => 'POST',
                                                                  'url' => CController::createUrl('mdlordenes/personas/obtdepa'),
                                                                  'update' => '#'.CHtml::activeId($Personas,'DEPA_ID'),
                                                                  ),
												  'class'=>'span3',
											      'prompt'=>'Elije...',
												  )
											     ); 
			?>
             <?php echo $form->error($Personas,'PAIS_ID'); ?>
            </td>
	        <td>&nbsp;</td>
	        <td>
          <?php $criterio = array('order'=>'DEPA_NOMBRE'); ?>
             <?php echo $form->labelEx($Personas,'DEPA_ID'); ?>
			 <?php
			 $lista_one = array(); 
			 if(isset($Personas->PAIS_ID)){
                $id_one = intval($Personas->PAIS_ID);
			    $lista_one = CHtml::listData(Departamentos::model()->findAll("PAIS_ID = '$id_one'"),'DEPA_ID','DEPA_NOMBRE');
			    }
			 ?>
             <?php echo $form->dropDownList($Personas,'DEPA_ID',$lista_one, 
			                                array(
											      'ajax' => array(
                                                                  'type' => 'POST',
                                                                  'url' => CController::createUrl('mdlordenes/personas/obtmuni'),
                                                                  'update' => '#'.CHtml::activeId($Personas,'MUNI_ID'),
                                                                  ),
												  'class'=>'span3',
											      'prompt'=>'Elije un pais...',
												  )
											     ); 
			?>
             <?php echo $form->error($Personas,'DEPA_ID'); ?> 
            </td>
	       </tr>
           <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	       </tr>
           <tr>
	        <td>
             <?php $criterio = array('order'=>'MUNI_NOMBRE'); ?>
             <?php echo $form->labelEx($Personas,'MUNI_ID'); ?>
			 <?php 
			 $lista_one = array();
			 if(isset($Personas->DEPA_ID)){
                $id_one = intval($Personas->DEPA_ID);
			    $lista_one = CHtml::listData(Municipios::model()->findAll("DEPA_ID = '$id_uno'",$criterio),'MUNI_ID','MUNI_NOMBRE');
			    }
			 ?>
   <?php echo $form->dropDownList($Personas,'MUNI_ID',$lista_one, array('class'=>'span3','prompt'=>'Elije un departamento...')); ?>
             <?php echo $form->error($Personas,'MUNI_ID'); ?>
            </td>
	        <td>&nbsp;</td>
            <td><?php echo $form->textFieldRow($Personas,'PERS_DIRECCION',array('class'=>'span3')); ?></td>
	       </tr>
	      </table>
          </fieldset>
        </td>
	    </tr>
	  </table>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Personasjuridicas->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>