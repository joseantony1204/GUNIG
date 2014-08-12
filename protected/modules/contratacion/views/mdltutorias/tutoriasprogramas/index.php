<?php
$this->breadcrumbs=array(
	'Tutoriasprogramases',
);

$this->menu=array(
	array('label'=>'Create Tutoriasprogramas','url'=>array('create')),
	array('label'=>'Manage Tutoriasprogramas','url'=>array('admin')),
);
?>

<h1>Tutoriasprogramases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
