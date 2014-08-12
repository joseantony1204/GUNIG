<?php
$this->breadcrumbs=array(
	'Decanoses',
);

$this->menu=array(
	array('label'=>'Create Decanos','url'=>array('create')),
	array('label'=>'Manage Decanos','url'=>array('admin')),
);
?>

<h1>Decanoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
