<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('OCPR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->OCPR_ID),array('view','id'=>$data->OCPR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FACU_ID')); ?>:</b>
	<?php echo CHtml::encode($data->FACU_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OCPR_FECHAINGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->OCPR_FECHAINGRESO); ?>
	<br />


</div>