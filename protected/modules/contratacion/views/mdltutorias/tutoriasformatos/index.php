<?php
$this->breadcrumbs=array(
	'Tutoriasformatoses',
);

$this->menu=array(
	array('label'=>'Create Tutoriasformatos','url'=>array('create')),
	array('label'=>'Manage Tutoriasformatos','url'=>array('admin')),
);
?>

<h1>Tutoriasformatoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
