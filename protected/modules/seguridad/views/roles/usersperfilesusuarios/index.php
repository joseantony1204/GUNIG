<?php
$this->breadcrumbs=array(
	'Usersperfilesusuarioses',
);

$this->menu=array(
	array('label'=>'Create Usersperfilesusuarios','url'=>array('create')),
	array('label'=>'Manage Usersperfilesusuarios','url'=>array('admin')),
);
?>

<h1>Usersperfilesusuarioses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
