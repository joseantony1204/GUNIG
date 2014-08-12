<?php
$this->breadcrumbs=array(
	'Resoluciones',
);

$this->menu=array(
	array('label'=>'Create Resoluciones','url'=>array('create')),
	array('label'=>'Manage Resoluciones','url'=>array('admin')),
);
?>

<h1>Resoluciones</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
