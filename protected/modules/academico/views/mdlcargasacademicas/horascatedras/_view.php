<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOCA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->HOCA_ID),array('view','id'=>$data->HOCA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOCA_SEMANAL')); ?>:</b>
	<?php echo CHtml::encode($data->HOCA_SEMANAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TICD_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TICD_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOCA_ACUERDO')); ?>:</b>
	<?php echo CHtml::encode($data->HOCA_ACUERDO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOCA_INICIO')); ?>:</b>
	<?php echo CHtml::encode($data->HOCA_INICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOCA_FIN')); ?>:</b>
	<?php echo CHtml::encode($data->HOCA_FIN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HOCA_ESTADOS')); ?>:</b>
	<?php echo CHtml::encode($data->HOCA_ESTADOS); ?>
	<br />


</div>