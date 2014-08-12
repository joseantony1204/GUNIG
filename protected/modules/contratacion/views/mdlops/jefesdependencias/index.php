<?php
$this->breadcrumbs=array(
	'Jefesdependenciases',
);

$this->menu=array(
	array('label'=>'Create Jefesdependencias','url'=>array('create')),
	array('label'=>'Manage Jefesdependencias','url'=>array('admin')),
);
?>

<h1>Jefesdependenciases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
