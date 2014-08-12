<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('GARA_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->GARA_ID),array('view','id'=>$data->GARA_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GARA_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->GARA_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GARA_ANIO')); ?>:</b>
	<?php echo CHtml::encode($data->GARA_ANIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GARA_MES')); ?>:</b>
	<?php echo CHtml::encode($data->GARA_MES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GARA_PORCENTAJE')); ?>:</b>
	<?php echo CHtml::encode($data->GARA_PORCENTAJE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GARA_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->GARA_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MOOR_ID')); ?>:</b>
	<?php echo CHtml::encode($data->MOOR_ID); ?>
	<br />


</div>