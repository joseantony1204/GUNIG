<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FACU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FACU_ID),array('view','id'=>$data->FACU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FACU_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->FACU_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEDE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->SEDE_ID); ?>
	<br />


</div>