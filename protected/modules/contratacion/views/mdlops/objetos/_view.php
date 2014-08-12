<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('OBJE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->OBJE_ID),array('view','id'=>$data->OBJE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OBJE_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->OBJE_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OBJE_FECHA_INGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->OBJE_FECHA_INGRESO); ?>
	<br />


</div>