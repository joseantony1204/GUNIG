<?php
$this->breadcrumbs=array(
	'Folioses',
);

$this->menu=array(
	array('label'=>'Create Folios','url'=>array('create')),
	array('label'=>'Manage Folios','url'=>array('admin')),
);
?>

<h1>Folioses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
