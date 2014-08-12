<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAPR_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CAPR_ID),array('view','id'=>$data->CAPR_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRES_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PRES_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAPR_FECHAINGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->CAPR_FECHAINGRESO); ?>
	<br />


</div>