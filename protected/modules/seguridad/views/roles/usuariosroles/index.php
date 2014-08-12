<?php
$this->breadcrumbs=array(
	'Usuariosroles',
);

$this->menu=array(
	array('label'=>'Create Usuariosroles','url'=>array('create')),
	array('label'=>'Manage Usuariosroles','url'=>array('admin')),
);
?>

<h1>Usuariosroles</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
