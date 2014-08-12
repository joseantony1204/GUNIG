<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLPA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CLPA_ID),array('view','id'=>$data->CLPA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLPA_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->CLPA_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLOR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CLOR_ID); ?>
	<br />


</div>