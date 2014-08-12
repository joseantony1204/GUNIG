<?php
$this->breadcrumbs=array(
	'Devolucionescuentases',
);

$this->menu=array(
	array('label'=>'Create Devolucionescuentas','url'=>array('create')),
	array('label'=>'Manage Devolucionescuentas','url'=>array('admin')),
);
?>

<h1>Devolucionescuentases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
