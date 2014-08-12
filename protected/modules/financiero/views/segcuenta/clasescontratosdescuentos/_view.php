<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CCDE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CCDE_ID),array('view','id'=>$data->CCDE_ID)); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('CLCO_ID')); ?>:</b>
	<?php echo CHtml::encode($data->cLCO->CLCO_NOMBRE); ?>
	<br />


	<b><?php echo CHtml::encode($data->getAttributeLabel('DESC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->dESC->DESC_NOMBRE); ?>
	<br />


</div>