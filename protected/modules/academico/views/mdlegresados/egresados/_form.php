<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'egresados-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<script>
	function ocultar_objeto(target_id){
					document.getElementById("Egresados_EGRE_CUAL").style.display='none';
					if(target_id=="Egresados_RELI_ID_2"){
						document.getElementById("Egresados_EGRE_CUAL").style.display='inherit';
						document.getElementById("Egresados_EGRE_CUAL").focus();
					}
			}	
	</script>


	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<table cellspacing="0" cellpadding="0">
  <col width="361" />
  <col width="345" />
  <tr height="20">
    <td height="20" width="361"><?php echo $form->textFieldRow($model,'EGRE_LIBRO',array('class'=>'span2')); ?></td>
    <td width="345"><?php echo $form->textFieldRow($model,'EGRE_FOLIO',array('class'=>'span2')); ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->textFieldRow($model,'EGRE_ACTAGRADO',array('class'=>'span2')); ?></td>
    <td><?php echo $form->textFieldRow($model,'EGRE_PRIMERNOMBRE',array('class'=>'span3','maxlength'=>40)); ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->textFieldRow($model,'EGRE_SEGUNDONOMBRE',array('class'=>'span3','maxlength'=>40)); ?></td>
    <td><?php echo $form->textFieldRow($model,'EGRE_PRIMERAPELLIDO',array('class'=>'span3','maxlength'=>40)); ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->textFieldRow($model,'EGRE_SEGUNDOAPELLIDO',array('class'=>'span3','maxlength'=>40)); ?></td>
    <td><?php echo $form->labelEx($model,'TIID_ID'); ?>
	<?php echo $form->dropDownList($model,'TIID_ID', CHtml::listData(Tiposidentificacion::model()->findAll(array('order'=>'TIID_NOMBRE')), 'TIID_ID','TIID_NOMBRE'), array('empty'=>'Elige...'));?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->textFieldRow($model,'EGRE_NUMEROIDENTIFICACION',array('class'=>'span3','maxlength'=>50)); ?></td>
    <td><?php echo $form->labelEx($model,'EGRE_FECHAEXPEDICION'); ?><?php
             if ($model->EGRE_FECHAEXPEDICION!='') {
             $model->EGRE_FECHAEXPEDICION = date('Y-m-d',strtotime($model->EGRE_FECHAEXPEDICION));
             }
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'EGRE_FECHAEXPEDICION',
             'value'=>$model->EGRE_FECHAEXPEDICION,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>'true',
             'defaultDate'=>$model->EGRE_FECHAEXPEDICION,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'seleccione la fecha',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => true,
             'changeYear' => true,
             ),
             )); ?></td>
  </tr> 
  <tr height="20">
    <td height="20"><?php echo $form->labelEx($model,'MUNI_IDCEDULA'); ?>
	<?php echo $form->dropDownList($model,'MUNI_IDCEDULA', CHtml::listData(Municipios::model()->findAll(array('order'=>'MUNI_NOMBRE')), 'MUNI_ID','MUNI_NOMBRE'), array('empty'=>'Elige...'));  ?></td>
    <td><?php $criterio = array('order'=>'PAIS_NOMBRE'); ?>
			 <?php echo $form->labelEx($model,'PAIS_ID'); ?>
			 <?php $data = CHtml::listData(Paises::model()->findAll($criterio),'PAIS_ID','PAIS_NOMBRE') ?>
             <?php echo $form->dropDownList($model,'PAIS_ID',$data, 
			                                array(
											      'ajax' => array(
                                                                  'type' => 'POST',
                                                                  'url' => CController::createUrl('mdlegresados/egresados/obtdepa'),
                                                                  'update' => '#'.CHtml::activeId($model,'DEPA_ID'),
                                                                  ),
												  'class'=>'span3',
											      'prompt'=>'Elije...',
												  )
											     ); 
			?>
             <?php echo $form->error($model,'PAIS_ID'); ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php $criterio = array('order'=>'DEPA_NOMBRE'); ?>
             <?php echo $form->labelEx($model,'DEPA_ID'); ?>
			 <?php
			 $lista_uno = array(); 
			 if(isset($model->PAIS_ID)){
                $id_uno = intval($model->PAIS_ID);
			    $lista_uno = CHtml::listData(Departamentos::model()->findAll("PAIS_ID = '$id_uno'",$criterio),'DEPA_ID','DEPA_NOMBRE');
			    }
			 ?>
             <?php echo $form->dropDownList($model,'DEPA_ID',$lista_uno, 
			                                array(
											      'ajax' => array(
                                                                  'type' => 'POST',
                                                                  'url' => CController::createUrl('mdlegresados/egresados/obtmuni'),
                                                                  'update' => '#'.CHtml::activeId($model,'MUNI_ID'),
                                                                  ),
												  'class'=>'span3',
											      'prompt'=>'Elije un pais...',
												  )
											     ); 
			?>
             <?php echo $form->error($model,'DEPA_ID'); ?></td>
    <td><?php $criterio = array('order'=>'MUNI_NOMBRE'); ?>
             <?php echo $form->labelEx($model,'MUNI_ID'); ?>
			 <?php 
			 $lista_uno = array();
			 if(isset($model->DEPA_ID)){
                $id_uno = intval($model->DEPA_ID);
			    $lista_uno = CHtml::listData(Municipios::model()->findAll("DEPA_ID = '$id_uno'",$criterio),'MUNI_ID','MUNI_NOMBRE');
			    }
			 ?>
   <?php echo $form->dropDownList($model,'MUNI_ID',$lista_uno, array('class'=>'span3','prompt'=>'Elije un departamento...')); ?>
             <?php echo $form->error($model,'MUNI_ID'); ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->labelEx($model,'EGRE_FECHANACIMIENTO'); ?><?php
             if ($model->EGRE_FECHANACIMIENTO!='') {
             $model->EGRE_FECHANACIMIENTO = date('Y-m-d',strtotime($model->EGRE_FECHANACIMIENTO));
             }
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$model,
             'attribute'=>'EGRE_FECHANACIMIENTO',
             'value'=>$model->EGRE_FECHANACIMIENTO,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span3'),
                 
             'options'=>array(
             'autoSize'=>'true',
             'defaultDate'=>$model->EGRE_FECHANACIMIENTO,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'seleccione la fecha',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => true,
             'changeYear' => true,
             ),
             )); ?></td>
    <td><?php echo $form->labelEx($model,'SEXO_ID'); ?>
	<?php echo $form->dropDownList($model,'SEXO_ID', CHtml::listData(Sexos::model()->findAll(array('order'=>'SEXO_ID')), 'SEXO_ID','SEXO_NOMBRE'), array('empty'=>'Elige...'));?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->textFieldRow($model,'EGRE_DIRECCION',array('class'=>'span3','maxlength'=>40)); ?></td>
    <td><?php echo $form->textFieldRow($model,'EGRE_BARRIO',array('class'=>'span3','maxlength'=>50)); ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->textFieldRow($model,'EGRE_TELEFONO',array('class'=>'span3')); ?></td>
    <td><?php echo $form->textFieldRow($model,'EGRE_EMAIL',array('class'=>'span3','maxlength'=>100)); ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->labelEx($model,'ESCI_ID'); ?>
	<?php echo $form->dropDownList($model,'ESCI_ID', CHtml::listData(Estadoscivil::model()->findAll(array('order'=>'ESCI_NOMBRE')), 'ESCI_ID','ESCI_NOMBRE'), array('empty'=>'Elige...'));  ?></td>
    <td><?php echo $form->labelEx($model,'COVU_ID'); ?>
	<?php echo $form->dropDownList($model,'COVU_ID', CHtml::listData(Condicionesvulnerables::model()->findAll(array('order'=>'COVU_NOMBRE')), 'COVU_ID','COVU_NOMBRE'), array('empty'=>'Elige...'));  ?></td>
  </tr>  
  <tr height="20">
    <td height="20"><?php $dato1 = CHtml::listData(Religiones::model()->findAll(), 'RELI_ID', 'RELI_NOMBRE');  ?>
      <?php echo	$form->radioButtonListInlineRow($model, 'RELI_ID', $dato1, array('onclick'=>'ocultar_objeto(id)')); ?> </td>
    <td><?php echo $form->textFieldRow($model,'EGRE_CUAL',array('class'=>'span3','maxlength'=>100, 'style'=>'display:none')); ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->labelEx($model,'EGRE_LABORA'); ?>
    <?php echo $form->dropDownList($model,'EGRE_LABORA',array('SI'=>'SI','NO'=>'NO'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'EGRE_LABORA'); ?></td>
    <td><?php echo $form->labelEx($model,'SELA_ID'); ?>
	<?php echo $form->dropDownList($model,'SELA_ID', CHtml::listData(Sectorlaboral::model()->findAll(array('order'=>'SELA_ID')), 'SELA_ID','SELA_NOMBRE'), array('empty'=>'Elige...'));  ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->textFieldRow($model,'EGRE_EMPRESALABORA',array('class'=>'span3','maxlength'=>200)); ?></td>
    <td><?php $criterio = array('order'=>'PROG_NOMBRE'); ?>
			 <?php echo $form->labelEx($model,'PROG_ID'); ?>
			 <?php $data = CHtml::listData(Programas::model()->findAll($criterio),'PROG_ID','PROG_NOMBRE') ?>
             <?php echo $form->dropDownList($model,'PROG_ID',$data, 
			                                array(
											      'ajax' => array(
                                                                  'type' => 'POST',
                                                                  'url' => CController::createUrl('mdlegresados/egresados/obtprosede'),
                                                                  'update' => '#'.CHtml::activeId($model,'PRSE_ID'),
                                                                  ),
												  'class'=>'span3',
											      'prompt'=>'Elije...',
												  )
											     ); 
			?>
             <?php echo $form->error($model,'PROG_ID'); ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php $criterio = array('order'=>'PRSE_ID'); ?>
             <?php echo $form->labelEx($model,'PRSE_ID'); ?>
			 <?php 
			 $lista_uno = array();
			 if(isset($model->PROG_ID)){
                $id_uno = intval($model->PROG_ID);
			    $lista_uno = CHtml::listData(Programassedes::model()->findAll("PROG_ID = '$id_uno'",$criterio),'PRSE_ID','PRSE_PROCONSECUTIVO');
			    }
			 ?>
   <?php echo $form->dropDownList($model,'PRSE_ID',array(), array('class'=>'span3','prompt'=>'Elije un programa...')); ?>
             <?php echo $form->error($model,'PRSE_ID'); ?></td>
    <td><?php echo $form->textFieldRow($model,'EGRE_CODIGOIES',array('value'=>1218,'readonly'=>"readonly",'class'=>'span3')); ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->labelEx($model,'DEPA_IDPROGRAMA'); ?>
	<?php echo $form->dropDownList($model,'DEPA_IDPROGRAMA', CHtml::listData(Departamentos::model()->findAll(array('order'=>'DEPA_NOMBRE')), 'DEPA_ID','DEPA_NOMBRE'), array('empty'=>'Elige...'));  ?></td>
    <td><?php echo $form->labelEx($model,'MUNI_IDPROGRAMA'); ?>
	<?php echo $form->dropDownList($model,'MUNI_IDPROGRAMA', CHtml::listData(Municipios::model()->findAll(array('order'=>'MUNI_NOMBRE')), 'MUNI_ID','MUNI_NOMBRE'), array('empty'=>'Elige...'));  ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->labelEx($model,'ANAC_ID'); ?>
	<?php echo $form->dropDownList($model,'ANAC_ID', CHtml::listData(Aniosacademicos::model()->findAll(array('order'=>'ANAC_NOMBRE')), 'ANAC_ID','ANAC_NOMBRE'), array('empty'=>'Elige...'));  ?></td>
    <td><?php echo $form->labelEx($model,'EGRE_SEMESTREINGRESO'); ?>
    <?php echo $form->dropDownList($model,'EGRE_SEMESTREINGRESO',array('01'=>'PRIMER SEMESTRE','02'=>'SEGUNDO SEMESTRE'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'EGRE_SEMESTREINGRESO'); ?></td>
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->labelEx($model,'EGRE_TRANSFERENCIA'); ?>
    <?php echo $form->dropDownList($model,'EGRE_TRANSFERENCIA',array('01'=>'SI','02'=>'NO'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'EGRE_TRANSFERENCIA'); ?></td>
    <td><?php echo $form->textFieldRow($model,'EGRE_TRABAJOGRADO',array('class'=>'span3','maxlength'=>400)); ?></td>
  </tr>  
  <tr height="20">
    <td height="20"><?php echo $form->labelEx($model,'FEGR_ID'); ?>
	<?php echo $form->dropDownList($model,'FEGR_ID', CHtml::listData(Fechasgrados::model()->findAll(array('order'=>'FEGR_FECHA')), 'FEGR_ID','FEGR_FECHA'), array('empty'=>'Elige...'));?></td>
    <td><?php echo $form->textFieldRow($model,'EGRE_ANIOREPORTE',array('value'=>date('Y'),'readonly'=>"readonly",'class'=>'span3')); ?></td>
  </tr> 
  <tr height="20">
    <td height="20"><?php echo $form->labelEx($model,'EGRE_SEMESTREREPORTE'); ?>
    <?php echo $form->dropDownList($model,'EGRE_SEMESTREREPORTE',array('01'=>'PRIMER SEMESTRE','02'=>'SEGUNDO SEMESTRE'),
	array('prompt'=>'Elije...','class'=>'span3')); ?><?php echo $form->error($model,'EGRE_SEMESTREREPORTE'); ?></td>
    <td><?php echo $form->textFieldRow($model,'EGRE_ECAES',array('class'=>'span3','maxlength'=>40)); ?></td>    
  </tr>
  <tr height="20">
    <td height="20"><?php echo $form->textFieldRow($model,'EGRE_RESULTADOECAES',array('class'=>'span3')); ?></td>
    <td><?php echo $form->textFieldRow($model,'EGRE_OBSERVACIONESECAES',array('value'=>'ninguna','class'=>'span3','maxlength'=>200)); ?></td>
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




