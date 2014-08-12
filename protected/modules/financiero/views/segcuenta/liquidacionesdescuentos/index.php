<?php
$this->breadcrumbs=array(
	'Liquidacionesdescuentoses',
);

$this->menu=array(
	array('label'=>'Create Liquidacionesdescuentos','url'=>array('create')),
	array('label'=>'Manage Liquidacionesdescuentos','url'=>array('admin')),
);
?>

<h1>Liquidacionesdescuentoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
