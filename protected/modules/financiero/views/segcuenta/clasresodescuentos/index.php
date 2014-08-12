<?php
$this->breadcrumbs=array(
	'Clasresodescuentoses',
);

$this->menu=array(
	array('label'=>'Create Clasresodescuentos','url'=>array('create')),
	array('label'=>'Manage Clasresodescuentos','url'=>array('admin')),
);
?>

<h1>Clasresodescuentoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
