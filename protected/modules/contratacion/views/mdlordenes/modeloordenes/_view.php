<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->MOOR_ID),array('view','id'=>$data->MOOR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_OBJETO')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_OBJETO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_ANIOS')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_ANIOS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_MESES')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_MESES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_DIAS')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_DIAS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_ID); ?>
    
	<br />


</div>