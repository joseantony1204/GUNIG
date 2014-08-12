<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAAC_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CAAC_ID),array('view','id'=>$data->CAAC_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CACA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CACA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ASIG_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ASIG_ID); ?>
	<br />


</div>