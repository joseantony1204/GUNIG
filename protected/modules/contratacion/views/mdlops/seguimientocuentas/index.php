<?php
$this->breadcrumbs=array(
	'Seguimientocuentases',
);

$this->menu=array(
	array('label'=>'Create Seguimientocuentas','url'=>array('create')),
	array('label'=>'Manage Seguimientocuentas','url'=>array('admin')),
);
?>

<h1>Seguimientocuentases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
