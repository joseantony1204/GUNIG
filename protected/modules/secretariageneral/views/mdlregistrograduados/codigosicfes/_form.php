<table border="0" width="100%">
     <tr>
      <td width="90%">         


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'codigosicfes-form',
	'enableAjaxValidation'=>false,
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,),
)); ?>

	<p class="note">Los campos marcados con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'COIC_CODIGO',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textAreaRow($model,'COIC_NORMA_APROBACION_UNIGUAJIRA',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'COIC_NORMA_APROBACION_ICFES',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'COIC_FECHA_VENCIMIENTO',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	  
    <?php echo $form->labelEx($model,'COIC_ESTADO'); ?>
    <?php echo $form->dropDownList($model,'COIC_ESTADO',array('1'=>'ACTIVO','0'=>'INACTIVO'),
	array('prompt'=>'Elije...','class'=>'span3')); ?>
    <?php echo $form->error($model,'COIC_ESTADO'); ?>
    

		     <?php echo $form->labelEx($model,'JORN_ID'); ?><?php $data5=Jornadas::model()->getListadoJornadas();?>
  <?php echo $form->dropDownList($model,'JORN_ID',$data5, array('class'=>'span2','prompt'=>'Selecciona el Metodologia...')); ?>
    <?php echo $form->error($model,'JORN_ID'); ?>
    
     <?php echo $form->labelEx($model,'METO_ID'); ?><?php $data4=Metodologias::model()->getListadoMetodologias();?>
  <?php echo $form->dropDownList($model,'METO_ID',$data4, array('class'=>'span2','prompt'=>'Selecciona el Metodologia...')); ?>
    <?php echo $form->error($model,'METO_ID'); ?>

	    
      <?php echo $form->labelEx($model,'TITU_ID'); ?><?php $data3=Titulos::model()->getListadoTitulos();?>
  <?php echo $form->dropDownList($model,'TITU_ID',$data3, array('class'=>'span2','prompt'=>'Selecciona el Titulo...')); ?>
    <?php echo $form->error($model,'TITU_ID'); ?>

	  <?php echo $form->labelEx($model,'PROG_ID'); ?><?php $data=Programas::model()->getListadoProgramas();?>
  <?php echo $form->dropDownList($model,'PROG_ID',$data, array('class'=>'span2','prompt'=>'Selecciona el Programa...')); ?>
    <?php echo $form->error($model,'PROG_ID'); ?>

	  <?php echo $form->labelEx($model,'SEDE_ID'); ?><?php $data2=Sedes::model()->getSedes();?>
  <?php echo $form->dropDownList($model,'SEDE_ID',$data2, array('class'=>'span2','prompt'=>'Selecciona la Sede...')); ?>
    <?php echo $form->error($model,'SEDE_ID'); ?>

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




