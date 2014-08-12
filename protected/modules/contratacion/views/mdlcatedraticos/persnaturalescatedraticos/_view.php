<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENC_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PENC_ID),array('view','id'=>$data->PENC_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENC_FECHAINGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->PENC_FECHAINGRESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENC_CATEGORIA')); ?>:</b>
	<?php echo CHtml::encode($data->PENC_CATEGORIA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENC_VALORCATEGORIA')); ?>:</b>
	<?php echo CHtml::encode($data->PENC_VALORCATEGORIA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CATE_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CATE_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PENA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PENA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEAC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PEAC_ID); ?>
	<br />


</div>