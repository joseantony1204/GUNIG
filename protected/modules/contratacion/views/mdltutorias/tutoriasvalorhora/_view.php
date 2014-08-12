<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUVH_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TUVH_ID),array('view','id'=>$data->TUVH_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUVH_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->TUVH_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUVH_ANIO')); ?>:</b>
	<?php echo CHtml::encode($data->TUVH_ANIO); ?>
	<br />


</div>