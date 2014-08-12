<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PROD_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PROD_ID),array('view','id'=>$data->PROD_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PROD_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->PROD_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PROD_CANTIDAD')); ?>:</b>
	<?php echo CHtml::encode($data->PROD_CANTIDAD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PROD_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->PROD_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PROD_IVA')); ?>:</b>
	<?php echo CHtml::encode($data->PROD_IVA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_ID); ?>
	<br />


</div>