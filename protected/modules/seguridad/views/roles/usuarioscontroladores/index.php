<?php
$this->breadcrumbs=array(
	'Usuarioscontroladores',
);

$this->menu=array(
	array('label'=>'Create Usuarioscontroladores','url'=>array('create')),
	array('label'=>'Manage Usuarioscontroladores','url'=>array('admin')),
);
?>

<h1>Usuarioscontroladores</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
