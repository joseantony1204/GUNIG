<?php
$this->breadcrumbs=array(
	'Horascatedrases',
);

$this->menu=array(
	array('label'=>'Create Horascatedras','url'=>array('create')),
	array('label'=>'Manage Horascatedras','url'=>array('admin')),
);
?>

<h1>Horascatedrases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
