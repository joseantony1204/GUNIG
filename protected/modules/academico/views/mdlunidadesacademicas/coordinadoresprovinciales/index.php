<?php
$this->breadcrumbs=array(
	'Coordinadoresprovinciales',
);

$this->menu=array(
	array('label'=>'Create Coordinadoresprovinciales','url'=>array('create')),
	array('label'=>'Manage Coordinadoresprovinciales','url'=>array('admin')),
);
?>

<h1>Coordinadoresprovinciales</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
