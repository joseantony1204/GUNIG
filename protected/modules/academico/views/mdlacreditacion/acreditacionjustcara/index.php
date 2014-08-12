<?php
$this->breadcrumbs=array(
	'Acreditacionjustcaras',
);

$this->menu=array(
	array('label'=>'Create acreditacionjustcara','url'=>array('create')),
	array('label'=>'Manage acreditacionjustcara','url'=>array('admin')),
);
?>

<h1>Acreditacionjustcaras</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
