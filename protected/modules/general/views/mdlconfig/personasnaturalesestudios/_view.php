<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PENE_ID),array('view','id'=>$data->PENE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENE_LUGAR')); ?>:</b>
	<?php echo CHtml::encode($data->PENE_LUGAR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEES_FECHACULMINACION')); ?>:</b>
	<?php echo CHtml::encode($data->PEES_FECHACULMINACION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESTU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ESTU_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESES_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ESES_ID); ?>
	<br />


</div>