<?php
$this->breadcrumbs=array(
	'Tutoriasvalorhoras',
);

$this->menu=array(
	array('label'=>'Create Tutoriasvalorhora','url'=>array('create')),
	array('label'=>'Manage Tutoriasvalorhora','url'=>array('admin')),
);
?>

<h1>Tutoriasvalorhoras</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
