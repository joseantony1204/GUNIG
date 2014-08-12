<?php
$this->breadcrumbs=array(
	'Necesidades',
);

$this->menu=array(
	array('label'=>'Create Necesidades','url'=>array('create')),
	array('label'=>'Manage Necesidades','url'=>array('admin')),
);
?>

<h1>Necesidades</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
