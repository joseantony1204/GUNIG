<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tutorias-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>
	<?php echo $form->errorSummary($model); ?>
    <table width="100%" border="0">
	  <tr>
	    <td>
		<?php echo $form->labelEx($model,'SEDE_ID'); ?>
        <?php $data = CHtml::listData(Sedes::model()->findAll(),'SEDE_ID','SEDE_NOMBRE') ?>
        <?php echo $form->dropDownList($model,'SEDE_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
        <?php echo $form->error($model,'SEDE_ID'); ?>      
        </td>
	    <td>&nbsp;</td>
	    <td>
		<?php echo $form->labelEx($model,'TUSP_ID'); ?>
        <?php $data = CHtml::listData(Tutoriassubprogramas::model()->findAll(),'TUSP_ID','TUSP_NOMBRE') ?>
        <?php echo $form->dropDownList($model,'TUSP_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
        <?php echo $form->error($model,'TUSP_ID'); ?>        
        </td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>
        <?php echo $form->labelEx($model,'TUPR_ID'); ?> 
         <?php 
             $criteria=new CDbCriteria;
	      $anio = date("Y");
             $criteria->select='t.TUPR_ID, p.PRES_NOMBRE';
             $criteria->join = 'INNER JOIN TBL_PRESUPUESTOS  p ON t.PRES_ID = p.PRES_ID AND p.PRES_FECHA_INGRESO LIKE "'.$anio.'%"';
             $criteria->order = 't.TUPR_ID DESC'; 
             ?>
        <?php $data = CHtml::listData(Tutoriaspresupuestos::model()->findAll($criteria),'TUPR_ID','PRES_NOMBRE') ?>
        <?php echo $form->dropDownList($model,'TUPR_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
        <?php echo $form->error($model,'TUPR_ID'); ?>         
        </td>
	    <td>&nbsp;</td>
	    <td><?php echo $form->textFieldRow($model,'TUTO_PLAZO',array('class'=>'span4','maxlength'=>200)); ?></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td><?php echo $form->hiddenField($Tutoriascontratos,'TUCO_VALORHORA',array('class'=>'span1')); ?></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td><?php echo $form->textFieldRow($model,'TUTO_INTENSIDAD',array('class'=>'span2')); ?></td>
	    <td><?php echo $form->hiddenField($model,'TUCO_ID',array('class'=>'span5')); ?></td>
	    <td>&nbsp;<?php //echo $form->textFieldRow($model,'TUTO_VALOR',array('class'=>'span2','readonly'=>'readonly')); ?></td>
	    </tr>
	  </table>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$model->isNewRecord ? 'Continuar' : 'Actualizar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




