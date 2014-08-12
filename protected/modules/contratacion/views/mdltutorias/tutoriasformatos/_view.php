<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUFC_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TUFC_ID),array('view','id'=>$data->TUFC_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUFC_NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->TUFC_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TUFC_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->TUFC_DESCRIPCION); ?>
	<br />


</div>