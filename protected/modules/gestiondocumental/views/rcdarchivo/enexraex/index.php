<?php
$this->breadcrumbs=array(
	'Enexraexes',
);

$this->menu=array(
	array('label'=>'Create Enexraex','url'=>array('create')),
	array('label'=>'Manage Enexraex','url'=>array('admin')),
);
?>

<h1>Enexraexes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
