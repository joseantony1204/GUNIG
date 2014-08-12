<?php date_default_timezone_set('America/Argentina/Buenos_Aires'); ?>
<script type="text/javascript">
$(document).ready(function () {

$('#Contratosadicionales_COAD_VALOR').keyup(function() {
   var COAD_VALOR = parseInt($("#Contratosadicionales_COAD_VALOR").val());
   var COAD_MESES = parseInt($("#Contratosadicionales_COAD_MESES").val());
   var COAD_DIAS = parseInt($("#Contratosadicionales_COAD_DIAS").val());
   
   var resultado = parseInt((COAD_VALOR) *(COAD_MESES)) + parseInt(((COAD_VALOR)/30)*(COAD_DIAS)) ;
   $("#Contratosadicionales_VALORCONTRATO").val(resultado);
});

$('#Contratosadicionales_COAD_MESES').keyup(function() {
   var COAD_VALOR = parseInt($("#Contratosadicionales_COAD_VALOR").val());
   var COAD_MESES = parseInt($("#Contratosadicionales_COAD_MESES").val());
   var COAD_DIAS = parseInt($("#Contratosadicionales_COAD_DIAS").val());
   
   var resultado = parseInt((COAD_VALOR) *(COAD_MESES)) + parseInt(((COAD_VALOR)/30)*(COAD_DIAS)) ;
   $("#Contratosadicionales_VALORCONTRATO").val(resultado);
});

$('#Contratosadicionales_COAD_DIAS').keyup(function() {
   var COAD_VALOR = parseInt($("#Contratosadicionales_COAD_VALOR").val());
   var COAD_MESES = parseInt($("#Contratosadicionales_COAD_MESES").val());
   var COAD_DIAS = parseInt($("#Contratosadicionales_COAD_DIAS").val());
   
   var resultado = parseInt((COAD_VALOR) *(COAD_MESES)) + parseInt(((COAD_VALOR)/30)*(COAD_DIAS)) ;
   $("#Contratosadicionales_VALORCONTRATO").val(resultado);
});

 });	
</script>
<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'contratosadicionales-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>
<?php echo $form->errorSummary($Contratosadicionales); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>
	<table width="100%" border="1">
	  <tr>
	    <td width="42%">
	      <h5>DATOS PARA CREAR EL ADICIONAL DEL CONTRATO</h5>
	      <fieldset>
	        <table width="100%" border="0">
	          <tr>
	            <td width="42%" align="left">
	              <?php echo $form->textFieldRow($Contratosadicionales,'COAD_NUMADICIONAL',array('class'=>'span1','maxlength'=>3)); ?></td>
	            <td width="19%" align="left">&nbsp;</td>
	            <td width="39%" colspan="2" align="left">&nbsp;</td>
	            </tr>
	          <tr>
	            <td align="left">&nbsp;</td>
	            <td align="left">&nbsp;</td>
	            <td colspan="2" align="left">&nbsp;</td>
	            </tr>
	          <tr>
	            <td align="left"><?php echo $form->textFieldRow($Contratosadicionales,'COAD_VALOR',array('class'=>'span2')); ?></td>
	            <td align="left">&nbsp;</td>
	            <td align="left"><?php echo $form->textFieldRow($Contratosadicionales,'COAD_MESES',array('class'=>'span1')); ?></td>
	            <td align="left"><?php echo $form->textFieldRow($Contratosadicionales,'COAD_DIAS',array('class'=>'span1')); ?></td>
	            </tr>
	          <tr>
	            <td align="left">&nbsp;</td>
	            <td align="left">&nbsp;</td>
	            <td colspan="2" align="left">&nbsp;</td>
	            </tr>
	          <tr>
	            <td align="left">
	              <?php echo $form->textFieldRow($Contratosadicionales,'VALORCONTRATO',
			 array('readonly'=>'readonly','class'=>'span2','disabled'=>'disabled'));
			 ?>
	              </td>
	            <td align="left">
	              <?php echo $form->hiddenField($Contratosadicionales,'COAD_FECHAPROCESO',array('value'=>date("Y-m-d")." ".date("h:i:s  A"))); ?></td>
	            <td colspan="2" align="left">
	              <?php echo $form->labelEx($Contratosadicionales,'COAD_FECHAELABORACION'); ?>
	              <?php
     if ($Contratosadicionales->COAD_FECHAELABORACION=='') {
     $Contratosadicionales->COAD_FECHAELABORACION = date('Y-m-d');
     }else{
		   if ($Contratosadicionales->COAD_FECHAELABORACION=='0000-00-00') {
		    $Contratosadicionales->COAD_FECHAELABORACION = date('Y-m-d');
		   }
		  }
     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
     'model'=>$Contratosadicionales,
     'attribute'=>'COAD_FECHAELABORACION',
     'value'=>$Contratosadicionales->COAD_FECHAELABORACION,
     'language' => 'es',
     'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
         
     'options'=>array(
     'autoSize'=>true,
     'defaultDate'=>$Contratosadicionales->COAD_FECHAELABORACION,
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
	              <?php echo $form->error($Contratosadicionales,'COAD_FECHAELABORACION'); ?>
	              </td>
	            </tr>
	          <tr>
	            <td align="left">&nbsp;</td>
	            <td align="left">&nbsp;</td>
	            <td colspan="2" align="left">&nbsp;</td>
	            </tr>
	          <tr>
	            <td align="left"><?php echo $form->labelEx($Contratosadicionales,'TIAD_ID'); ?>
	              <?php $criteria=new CDbCriteria; $criteria->order = 'TIAD_NOMBRE ASC'; ?>
	              <?php $data = CHtml::listData(Tiposadicionales::model()->findAll($criteria),'TIAD_ID','TIAD_NOMBRE') ?>
	              <?php echo $form->dropDownList($Contratosadicionales,'TIAD_ID',$data, array('class'=>'span3','prompt'=>'Elige...')); ?> 
	              <?php echo $form->error($Contratosadicionales,'TIAD_ID'); ?></td>
	            <td align="left"><?php echo $form->hiddenField($Contratosadicionales,'CONT_ID',array('class'=>'span5')); ?></td>
	            <td colspan="2" align="left"><?php echo $form->labelEx($Contratosadicionales,'ADPR_ID'); ?>
	              <?php 
             $criteria=new CDbCriteria;
			 $anio = date("Y");
             $criteria->select='t.ADPR_ID, p.PRES_NOMBRE';
             $criteria->join = 'INNER JOIN TBL_PRESUPUESTOS  p ON t.PRES_ID = p.PRES_ID AND t.ADPR_FECHA_INGRESO LIKE "'.$anio.'%"';	
             $criteria->order = 't.PRES_ID DESC'; 
             ?>
	              <?php $data = CHtml::listData(Adicionalespresupuestos::model()->findAll($criteria),'ADPR_ID','PRES_NOMBRE') ?>
	              <?php echo $form->dropDownList($Contratosadicionales,'ADPR_ID',$data, array('class'=>'span4','prompt'=>'Elige...')); ?> 
	              <?php echo $form->error($Contratosadicionales,'ADPR_ID'); ?></td>
	            </tr>
	          <tr>
	            <td align="left">&nbsp;</td>
	            <td align="left">&nbsp;</td>
	            <td colspan="2" align="left">&nbsp;</td>
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
			'label'=>$Contratosadicionales->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




