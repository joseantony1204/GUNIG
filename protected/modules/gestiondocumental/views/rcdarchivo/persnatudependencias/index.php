<?php
$this->breadcrumbs=array(
	'Persnatudependenciases',
);

$this->menu=array(
	array('label'=>'Create Persnatudependencias','url'=>array('create')),
	array('label'=>'Manage Persnatudependencias','url'=>array('admin')),
);
?>

<h1>Persnatudependenciases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
