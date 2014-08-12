<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('EERE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->EERE_ID),array('view','id'=>$data->EERE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAEX_ID')); ?>:</b>
	<?php echo CHtml::encode($data->RAEX_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ENEX_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ENEX_ID); ?>
	<br />


</div>