<?php date_default_timezone_set('America/Argentina/Buenos_Aires'); ?>
<script type="text/javascript">
$(document).ready(function () {

$('#Opscontratos_OPCO_VALOR_MENSUAL').keyup(function() {
   var OPCO_VALOR_MENSUAL = parseInt($("#Opscontratos_OPCO_VALOR_MENSUAL").val());
   var OPCO_MESES = parseInt($("#Opscontratos_OPCO_MESES").val());
   var OPCO_DIAS = parseInt($("#Opscontratos_OPCO_DIAS").val());
   
   var resultado = parseInt((OPCO_VALOR_MENSUAL) *(OPCO_MESES)) + parseInt(((OPCO_VALOR_MENSUAL)/30)*(OPCO_DIAS)) ;
   $("#Opscontratos_VALORCONTRATO").val(resultado);
});

$('#Opscontratos_OPCO_MESES').keyup(function() {
   var OPCO_VALOR_MENSUAL = parseInt($("#Opscontratos_OPCO_VALOR_MENSUAL").val());
   var OPCO_MESES = parseInt($("#Opscontratos_OPCO_MESES").val());
   var OPCO_DIAS = parseInt($("#Opscontratos_OPCO_DIAS").val());
   
   var resultado = parseInt((OPCO_VALOR_MENSUAL) *(OPCO_MESES)) + parseInt(((OPCO_VALOR_MENSUAL)/30)*(OPCO_DIAS)) ;
   $("#Opscontratos_VALORCONTRATO").val(resultado);
});

$('#Opscontratos_OPCO_DIAS').keyup(function() {
   var OPCO_VALOR_MENSUAL = parseInt($("#Opscontratos_OPCO_VALOR_MENSUAL").val());
   var OPCO_MESES = parseInt($("#Opscontratos_OPCO_MESES").val());
   var OPCO_DIAS = parseInt($("#Opscontratos_OPCO_DIAS").val());
   
   var resultado = parseInt((OPCO_VALOR_MENSUAL) *(OPCO_MESES)) + parseInt(((OPCO_VALOR_MENSUAL)/30)*(OPCO_DIAS)) ;
   $("#Opscontratos_VALORCONTRATO").val(resultado);
});

 });	
</script>
<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'opscontratos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>
<span class="note"><?php echo $form->errorSummary($Opscontratos); ?></span>
<span class="note"><?php echo $form->errorSummary($Contratos); ?></span>
<span class="note"><?php echo $form->errorSummary($Formclasescontratos); ?></span>
<span class="note"><?php echo $form->errorSummary($Formcontratosformatos); ?></span>

<script type="text/javascript">
// Esperar a que se cargue todo el documento
$(document).ready(function(){
        // Al cambiar la opción del SELECT
        $('#Opscontratos_OPCO_VALOR_MENSUAL').change(function(){
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

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>
	<table width="100%" border="0">
	  <tr>
	    <td>        
           <?php echo $form->labelEx($Contratos,'TICO_ID'); ?>
           <?php 
              $criterio = new CDbCriteria; 
              $criterio->order = 'TICO_NOMBRE ASC';
           ?>
           <?php 
		      $data = CHtml::listData(Contratostipo::model()->findAll($criterio),'TICO_ID','TICO_NOMBRE');
              echo $form->dropDownList($Contratos,'TICO_ID',$data,
                        array(
                            'ajax' => array(
                             'type' => 'POST',
                             'url' => CController::createUrl('mdlops/opscontratos/clasesc'),
                             'update' => '#'.CHtml::activeId($Contratos,'CLCO_ID'),
                            ),
							'prompt' => 'Seleccione un tipo contrato...',
							'class'=>'span4',
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
						      'ajax' => array(
                                              'type' => 'POST',
                                              'url' => CController::createUrl('mdlops/opscontratos/formclcontrato'),
                                              'update' => '#'.CHtml::activeId($Formcontratosformatos,'FCCO_ID'),
                                              ),
							  'class'=>'span4',
							  'prompt'=>'Seleccione tipo de contrato')
                              ); 
		?>
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

		echo $form->textField($Opscontratos,'NOMBREPERSONA',array('readonly'=>"readonly",'class'=>'span4','disabled'=>'disabled')); ?>
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
	      <?php echo $form->dropDownList($Contratos,'PECO_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
	      <?php echo $form->error($Contratos,'PECO_ID'); ?>
	      </td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td><?php 
	   $criterio = array('join'=>'WHERE t.ANAC_ESTADO = 0');  
	   echo $form->labelEx($Opscontratos, 'ANAC_ID');
	   $data = CHtml::listData(Aniosacademicos::model()->findAll($criterio),'ANAC_ID','ANAC_NOMBRE') ?>
          <?php echo $form->dropDownList($Opscontratos,'ANAC_ID',$data, array('class'=>'span4',)); ?> <?php echo $form->error($Opscontratos,'PEAC_ID'); ?></td>
	    <td>&nbsp;</td>
	    <td>
		<?php echo $form->labelEx($Opscontratos,'DEPE_ID'); ?>
        <?php $criteria=new CDbCriteria; $criteria->order = 'DEPE_NOMBRE ASC'; ?>
        <?php $data = CHtml::listData(Dependencias::model()->findAll($criteria),'DEPE_ID','DEPE_NOMBRE') ?>
        <?php echo $form->dropDownList($Opscontratos,'DEPE_ID',$data, array('class'=>'span4','prompt'=>'Elije una dependencia...')); ?>
        <?php echo $form->error($Opscontratos,'DEPE_ID'); ?>
       </td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>
		<?php  echo $form->labelEx($Opscontratos,'OPOB_ID'); ?>
          <?php 
             $criteria=new CDbCriteria;
             $criteria->select='t.OBJE_ID, LEFT(t.OBJE_NOMBRE,120) AS OBJE_NOMBRE ';
             $criteria->join = 'INNER JOIN TBL_OPSOBJETOS  ob ON t.OBJE_ID = ob.OBJE_ID';	
             $criteria->order = 't.OBJE_NOMBRE ASC'; 
             ?>
          <?php $data = CHtml::listData(Objetos::model()->findAll($criteria),'OBJE_ID','OBJE_NOMBRE') ?>
          <?php echo $form->dropDownList($Opscontratos,'OPOB_ID',$data, array('class'=>'span4','prompt'=>'Elije un Objeto...')); ?> 
		  <?php echo $form->error($Opscontratos,'OPOB_ID');  ?>
          </td>
	    <td>&nbsp;</td>
	    <td>
        
        <?php echo $form->labelEx($Opscontratos,'OPPR_ID'); ?> 
         <?php 
             $criteria=new CDbCriteria;
			 $anio = date("Y");
             $criteria->select='t.OPPR_ID, p.PRES_NOMBRE';
             $criteria->join = 'INNER JOIN TBL_PRESUPUESTOS  p ON t.PRES_ID = p.PRES_ID AND t.OPPR_FECHA_INGRESO LIKE "'.$anio.'%"';	
             $criteria->order = 't.PRES_ID DESC'; 
             ?>
        <?php $data = CHtml::listData(Opspresupuestos::model()->findAll($criteria),'OPPR_ID','PRES_NOMBRE') ?>
        <?php echo $form->dropDownList($Opscontratos,'OPPR_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
        <?php echo $form->error($Opscontratos,'OPPR_ID'); ?>  
        
        </td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td><?php echo $form->textFieldRow($Opscontratos,'OPCO_VALOR_MENSUAL',array('class'=>'span3')); ?></td>
	    <td>&nbsp;</td>
	    <td><table width="100%" border="0">
	      <tr>
	        <td width="25%">DURACIÓN</td>
	        <td width="33%" align="center"><?php echo $form->textFieldRow($Opscontratos,'OPCO_MESES',array('class'=>'span1')); ?></td>
	        <td width="42%" align="center"><?php echo $form->textFieldRow($Opscontratos,'OPCO_DIAS',array('class'=>'span1','value'=>'0')); ?></td>
	        </tr>
	      </table></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>
		<?php echo $form->textFieldRow($Opscontratos,'VALORCONTRATO',
		     array('readonly'=>'readonly','class'=>'span3','disabled'=>'disabled')); 
		?>
        </td>
	    <td>&nbsp;</td>
	    <td><?php echo $form->labelEx($Formclasescontratos,'FCCO_NOMBRE'); ?>
          <?php 
                $lista_uno = array();
                if(isset($Contratos->CLCO_ID)){
                $id_uno = intval($Contratos->CLCO_ID); 
                $lista_uno = CHtml::listData(Formclasescontratos::model()->findAll("CLCO_ID = '$id_uno'"),'FCCO_ID','FCCO_NOMBRE');
                }
                echo $form->dropDownList($Formcontratosformatos,'FCCO_ID',$lista_uno,
                        array('class'=>'span4','prompt'=>'Seleccione una clase de contrato')
                        ); ?>
          <?php echo $form->error($Formcontratosformatos,'FCCO_ID'); ?></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td><?php echo $form->hiddenField($Contratos,'CONT_NUMORDEN',array('class'=>'span3')); ?></td>
	    <td>&nbsp;</td>
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
	    <td><?php echo $form->labelEx($Contratos,'CONT_FECHAFINAL'); ?>
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
          <?php $fecha = date("Y-m-d")." ".date("h:i:s  A"); ?>
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
			'label'=>$Opscontratos->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>