<?php
$this->breadcrumbs=array(
	'Clasescontratoses',
);

$this->menu=array(
	array('label'=>'Create Clasescontratos','url'=>array('create')),
	array('label'=>'Manage Clasescontratos','url'=>array('admin')),
);
?>

<h1>Clasescontratoses</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
