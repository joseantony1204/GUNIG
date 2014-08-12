<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIRE_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->LIRE_ID),array('view','id'=>$data->LIRE_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIRE_CONCEPTO')); ?>:</b>
	<?php echo CHtml::encode($data->LIRE_CONCEPTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIRE_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->LIRE_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LIRE_FECHA')); ?>:</b>
	<?php echo CHtml::encode($data->LIRE_FECHA); ?>
	<br />


</div>