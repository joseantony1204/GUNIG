<?php
$this->breadcrumbs=array(
	'Usuarioperfilusuarios',
);

$this->menu=array(
	array('label'=>'Create Usuarioperfilusuario','url'=>array('create')),
	array('label'=>'Manage Usuarioperfilusuario','url'=>array('admin')),
);
?>

<h1>Usuarioperfilusuarios</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
