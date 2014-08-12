<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACPO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ACPO_ID),array('view','id'=>$data->ACPO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACPO_GRUPO1')); ?>:</b>
	<?php echo CHtml::encode($data->ACPO_GRUPO1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACPO_GRUPO2')); ?>:</b>
	<?php echo CHtml::encode($data->ACPO_GRUPO2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACPO_GRUPO3')); ?>:</b>
	<?php echo CHtml::encode($data->ACPO_GRUPO3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACPO_GRUPO4')); ?>:</b>
	<?php echo CHtml::encode($data->ACPO_GRUPO4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACPO_GRUPO5')); ?>:</b>
	<?php echo CHtml::encode($data->ACPO_GRUPO5); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACCA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ACCA_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ACPO_FECHA')); ?>:</b>
	<?php echo CHtml::encode($data->ACPO_FECHA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USUA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->USUA_ID); ?>
	<br />

	*/ ?>

</div>