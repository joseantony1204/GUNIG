<?php
$this->breadcrumbs=array(
	'Religiones',
);

$this->menu=array(
	array('label'=>'Create Religiones','url'=>array('create')),
	array('label'=>'Manage Religiones','url'=>array('admin')),
);
?>

<h1>Religiones</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
