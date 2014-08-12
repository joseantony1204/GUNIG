<?php
$this->breadcrumbs=array(
	'Salariosminimoses',
);

$this->menu=array(
	array('label'=>'Create Salariosminimos','url'=>array('create')),
	array('label'=>'Manage Salariosminimos','url'=>array('admin')),
);
?>

<h1>Salariosminimoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
