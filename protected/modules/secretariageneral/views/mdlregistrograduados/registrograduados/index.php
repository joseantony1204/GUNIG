<?php
$this->breadcrumbs=array(
	'Registrograduadoses',
);

$this->menu=array(
	array('label'=>'Create Registrograduados','url'=>array('create')),
	array('label'=>'Manage Registrograduados','url'=>array('admin')),
);
?>

<h1>Registrograduadoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
