<?php
$this->breadcrumbs=array(
	'Aniosacademicoses',
);

$this->menu=array(
	array('label'=>'Create Aniosacademicos','url'=>array('create')),
	array('label'=>'Manage Aniosacademicos','url'=>array('admin')),
);
?>

<h1>Aniosacademicoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
