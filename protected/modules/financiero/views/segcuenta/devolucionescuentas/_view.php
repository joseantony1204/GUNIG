<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DECU_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DECU_ID),array('view','id'=>$data->DECU_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DECU_MOTIVO')); ?>:</b>
	<?php echo CHtml::encode($data->DECU_MOTIVO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DECU_FECHADEVOLUCION')); ?>:</b>
	<?php echo CHtml::encode($data->DECU_FECHADEVOLUCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIDO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TIDO_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SECU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->SECU_ID); ?>
	<br />


</div>