<?php
$this->breadcrumbs=array(
	'Nivelesestudioses',
);

$this->menu=array(
	array('label'=>'Create Nivelesestudios','url'=>array('create')),
	array('label'=>'Manage Nivelesestudios','url'=>array('admin')),
);
?>

<h1>Nivelesestudioses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
