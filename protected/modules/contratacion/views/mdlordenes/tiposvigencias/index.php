<?php
$this->breadcrumbs=array(
	'Tiposvigenciases',
);

$this->menu=array(
	array('label'=>'Create Tiposvigencias','url'=>array('create')),
	array('label'=>'Manage Tiposvigencias','url'=>array('admin')),
);
?>

<h1>Tiposvigenciases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
