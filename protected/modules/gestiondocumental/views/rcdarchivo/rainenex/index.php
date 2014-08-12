<?php
$this->breadcrumbs=array(
	'Rainenexes',
);

$this->menu=array(
	array('label'=>'Create Rainenex','url'=>array('create')),
	array('label'=>'Manage Rainenex','url'=>array('admin')),
);
?>

<h1>Rainenexes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
