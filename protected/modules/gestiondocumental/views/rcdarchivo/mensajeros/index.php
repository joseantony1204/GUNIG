<?php
$this->breadcrumbs=array(
	'Mensajeroses',
);

$this->menu=array(
	array('label'=>'Create Mensajeros','url'=>array('create')),
	array('label'=>'Manage Mensajeros','url'=>array('admin')),
);
?>

<h1>Mensajeroses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
