<?php
$this->breadcrumbs=array(
	'Acreditacionjustfacts',
);

$this->menu=array(
	array('label'=>'Create acreditacionjustfact','url'=>array('create')),
	array('label'=>'Manage acreditacionjustfact','url'=>array('admin')),
);
?>

<h1>Acreditacionjustfacts</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
