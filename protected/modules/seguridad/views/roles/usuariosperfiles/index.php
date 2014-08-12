<?php
$this->breadcrumbs=array(
	'Usuariosperfiles',
);

$this->menu=array(
	array('label'=>'Create Usuariosperfiles','url'=>array('create')),
	array('label'=>'Manage Usuariosperfiles','url'=>array('admin')),
);
?>

<h1>Usuariosperfiles</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
