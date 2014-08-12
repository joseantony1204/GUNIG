<?php
$this->breadcrumbs=array(
	'Opsobjetoses',
);

$this->menu=array(
	array('label'=>'Create Opsobjetos','url'=>array('create')),
	array('label'=>'Manage Opsobjetos','url'=>array('admin')),
);
?>

<h1>Opsobjetoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
