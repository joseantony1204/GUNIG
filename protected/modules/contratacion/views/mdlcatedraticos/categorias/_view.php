<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CATE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CATE_ID),array('view','id'=>$data->CATE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CATE_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->CATE_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CATE_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->CATE_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CATE_VALORENLETRAS')); ?>:</b>
	<?php echo CHtml::encode($data->CATE_VALORENLETRAS); ?>
	<br />


</div>