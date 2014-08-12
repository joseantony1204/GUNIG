<?php
$this->breadcrumbs=array(
	'Rectores',
);

$this->menu=array(
	array('label'=>'Create Rectores','url'=>array('create')),
	array('label'=>'Manage Rectores','url'=>array('admin')),
);
?>

<h1>Rectores</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
