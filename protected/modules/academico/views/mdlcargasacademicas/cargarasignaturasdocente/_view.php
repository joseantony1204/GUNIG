<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAAD_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CAAD_ID),array('view','id'=>$data->CAAD_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRCA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PRCA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ASIG_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ASIG_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CAAD_NUMUMERO_GRUPOS')); ?>:</b>
	<?php echo CHtml::encode($data->CAAD_NUMUMERO_GRUPOS); ?>
	<br />


</div>