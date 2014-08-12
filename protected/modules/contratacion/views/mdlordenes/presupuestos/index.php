<?php
$this->breadcrumbs=array(
	'Presupuestoses',
);

$this->menu=array(
	array('label'=>'Create Presupuestos','url'=>array('create')),
	array('label'=>'Manage Presupuestos','url'=>array('admin')),
);
?>

<h1>Presupuestoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
