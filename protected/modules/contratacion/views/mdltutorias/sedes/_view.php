<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEDE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SEDE_ID),array('view','id'=>$data->SEDE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SEDE_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->SEDE_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UNIV_ID')); ?>:</b>
	<?php echo CHtml::encode($data->UNIV_ID); ?>
	<br />


</div>