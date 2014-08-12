<?php
$this->breadcrumbs=array(
	'Acreditacionpondcaras',
);

$this->menu=array(
	array('label'=>'Create acreditacionpondcara','url'=>array('create')),
	array('label'=>'Manage acreditacionpondcara','url'=>array('admin')),
);
?>

<h1>Acreditacionpondcaras</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
