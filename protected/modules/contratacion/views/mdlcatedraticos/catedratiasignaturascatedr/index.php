<?php
$this->breadcrumbs=array(
	'Catedratiasignaturascatedrs',
);

$this->menu=array(
	array('label'=>'Create Catedratiasignaturascatedr','url'=>array('create')),
	array('label'=>'Manage Catedratiasignaturascatedr','url'=>array('admin')),
);
?>

<h1>Catedratiasignaturascatedrs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
