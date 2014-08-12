<?php
$this->breadcrumbs=array(
	'Precargasacademicases',
);

$this->menu=array(
	array('label'=>'Create Precargasacademicas','url'=>array('create')),
	array('label'=>'Manage Precargasacademicas','url'=>array('admin')),
);
?>

<h1>Precargasacademicases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
