<?php
$this->breadcrumbs=array(
	'Garantiases',
);

$this->menu=array(
	array('label'=>'Create Garantias','url'=>array('create')),
	array('label'=>'Manage Garantias','url'=>array('admin')),
);
?>

<h1>Garantiases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
