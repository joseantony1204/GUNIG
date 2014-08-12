<?php
$this->breadcrumbs=array(
	'Catedraticoscatedrases',
);

$this->menu=array(
	array('label'=>'Create Catedraticoscatedras','url'=>array('create')),
	array('label'=>'Manage Catedraticoscatedras','url'=>array('admin')),
);
?>

<h1>Catedraticoscatedrases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
