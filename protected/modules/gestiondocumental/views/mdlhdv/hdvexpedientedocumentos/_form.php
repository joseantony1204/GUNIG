<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'hdvexpedientedocumentos-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well','enctype' =>'multipart/form-data'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'HEXD_RUTA',array('rows'=>1, 'cols'=>50, 'class'=>'span4')); ?>
    
    <?php echo $form->labelEx($model,'HTDO_ID'); ?>
	<?php $data = CHtml::listData(Hdvtiposdocumentos::model()->findAll(),'HTDO_ID','HTDO_NOMBRE') ?>
    <?php echo $form->dropDownList($model,'HTDO_ID',$data, array('class'=>'span4','prompt'=>'Elije...')); ?>
    <?php echo $form->error($model,'HTDO_ID'); ?>
    
    <?php
    echo $form->labelEx($model, 'ARCHIVO');
    echo $form->fileField($model, 'ARCHIVO',array('class'=>'span5','maxlength'=>45,'size' =>57));
    echo $form->error($model, 'ARCHIVO');
    ?>

    <?php echo $form->textFieldRow($model,'HEXD_FECHAINGRESO',array('value'=>date("Y-m-d").' '.date("h:i:s"),)); ?>

	<?php echo $form->hiddenField($model,'PERS_ID',array('class'=>'span4')); ?>


	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'icon'=>'ok white',
			'type'=>'success',
			'size'=>'small',
			'label'=>$model->isNewRecord ? 'Subir Documento' : 'Actualizar Documento',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</td>
      
     </tr>
    </table>




