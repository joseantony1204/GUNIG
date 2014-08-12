<?php
$this->breadcrumbs=array(
	'Empresascorreoses',
);

$this->menu=array(
	array('label'=>'Create Empresascorreos','url'=>array('create')),
	array('label'=>'Manage Empresascorreos','url'=>array('admin')),
);
?>

<h1>Empresascorreoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
