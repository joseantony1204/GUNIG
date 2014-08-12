<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'personasnaturales-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<p><?php echo $form->errorSummary($Personasnaturales); ?>
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
	         <td><?php echo $form->textFieldRow($Personasnaturales,'PENA_LUGAREXPIDENTIDAD',array('class'=>'span3')); ?></td>
	         <td>&nbsp;</td>
	         <td>
			 <?php echo $form->labelEx($Personasnaturales,'PENA_FECHAEXPIDENTIDAD'); ?>
			 <?php
             if ($Personasnaturales->PENA_FECHAEXPIDENTIDAD!='') {
             $Personasnaturales->PENA_FECHAEXPIDENTIDAD = date('Y-m-d',strtotime($Personasnaturales->PENA_FECHAEXPIDENTIDAD));
             }
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$Personasnaturales,
             'attribute'=>'PENA_FECHAEXPIDENTIDAD',
             'value'=>$Personasnaturales->PENA_FECHAEXPIDENTIDAD,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
			 'yearRange'=>'1900:2050',
             'defaultDate'=>$Personasnaturales->PENA_FECHAEXPIDENTIDAD,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha expedicion num. identificacion',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => 'true',
             'changeYear' => 'true',
             ),
             )); ?>
            <?php echo $form->error($Personasnaturales,'PENA_FECHAEXPIDENTIDAD'); ?>
             
             </td>
	       </tr>
	       <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	       </tr>
           <tr>
	        <td><?php echo $form->textFieldRow($Personasnaturales,'PENA_NOMBRES',array('class'=>'span3')); ?></td>
	        <td>&nbsp;</td>
	        <td><?php echo $form->textFieldRow($Personasnaturales,'PENA_APELLIDOS',array('class'=>'span3')); ?></td>
	       </tr>
           <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	       </tr>
           <tr>
	        <td>
             <?php echo $form->labelEx($Personasnaturales,'SEXO_ID'); ?>
			 <?php $data = CHtml::listData(Sexos::model()->findAll(),'SEXO_ID','SEXO_NOMBRE') ?>
             <?php echo $form->dropDownList($Personasnaturales,'SEXO_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?>
             <?php echo $form->error($Personasnaturales,'SEXO_ID'); ?>
            </td>
	        <td>&nbsp;</td>
	        <td>
             <?php echo $form->labelEx($Personasnaturales,'ESCI_ID'); ?>
			 <?php $data = CHtml::listData(Estadoscivil::model()->findAll(),'ESCI_ID','ESCI_NOMBRE') ?>
             <?php echo $form->dropDownList($Personasnaturales,'ESCI_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?>
             <?php echo $form->error($Personasnaturales,'ESCI_ID'); ?>
            </td>
	       </tr>
           <tr>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	       </tr>
           <tr>
	        <td><?php echo $form->textFieldRow($Personas,'PERS_EMAIL',array('class'=>'span3')); ?></td>
	        <td>&nbsp;</td>
	        <td><?php echo $form->textFieldRow($Personas,'PERS_TELEFONO',array('class'=>'span3')); ?></td>
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
	        <td><?php echo $form->hiddenField($Personas,'PERS_FECHAINGRESO',array('value'=>date("Y-m-d").' '.date("h:i:s"),));?></td>
	       </tr>
	      </table>
          </fieldset>
          </td>
	    </tr>
	  <tr>
	    <td>
        <h5>DATOS DE NACIMIENTO</h5>
        <fieldset>
        <table width="100%" border="0">
	       <tr>
	        <td>
             <?php $criterio = array('order'=>'PAIS_NOMBRE'); ?>
			 <?php echo $form->labelEx($Personasnaturales,'PAIS_ID'); ?>
			 <?php $data = CHtml::listData(Paises::model()->findAll($criterio),'PAIS_ID','PAIS_NOMBRE') ?>
             <?php echo $form->dropDownList($Personasnaturales,'PAIS_ID',$data, 
			                                array(
											      'ajax' => array(
                                                                  'type' => 'POST',
                                                                  'url' =>CController::createUrl('mdlocasionales/personasnaturales/obtdepa'),
                                                                  'update' => '#'.CHtml::activeId($Personasnaturales,'DEPA_ID'),
                                                                  ),
												  'class'=>'span3',
											      'prompt'=>'Elije...',
												  )
											     ); 
			?>
             <?php echo $form->error($Personasnaturales,'PAIS_ID'); ?>
            </td>
	        <td>&nbsp;</td>
	        <td>
             <?php $criterio = array('order'=>'DEPA_NOMBRE'); ?>
             <?php echo $form->labelEx($Personasnaturales,'DEPA_ID'); ?>
			 <?php
			 $lista_uno = array(); 
			 if(isset($Personasnaturales->PAIS_ID)){
                $id_uno = intval($Personasnaturales->PAIS_ID);
			    $lista_uno = CHtml::listData(Departamentos::model()->findAll("PAIS_ID = '$id_uno'",$criterio),'DEPA_ID','DEPA_NOMBRE');
			    }
			 ?>
             <?php echo $form->dropDownList($Personasnaturales,'DEPA_ID',$lista_uno, 
			                                array(
											      'ajax' => array(
                                                                  'type' => 'POST',
                                                                  'url' =>CController::createUrl('mdlocasionales/personasnaturales/obtmuni'),
                                                                  'update' => '#'.CHtml::activeId($Personasnaturales,'MUNI_ID'),
                                                                  ),
												  'class'=>'span3',
											      'prompt'=>'Elije un pais...',
												  )
											     ); 
			?>
             <?php echo $form->error($Personasnaturales,'DEPA_ID'); ?> 
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
             <?php echo $form->labelEx($Personasnaturales,'MUNI_ID'); ?>
			 <?php 
			 $lista_uno = array();
			 if(isset($Personasnaturales->DEPA_ID)){
                $id_uno = intval($Personasnaturales->DEPA_ID);
			    $lista_uno = CHtml::listData(Municipios::model()->findAll("DEPA_ID = '$id_uno'",$criterio),'MUNI_ID','MUNI_NOMBRE');
			    }
			 ?>
  <?php echo $form->dropDownList($Personasnaturales,'MUNI_ID',$lista_uno, array('class'=>'span3','prompt'=>'Elije un departamento...')); ?>
             <?php echo $form->error($Personasnaturales,'MUNI_ID'); ?>
            </td>
	        <td>&nbsp;</td>
	        <td>
             <?php echo $form->labelEx($Personasnaturales,'PENA_FECHANACIMIENTO'); ?>
			 <?php
             if($Personasnaturales->PENA_FECHANACIMIENTO!='') {
             $Personasnaturales->PENA_FECHANACIMIENTO = date('Y-m-d',strtotime($Personasnaturales->PENA_FECHANACIMIENTO));
             }else{
				  $Personasnaturales->PENA_FECHANACIMIENTO = date('Y-m-d');
				  }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$Personasnaturales,
             'attribute'=>'PENA_FECHANACIMIENTO',
             'value'=>$Personasnaturales->PENA_FECHANACIMIENTO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>true,
			 'yearRange'=>'1900:2050',
             'defaultDate'=>$Personasnaturales->PENA_FECHANACIMIENTO,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha Nacimiento',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => 'true',
             'changeYear' => 'true',
             ),
             )); ?>
            <?php echo $form->error($Personasnaturales,'PENA_FECHANACIMIENTO'); ?>
            </td>
	       </tr>
	      </table>
          </fieldset>
          </td>
	    </tr>
	  <tr>
	    <td>
        <h5>DATOS DE UBICACION</h5>
        <fieldset>
        <table width="100%" border="0">
	       <tr>
	        <td>
             <?php $criterio = array('order'=>'PAIS_NOMBRE'); ?>
             <?php echo $form->labelEx($Personas,'PAIS_ID'); ?>
			 <?php $data = CHtml::listData(Paises::model()->findAll($criterio),'PAIS_ID','PAIS_NOMBRE') ?>
             <?php echo $form->dropDownList($Personas,'PAIS_ID',$data, 
			                                array(
											      'ajax' => array(
                                                                  'type' => 'POST',
                                                                  'url' => CController::createUrl('mdlocasionales/personas/obtdepa'),
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
                                                                  'url' => CController::createUrl('mdlocasionales/personas/obtmuni'),
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
			'label'=>$Personasnaturales->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>