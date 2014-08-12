<?php
$this->breadcrumbs=array(
	'Invitadoses',
);

$this->menu=array(
	array('label'=>'Create Invitados','url'=>array('create')),
	array('label'=>'Manage Invitados','url'=>array('admin')),
);
?>

<h1>Invitadoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
