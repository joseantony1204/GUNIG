<?php
$this->breadcrumbs=array(
	'Resolucionesdescuentoses',
);

$this->menu=array(
	array('label'=>'Create Resolucionesdescuentos','url'=>array('create')),
	array('label'=>'Manage Resolucionesdescuentos','url'=>array('admin')),
);
?>

<h1>Resolucionesdescuentoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
