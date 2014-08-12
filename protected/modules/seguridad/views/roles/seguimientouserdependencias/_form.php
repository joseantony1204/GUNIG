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

	<?php echo $form->errorSummary($Usersperfilesusuarios); ?>
    <?php echo $form->errorSummary($Users); ?>
    <?php echo $form->errorSummary($Seguimientouserdependencias); ?>
<table width="100%" border="0">
  <tr>
    <td>
    <h5>DATOS DE BASICOS</h5>
        <fieldset>
    <table width="100%" border="0">
      <tr>
        <td colspan="2">
     <?php 
    $criterio = array('order'=>'PENA_NOMBRES ASC');
    $data=Personasnaturales::model()->findAll($criterio);    
    $list = CHtml::listData($data,'PENA_ID', 'nombreCompleto'); 
    
    echo $form->labelEx($Users, 'PENA_ID');
    $this->widget('ext.select2.ESelect2',array(
      'name'=>'PENA_ID',
      'data'=>$list,
      'value'=>$list->PENA_ID,
      'attribute'=>'PENA_ID',
      'options'=>array(
        'placeholder'=>'Buscar registro en la base de datos',
        'allowClear'=>true,
        'width'=>'320px',
      ),
    )); ?>
        </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><?php echo $form->textFieldRow($Users,'USUA_USUARIO',array('class'=>'span3')); ?></td>
        <td>&nbsp;</td>
        <td>
		<?php if(($Users->USUA_CLAVE)!=''){
			   $Users->USUA_CLAVE =" ";
			  } 
	    ?>
        <?php echo $form->labelEx($Users,'USUA_CLAVE'); ?>
		<?php echo $form->passwordField($Users,'USUA_CLAVE',array('class'=>'span3')); ?>
        <?php echo $form->error($Users,'USUA_CLAVE'); ?>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>
		<?php echo $form->labelEx($Users,'USES_ID'); ?>
        <?php $data = CHtml::listData(Usuariosestados::model()->findAll(),'USES_ID','USES_NOMBRE') ?>
        <?php echo $form->dropDownList($Users,'USES_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?> 
		<?php echo $form->error($Users,'USES_ID'); ?></td>
        <td>&nbsp;</td>
        <td><?php echo $form->labelEx($Users,'USUA_FECHAALTA'); ?>
          <?php
             if($Users->USUA_FECHAALTA=='') {
             $Users->USUA_FECHAALTA = date("Y-m-d").' '.date("h:i:s");
             }
			 
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$Users,
             'attribute'=>'USUA_FECHAALTA',
             'value'=>$Users->USUA_FECHAALTA,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$Users->USUA_FECHAALTA,
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
          <?php echo $form->error($Users,'USUA_FECHAALTA'); ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><?php echo $form->labelEx($Users,'USUA_FECHABAJA'); ?>
          <?php
             $Users->USUA_FECHABAJA = "0000-00-00 00:00:00";
             $this->widget('zii.widgets.jui.CJuiDatePicker', array(
             'model'=>$Users,
             'attribute'=>'USUA_FECHABAJA',
             'value'=>$Users->USUA_FECHABAJA,
             'language' => 'es',
             'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
                 
             'options'=>array(
             'autoSize'=>true,
             'defaultDate'=>$Users->USUA_FECHABAJA,
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
          <?php echo $form->error($Users,'USUA_FECHABAJA'); ?></td>
        <td>&nbsp;</td>
        <td>
		<?php if(($Users->USUA_ULTIMOACCESO)==''){
			   $Users->USUA_ULTIMOACCESO ="0000-00-00 00:00:00";
			  } 
	    ?>
          <?php echo $form->textFieldRow($Users,'USUA_ULTIMOACCESO',array('class'=>'span2', 'readonly'=>'readonly')); ?></td>
      </tr>
    </table>
    </fieldset>
    
    </td>
    </tr>
  <tr>
    <td>
        <fieldset>
    <table width="100%" border="0">
      <tr>
        <td><h5>ASIGNACIÓN DEL PERFIL DE USUARIO</h5></td>
        <td>&nbsp;</td>
        <td><h5>ASIGNACIÓN DE LA DEPENDENCIA</h5></td>
      </tr>
      <tr>
        <td>
        <?php echo $form->labelEx($Usersperfilesusuarios,'USPE_ID'); ?>
		<?php $data = CHtml::listData(Usuariosperfiles::model()->findAll(),'USPE_ID','USPE_NOMBRE') ?>
        <?php echo $form->dropDownList($Usersperfilesusuarios,'USPE_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?>
        <?php echo $form->error($Usersperfilesusuarios,'USPE_ID'); ?>
        </td>
        <td>
		 <?php echo $form->hiddenField($Usersperfilesusuarios,'USPU_FECHAINGRESO',array('value'=>date("Y-m-d").' '.date("h:i:s"))); ?>
        </td>
        <td>
		<?php echo $form->labelEx($Seguimientouserdependencias,'DEPE_ID'); ?>
		<?php $data = CHtml::listData(Dependencias::model()->findAll(),'DEPE_ID','DEPE_NOMBRE') ?>
        <?php echo $form->dropDownList($Seguimientouserdependencias,'DEPE_ID',$data, array('class'=>'span3','prompt'=>'Elije...')); ?>
        <?php echo $form->error($Seguimientouserdependencias,'DEPE_ID'); ?>
        </td>
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
			'label'=>$Seguimientouserdependencias->isNewRecord ? 'Crear' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>