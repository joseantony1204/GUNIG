<?php
$this->breadcrumbs=array(
	'Tutoriases',
);

$this->menu=array(
	array('label'=>'Create Tutorias','url'=>array('create')),
	array('label'=>'Manage Tutorias','url'=>array('admin')),
);
?>

<h1>Tutoriases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
