<?php
$this->breadcrumbs=array(
	'Usuariosvistases',
);

$this->menu=array(
	array('label'=>'Create Usuariosvistas','url'=>array('create')),
	array('label'=>'Manage Usuariosvistas','url'=>array('admin')),
);
?>

<h1>Usuariosvistases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
