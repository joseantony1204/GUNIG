<?php
$this->breadcrumbs=array(
	'Clausulases',
);

$this->menu=array(
	array('label'=>'Create Clausulas','url'=>array('create')),
	array('label'=>'Manage Clausulas','url'=>array('admin')),
);
?>

<h1>Clausulases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
