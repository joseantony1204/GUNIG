<?php
$this->breadcrumbs=array(
	'Catedraticospresupuestoses',
);

$this->menu=array(
	array('label'=>'Create Catedraticospresupuestos','url'=>array('create')),
	array('label'=>'Manage Catedraticospresupuestos','url'=>array('admin')),
);
?>

<h1>Catedraticospresupuestoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
