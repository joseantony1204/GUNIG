<?php
$this->breadcrumbs=array(
	'Semestralesps',
);

$this->menu=array(
	array('label'=>'Create Semestralesp','url'=>array('create')),
	array('label'=>'Manage Semestralesp','url'=>array('admin')),
);
?>

<h1>Semestralesps</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
