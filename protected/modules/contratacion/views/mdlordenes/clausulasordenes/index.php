<?php
$this->breadcrumbs=array(
	'Clausulasordenes',
);

$this->menu=array(
	array('label'=>'Create Clausulasordenes','url'=>array('create')),
	array('label'=>'Manage Clausulasordenes','url'=>array('admin')),
);
?>

<h1>Clausulasordenes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
