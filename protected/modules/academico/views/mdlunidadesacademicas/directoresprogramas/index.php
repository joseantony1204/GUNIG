<?php
$this->breadcrumbs=array(
	'Directoresprogramases',
);

$this->menu=array(
	array('label'=>'Create Directoresprogramas','url'=>array('create')),
	array('label'=>'Manage Directoresprogramas','url'=>array('admin')),
);
?>

<h1>Directoresprogramases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
