<?php
$this->breadcrumbs=array(
	'Metodologiases',
);

$this->menu=array(
	array('label'=>'Create Metodologias','url'=>array('create')),
	array('label'=>'Manage Metodologias','url'=>array('admin')),
);
?>

<h1>Metodologiases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
