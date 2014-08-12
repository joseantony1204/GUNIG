<?php
$this->breadcrumbs=array(
	'Presupuestosordenes',
);

$this->menu=array(
	array('label'=>'Create Presupuestosordenes','url'=>array('create')),
	array('label'=>'Manage Presupuestosordenes','url'=>array('admin')),
);
?>

<h1>Presupuestosordenes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
