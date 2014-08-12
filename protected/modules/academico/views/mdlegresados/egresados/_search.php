<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'type'=>'vertical',
	'htmlOptions'=>array('class'=>'well'),
)); ?>

	<?php echo $form->textFieldRow($model,'EGRE_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_LIBRO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_FOLIO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_PRIMERNOMBRE',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'EGRE_SEGUNDONOMBRE',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'EGRE_PRIMERAPELLIDO',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'EGRE_SEGUNDOAPELLIDO',array('class'=>'span5','maxlength'=>40)); ?>
	
	<?php echo $form->textFieldRow($model,'EGRE_DIRECCION',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'EGRE_ACTAGRADO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_NUMEROIDENTIFICACION',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'FEGR_ID',array('class'=>'span5')); ?>
	
	<?php echo $form->textFieldRow($model,'DEPA_IDPROGRAMA',array('class'=>'span5')); ?>
	
	<?php echo $form->textFieldRow($model,'MUNI_IDPROGRAMA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_TRABAJOGRADO',array('class'=>'span5','maxlength'=>400)); ?>

	<?php echo $form->textFieldRow($model,'EGRE_CODIGOIES',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'ANAC_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_SEMESTREINGRESO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_TRANSFERENCIA',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'EGRE_ANIOREPORTE',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_SEMESTREREPORTE',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_ECAES',array('class'=>'span5','maxlength'=>40)); ?>

	<?php echo $form->textFieldRow($model,'EGRE_RESULTADOECAES',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_FECHANACIMIENTO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_TELEFONO',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_EMAIL',array('class'=>'span5','maxlength'=>100)); ?>

	<?php echo $form->textFieldRow($model,'EGRE_LABORA',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'DEPA_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'MUNI_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'MUNI_IDCEDULA',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'EGRE_EMPRESALABORA',array('class'=>'span5','maxlength'=>200)); ?>

	<?php echo $form->textFieldRow($model,'TIID_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PAIS_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'PRSE_ID',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'SELA_ID',array('class'=>'span5','maxlength'=>2)); ?>

	<?php echo $form->textFieldRow($model,'SEXO_ID',array('class'=>'span5','maxlength'=>2)); ?>

	<?php echo $form->textFieldRow($model,'ESCI_ID',array('class'=>'span5','maxlength'=>2)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'success',
			'label'=>'Busqueda',
			'icon'=>'search white',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
