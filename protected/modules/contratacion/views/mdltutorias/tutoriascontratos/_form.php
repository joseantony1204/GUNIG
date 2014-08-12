<?php date_default_timezone_set('America/Argentina/Buenos_Aires'); ?>
<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tutoriascontratos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>
<script type="text/javascript">
// Esperar a que se cargue todo el documento
$(document).ready(function(){
        // Al cambiar la opción del SELECT
        $('#Tutoriascontratos_TUFC_ID').change(function(){
                // Fijarse el valor de la opción seleccionada y activar/desactivar el input
                val = $(this).find('option:selected').val();
                if(val != 6){
                        // Desactivo el input
                        $('#Tutoriascontratos_TUCO_CUOTAADICIONAL').attr('readonly', 'readonly'); 
                        // READONLY Si no querés que se modifique pero que se envíe el valor al hacer SUBMIT
                        // Sino tendrías que hacer $('#inputcito').attr('disabled', 'disabled'); 
                } else {
                        $('#Tutoriascontratos_TUCO_CUOTAADICIONAL').removeAttr('readonly');  // O "disabled"
                }
        });
});
</script>
<span class="note"><?php echo $form->errorSummary($Tutoriascontratos); ?><?php echo $form->errorSummary($Contratos); ?></span>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>
	<table width="100%" border="0">
	  <tr>
	    <td>        
           <?php $criterio = array('order'=>'TICO_NOMBRE'); ?>
           <?php echo $form->labelEx($Contratos,'TICO_ID'); ?>
           <?php 
		      $data = CHtml::listData(Contratostipo::model()->findAll($criterio),'TICO_ID','TICO_NOMBRE');
              echo $form->dropDownList($Contratos,'TICO_ID',$data,
                        array(
                            'ajax' => array(
                             'type' => 'POST',
                             'url' => CController::createUrl('mdltutorias/tutoriascontratos/clasesc'),
                             'update' => '#'.CHtml::activeId($Contratos,'CLCO_ID'),
                            ),
							'prompt' => 'Seleccione un tipo contrato...',
							'class'=>'span3',
                  )
              );
        ?>
        <?php echo $form->error($Contratos,'TICO_ID'); ?>
  
        </td>
	    <td>&nbsp;</td>
	    <td>
		<?php echo $form->labelEx($Contratos,'CLCO_ID'); ?>
		<?php 
                $lista_uno = array();
                if(isset($Contratos->TICO_ID)){
                $id_uno = intval($Contratos->TICO_ID); 
                $lista_uno = CHtml::listData(Contratosclase::model()->findAll("TICO_ID = '$id_uno'"),'CLCO_ID','CLCO_NOMBRE');
                }
                echo $form->dropDownList($Contratos,'CLCO_ID',$lista_uno,
                        array(
						'class'=>'span3','prompt'=>'Seleccione tipo de contrato')
                        ); ?>
		<?php echo $form->error($Contratos,'CLCO_ID'); ?>    
        </td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td width="43%">
		<?php echo $form->hiddenField($Contratos,'PERS_ID',array('class'=>'span3')); ?>
        
        <?php
		echo $form->labelEx($Contratos, 'PERS_ID'); 
		echo $form->textField($Tutoriascontratos,'NOMBREPERSONA',array('readonly'=>"readonly",'class'=>'span4','disabled'=>'disabled')); ?>
        </td>
	    <td width="15%">&nbsp;</td>
	    <td width="42%">
        <?php 
		$criterio = new CDbCriteria;
		$criterio ->select = 't.PECO_ID, t.PENA_ID, pn.PENA_NOMBRES, pn.PENA_APELLIDOS';
		$criterio->join = '
        INNER JOIN TBL_PERSONASNATURALES pn ON t.PENA_ID = pn.PENA_ID
		AND (MONTH(t.PECO_FECHAINICIO) = '.date("m").' OR t.PECO_DESCRIPCION = "Rector")';
		$criterio->order = 'pn.PENA_NOMBRES ASC';    
       ?>
       
	   <?php 
	   echo $form->labelEx($Contratos, 'PECO_ID');
	   $data = CHtml::listData(Contratantes::model()->findAll($criterio),'PECO_ID','rel_personas_naturales.nombreCompleto') ?>
       <?php echo $form->dropDownList($Contratos,'PECO_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?>
       <?php echo $form->error($Contratos,'PECO_ID'); ?>
        </td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>
		<?php 
	    echo $form->labelEx($Tutoriascontratos, 'TUFC_ID');
		$criteria = new CDbCriteria;
	    $criteria->condition = 'TUFC_ID != 10 AND TUFC_ID != 11 ';
	    $data = CHtml::listData(Tutoriasformatoscontratos::model()->findAll($criteria),'TUFC_ID','TUFC_NOMBRE') 
	    ?>
          <?php echo $form->dropDownList($Tutoriascontratos,'TUFC_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?> 
		  <?php echo $form->error($Tutoriascontratos,'TUFC_ID'); ?></td>
	    <td>&nbsp;</td>
	    <td><?php 
	   $criterio = array('join'=>'WHERE t.PEAC_ESTADO = 0');  
	   echo $form->labelEx($Tutoriascontratos, 'PEAC_ID');
	   $data = CHtml::listData(Periodosacademicos::model()->findAll($criterio),'PEAC_ID','PEAC_NOMBRE') ?>
          <?php echo $form->dropDownList($Tutoriascontratos,'PEAC_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?> <?php echo $form->error($Tutoriascontratos,'PEAC_ID'); ?></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td><?php echo $form->hiddenField($Contratos,'CONT_NUMORDEN',array('class'=>'span3')); ?><?php echo $form->textFieldRow($Tutoriascontratos,'TUCO_VALORHORA',array('class'=>'span2')); ?></td>
	    <td>&nbsp;</td>
	    <td>
		<?php echo $form->textFieldRow($Tutoriascontratos,'TUCO_CUOTAADICIONAL',
		array('class'=>'span3', 'readonly'=>'readonly','value'=>0)); ?></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>
     <?php echo $form->labelEx($Contratos,'CONT_FECHAINICIO'); ?>
     <?php
     if ($Contratos->CONT_FECHAINICIO=='') {
     $Contratos->CONT_FECHAINICIO = date('Y-m-d');
     }else{
		 if ($Contratos->CONT_FECHAINICIO=='0000-00-00') {
		  $Contratos->CONT_FECHAINICIO = date('Y-m-d');
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Contratos,
     'attribute'=>'CONT_FECHAINICIO',
     'value'=>$Contratos->CONT_FECHAINICIO,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Contratos->CONT_FECHAINICIO,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Ingreso',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
          <?php echo $form->error($Contratos,'CONT_FECHAINICIO'); ?></td>
	    <td>&nbsp;</td>
	    <td>
	 <?php echo $form->labelEx($Contratos,'CONT_FECHAFINAL'); ?>
     <?php
     if ($Contratos->CONT_FECHAFINAL=='') {
     $Contratos->CONT_FECHAFINAL = '0000-00-00';
     }else{
		 if ($Contratos->CONT_FECHAFINAL=='0000-00-00') {
		  $Contratos->CONT_FECHAFINAL = '0000-00-00';
		  }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Contratos,
     'attribute'=>'CONT_FECHAFINAL',
     'value'=>$Contratos->CONT_FECHAFINAL,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Contratos->CONT_FECHAFINAL,
     'dateFormat'=>'yy-mm-dd',
     'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
     'buttonImageOnly'=>true,
     'buttonText'=>'Fecha Ingreso',
     'selectOtherMonths'=>true,
     'showAnim'=>'slide',
     'showButtonPanel'=>true,
     'showOn'=>'button',
     'showOtherMonths'=>true,
     'changeMonth' => 'true',
     'changeYear' => 'true',
     ),
     )); ?>
          <?php echo $form->error($Contratos,'CONT_FECHAFINAL'); ?>
          <?php $fecha = date("Y-m-d")." ".date("h:i:s"); ?>
          <?php echo $form->hiddenField($Contratos,'CONT_FECHAPROCESO',array('value'=>$fecha)); ?></td>
	    </tr>
	  </table>
	<p class="note">&nbsp;</p>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$Tutoriascontratos->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>