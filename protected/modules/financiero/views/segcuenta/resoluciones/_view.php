<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('RESO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RESO_ID),array('view','id'=>$data->RESO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RESO_NUMERO')); ?>:</b>
	<?php echo CHtml::encode($data->RESO_NUMERO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RESO_FECHASUSCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->RESO_FECHASUSCRIPCION); ?>
	<br />

	

	<b><?php echo CHtml::encode($data->getAttributeLabel('RESO_CONCEPTO')); ?>:</b>
	<?php echo CHtml::encode($data->RESO_CONCEPTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RESO_FECHAPROCESO')); ?>:</b>
	<?php echo CHtml::encode($data->RESO_FECHAPROCESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CLRE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CLRE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ANAC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ANAC_ID); ?>
	<br />

	*/ ?>

</div>