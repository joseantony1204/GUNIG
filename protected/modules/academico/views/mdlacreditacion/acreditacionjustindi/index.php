<?php
$this->breadcrumbs=array(
	'Acreditacionjustindis',
);

$this->menu=array(
	array('label'=>'Create acreditacionjustindi','url'=>array('create')),
	array('label'=>'Manage acreditacionjustindi','url'=>array('admin')),
);
?>

<h1>Acreditacionjustindis</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
