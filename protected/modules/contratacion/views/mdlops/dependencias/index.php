<?php
$this->breadcrumbs=array(
	'Dependenciases',
);

$this->menu=array(
	array('label'=>'Create Dependencias','url'=>array('create')),
	array('label'=>'Manage Dependencias','url'=>array('admin')),
);
?>

<h1>Dependenciases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
