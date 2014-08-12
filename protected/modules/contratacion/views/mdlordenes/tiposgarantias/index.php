<?php
$this->breadcrumbs=array(
	'Tiposgarantiases',
);

$this->menu=array(
	array('label'=>'Create Tiposgarantias','url'=>array('create')),
	array('label'=>'Manage Tiposgarantias','url'=>array('admin')),
);
?>

<h1>Tiposgarantiases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
