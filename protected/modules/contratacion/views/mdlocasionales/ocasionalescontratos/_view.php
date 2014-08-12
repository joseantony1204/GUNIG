<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('OCCO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->OCCO_ID),array('view','id'=>$data->OCCO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OCCO_RESOLUCION')); ?>:</b>
	<?php echo CHtml::encode($data->OCCO_RESOLUCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OCCO_MESES')); ?>:</b>
	<?php echo CHtml::encode($data->OCCO_MESES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OCCO_DIAS')); ?>:</b>
	<?php echo CHtml::encode($data->OCCO_DIAS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OCCO_FECHAPROCESO')); ?>:</b>
	<?php echo CHtml::encode($data->OCCO_FECHAPROCESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OCCO_VALORMENSUAL')); ?>:</b>
	<?php echo CHtml::encode($data->OCCO_VALORMENSUAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OCPR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->OCPR_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('PECO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PECO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENO_ID); ?>
	<br />

	*/ ?>

</div>