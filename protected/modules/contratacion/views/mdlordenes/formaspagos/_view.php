<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('FOPA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->FOPA_ID),array('view','id'=>$data->FOPA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FOPA_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->FOPA_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_ID); ?>
	<br />


</div>