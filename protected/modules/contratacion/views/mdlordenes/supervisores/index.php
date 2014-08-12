<?php
$this->breadcrumbs=array(
	'Supervisores',
);

$this->menu=array(
	array('label'=>'Create Supervisores','url'=>array('create')),
	array('label'=>'Manage Supervisores','url'=>array('admin')),
);
?>

<h1>Supervisores</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
