<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'tiposdocumentosvencen-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
    
    <?php 
	
	$criterio = array('select'=>'t.TIDO_ID, t.TIDO_NOMBRE',
	                  'join'=>' WHERE  t.TIDO_ID NOT IN (SELECT tdv.TIDO_ID FROM TBL_TIPOSDOCUMENTOSVENCEN tdv)',
					  'order'=>'TIDO_NOMBRE ASC');
					  
	$data=Tiposdocumentos::model()->findAll($criterio);    
	$list = CHtml::listData($data,'TIDO_ID', 'TIDO_NOMBRE'); 				      
    ?>
       
	<?php echo $form->labelEx($model,'TIDO_ID'); ?>
    <?php $data = $list; ?>
    <?php echo $form->dropDownList($model,'TIDO_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
    <?php echo $form->error($model,'TIDO_ID'); ?>

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




