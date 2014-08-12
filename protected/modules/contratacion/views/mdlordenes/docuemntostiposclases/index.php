<?php
$this->breadcrumbs=array(
	'Docuemntostiposclases',
);

$this->menu=array(
	array('label'=>'Create Docuemntostiposclases','url'=>array('create')),
	array('label'=>'Manage Docuemntostiposclases','url'=>array('admin')),
);
?>

<h1>Docuemntostiposclases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
