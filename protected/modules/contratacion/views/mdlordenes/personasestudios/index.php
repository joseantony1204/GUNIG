<?php
$this->breadcrumbs=array(
	'Personalestudioses',
);

$this->menu=array(
	array('label'=>'Create Personalestudios','url'=>array('create')),
	array('label'=>'Manage Personalestudios','url'=>array('admin')),
);
?>

<h1>Personalestudioses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
