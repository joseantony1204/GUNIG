<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUEN_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CUEN_ID),array('view','id'=>$data->CUEN_ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUEN_NUMERO')); ?>:</b>
	<?php echo CHtml::encode($data->CUEN_NUMERO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUEN_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->CUEN_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CUEN_FECHAINGRESO')); ?>:</b>
	<?php echo CHtml::encode($data->CUEN_FECHAINGRESO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIPA_ID')); ?>:</b>
	<?php echo CHtml::encode($data->TIPA_ID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONT_ID')); ?>:</b>
	<?php echo CHtml::encode($data->CONT_ID); ?>
	<br />


</div>