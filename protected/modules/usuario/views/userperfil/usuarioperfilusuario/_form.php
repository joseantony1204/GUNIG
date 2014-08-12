<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'usersperfilesusuarios-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($Usuarioperfilusuario); ?>
    <?php echo $form->errorSummary($Usuario); ?>
<table width="100%" border="0">
  <tr>
    <td>
    <h5>DATOS DE BASICOS</h5>
        <fieldset>
    <table width="100%" border="0">
      <tr>
        <td><?php echo $form->textFieldRow($Usuario,'USUA_USUARIO',array('class'=>'span3')); ?></td>
        <td><?php echo $form->hiddenField($Usuario,'PENA_ID',array('class'=>'span3')); ?></td>
        <td>
          <?php if(($Usuario->USUA_CLAVE)!=''){
			   $Usuario->USUA_CLAVE =" ";
			  } 
	    ?>
          <?php echo $form->labelEx($Usuario,'USUA_CLAVE'); ?>
          <?php echo $form->passwordField($Usuario,'USUA_CLAVE',array('class'=>'span3')); ?>
          <?php echo $form->error($Usuario,'USUA_CLAVE'); ?>
          </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><?php echo $form->hiddenField($Usuarioperfilusuario,'USPE_ID',array('class'=>'span3')); ?></td>
      </tr>
      <tr>
        <td>
		<?php echo $form->labelEx($Usuario,'USES_ID'); ?>
        <?php $data = CHtml::listData(Usuarioestado::model()->findAll(),'USES_ID','USES_NOMBRE') ?>
        <?php echo $form->dropDownList($Usuario,'USES_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?> 
		<?php echo $form->error($Usuario,'USES_ID'); ?></td>
        <td>&nbsp;</td>
        <td><?php echo $form->labelEx($Usuario,'USUA_FECHAALTA'); ?>
          <?php
             if($Usuario->USUA_FECHAALTA=='') {
             $Usuario->USUA_FECHAALTA = date("Y-m-d").' '.date("h:i:s");
             }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$Usuario,
             'attribute'=>'USUA_FECHAALTA',
             'value'=>$Usuario->USUA_FECHAALTA,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$Usuario->USUA_FECHAALTA,
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
          <?php echo $form->error($Usuario,'USUA_FECHAALTA'); ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><?php echo $form->labelEx($Usuario,'USUA_FECHABAJA'); ?>
          <?php
             $Usuario->USUA_FECHABAJA = "0000-00-00 00:00:00";
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$Usuario,
             'attribute'=>'USUA_FECHABAJA',
             'value'=>$Usuario->USUA_FECHABAJA,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$Usuario->USUA_FECHABAJA,
             'dateFormat'=>'yy-mm-dd',
             'buttonImage'=>Yii::app()->baseUrl.'/images/date.png',
             'buttonImageOnly'=>true,
             'buttonText'=>'Fecha Salida',
             'selectOtherMonths'=>true,
             'showAnim'=>'slide',
             'showButtonPanel'=>true,
             'showOn'=>'button',
             'showOtherMonths'=>true,
             'changeMonth' => 'true',
             'changeYear' => 'true',
             ),
             )); ?>
          <?php echo $form->error($Usuario,'USUA_FECHABAJA'); ?></td>
        <td>&nbsp;</td>
        <td>
		<?php if(($Usuario->USUA_ULTIMOACCESO)==''){
			   $Usuario->USUA_ULTIMOACCESO ="0000-00-00 00:00:00";
			  } 
	    ?>
          <?php echo $form->textFieldRow($Usuario,'USUA_ULTIMOACCESO',array('class'=>'span2', 'readonly'=>'readonly')); ?></td>
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
			'label'=>$Usuarioperfilusuario->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>