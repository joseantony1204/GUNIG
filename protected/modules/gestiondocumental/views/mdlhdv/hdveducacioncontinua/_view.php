<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('HECO_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->HECO_ID),array('view','id'=>$data->HECO_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HECO_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->HECO_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HECO_RUTA')); ?>:</b>
	<?php echo CHtml::encode($data->HECO_RUTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('HECO_FECHATERMINACION')); ?>:</b>
	<?php echo CHtml::encode($data->HECO_FECHATERMINACION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PERS_ID')); ?>:</b>
	<?php echo CHtml::encode($data->PERS_ID); ?>
	<br />


</div>