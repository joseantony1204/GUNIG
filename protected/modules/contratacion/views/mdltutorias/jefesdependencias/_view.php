<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('JEDE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->JEDE_ID),array('view','id'=>$data->JEDE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_IDENTIFICACION')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_IDENTIFICACION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEPE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->DEPE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('JEDE_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->JEDE_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('JEDE_FECHAINICIO')); ?>:</b>
	<?php echo CHtml::encode($data->JEDE_FECHAINICIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('JEDE_FECHAFINAL')); ?>:</b>
	<?php echo CHtml::encode($data->JEDE_FECHAFINAL); ?>
	<br />


</div>