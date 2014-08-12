<?php
$this->breadcrumbs=array(
	'Penaraexes',
);

$this->menu=array(
	array('label'=>'Create Penaraex','url'=>array('create')),
	array('label'=>'Manage Penaraex','url'=>array('admin')),
);
?>

<h1>Penaraexes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
