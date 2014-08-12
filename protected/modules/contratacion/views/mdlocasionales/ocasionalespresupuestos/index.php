<?php
$this->breadcrumbs=array(
	'Ocasionalespresupuestoses',
);

$this->menu=array(
	array('label'=>'Create Ocasionalespresupuestos','url'=>array('create')),
	array('label'=>'Manage Ocasionalespresupuestos','url'=>array('admin')),
);
?>

<h1>Ocasionalespresupuestoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
