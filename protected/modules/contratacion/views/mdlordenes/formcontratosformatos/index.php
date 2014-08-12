<?php
$this->breadcrumbs=array(
	'Formcontratosformatoses',
);

$this->menu=array(
	array('label'=>'Create Formcontratosformatos','url'=>array('create')),
	array('label'=>'Manage Formcontratosformatos','url'=>array('admin')),
);
?>

<h1>Formcontratosformatoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
