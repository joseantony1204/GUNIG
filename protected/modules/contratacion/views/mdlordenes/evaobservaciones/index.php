<?php
$this->breadcrumbs=array(
	'Evaobservaciones',
);

$this->menu=array(
	array('label'=>'Create Evaobservaciones','url'=>array('create')),
	array('label'=>'Manage Evaobservaciones','url'=>array('admin')),
);
?>

<h1>Evaobservaciones</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
