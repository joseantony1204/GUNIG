<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CONT_ID),array('view','id'=>$data->CONT_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUCO_VALOR_HORA')); ?>:</b>
	<?php echo CHtml::encode($data->TUCO_VALOR_HORA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUCO_CUOTA_ADICIONAL')); ?>:</b>
	<?php echo CHtml::encode($data->TUCO_CUOTA_ADICIONAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEAC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PEAC_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUFC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TUFC_ID); ?>
	<br />


</div>