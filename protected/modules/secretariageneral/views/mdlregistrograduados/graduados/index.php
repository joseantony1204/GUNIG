<?php
$this->breadcrumbs=array(
	'Graduadoses',
);

$this->menu=array(
	array('label'=>'Create Graduados','url'=>array('create')),
	array('label'=>'Manage Graduados','url'=>array('admin')),
);
?>

<h1>Graduadoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
