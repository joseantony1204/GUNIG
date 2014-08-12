<?php
$this->breadcrumbs=array(
	'Acreditacionpondindis',
);

$this->menu=array(
	array('label'=>'Create acreditacionpondindi','url'=>array('create')),
	array('label'=>'Manage acreditacionpondindi','url'=>array('admin')),
);
?>

<h1>Acreditacionpondindis</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
