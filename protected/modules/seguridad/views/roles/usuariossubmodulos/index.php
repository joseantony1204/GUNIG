<?php
$this->breadcrumbs=array(
	'Usuariossubmoduloses',
);

$this->menu=array(
	array('label'=>'Create Usuariossubmodulos','url'=>array('create')),
	array('label'=>'Manage Usuariossubmodulos','url'=>array('admin')),
);
?>

<h1>Usuariossubmoduloses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
