<?php
$this->breadcrumbs=array(
	'Descuentoses',
);

$this->menu=array(
	array('label'=>'Create Descuentos','url'=>array('create')),
	array('label'=>'Manage Descuentos','url'=>array('admin')),
);
?>

<h1>Descuentoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
