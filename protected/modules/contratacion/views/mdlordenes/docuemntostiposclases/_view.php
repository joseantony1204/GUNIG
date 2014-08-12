<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DOTC_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DOTC_ID),array('view','id'=>$data->DOTC_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DOCU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DOCU_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TICO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TICO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLCO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CLCO_ID); ?>
	<br />


</div>