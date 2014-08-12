<?php
$this->breadcrumbs=array(
	'Penaraindestinos',
);

$this->menu=array(
	array('label'=>'Create Penaraindestino','url'=>array('create')),
	array('label'=>'Manage Penaraindestino','url'=>array('admin')),
);
?>

<h1>Penaraindestinos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
