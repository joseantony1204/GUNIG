<?php
$this->breadcrumbs=array(
	'Personasnaturalesestudioses',
);

$this->menu=array(
	array('label'=>'Create Personasnaturalesestudios','url'=>array('create')),
	array('label'=>'Manage Personasnaturalesestudios','url'=>array('admin')),
);
?>

<h1>Personasnaturalesestudioses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
