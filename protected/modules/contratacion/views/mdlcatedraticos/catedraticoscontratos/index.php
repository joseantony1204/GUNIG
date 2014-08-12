<?php
$this->breadcrumbs=array(
	'Catedraticoscontratoses',
);

$this->menu=array(
	array('label'=>'Create Catedraticoscontratos','url'=>array('create')),
	array('label'=>'Manage Catedraticoscontratos','url'=>array('admin')),
);
?>

<h1>Catedraticoscontratoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
