<?php
$this->breadcrumbs=array(
	'Seguimientouserdependenciases',
);

$this->menu=array(
	array('label'=>'Create Seguimientouserdependencias','url'=>array('create')),
	array('label'=>'Manage Seguimientouserdependencias','url'=>array('admin')),
);
?>

<h1>Seguimientouserdependenciases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
