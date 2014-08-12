<?php
$this->breadcrumbs=array(
	'Usuariosmoduloses',
);

$this->menu=array(
	array('label'=>'Create Usuariosmodulos','url'=>array('create')),
	array('label'=>'Manage Usuariosmodulos','url'=>array('admin')),
);
?>

<h1>Usuariosmoduloses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
