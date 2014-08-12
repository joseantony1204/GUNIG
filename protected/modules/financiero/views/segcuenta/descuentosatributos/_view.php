<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEAT_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DEAT_ID),array('view','id'=>$data->DEAT_ID)); ?>
	<br />
    
    <b><?php echo CHtml::encode($data->getAttributeLabel('DEAT_CODIGO')); ?>:</b>
    <?php echo CHtml::encode($data->DEAT_CODIGO); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEAT_DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->DEAT_DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEAT_DESDE')); ?>:</b>
	<?php echo CHtml::encode($data->DEAT_DESDE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEAT_HASTA')); ?>:</b>
	<?php echo CHtml::encode($data->DEAT_HASTA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DEAT_VALOR')); ?>:</b>
	<?php echo CHtml::encode($data->DEAT_VALOR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->dESC->DESC_NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ANAC_ID')); ?>:</b>
	<?php echo CHtml::encode($data->ANAC_ID); ?>
	<br />


</div>