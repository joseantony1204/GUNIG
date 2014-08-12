<?php
$this->breadcrumbs=array(
	'Modeloordenes',
);

$this->menu=array(
	array('label'=>'Create Modeloordenes','url'=>array('create')),
	array('label'=>'Manage Modeloordenes','url'=>array('admin')),
);
?>

<h1>Modeloordenes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
