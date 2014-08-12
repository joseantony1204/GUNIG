<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CONT_ID),array('view','id'=>$data->CONT_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OPCO_VALOR_MENSUAL')); ?>:</b>
	<?php echo CHtml::encode($data->OPCO_VALOR_MENSUAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OPCO_MESES')); ?>:</b>
	<?php echo CHtml::encode($data->OPCO_MESES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OPCO_DIAS')); ?>:</b>
	<?php echo CHtml::encode($data->OPCO_DIAS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OBJE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->OBJE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEPE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DEPE_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ANAC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ANAC_ID); ?>
	<br />

	*/ ?>

</div>