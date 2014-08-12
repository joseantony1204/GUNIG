<?php
$this->breadcrumbs=array(
	'Tiposdocumentosvencens',
);

$this->menu=array(
	array('label'=>'Create Tiposdocumentosvencen','url'=>array('create')),
	array('label'=>'Manage Tiposdocumentosvencen','url'=>array('admin')),
);
?>

<h1>Tiposdocumentosvencens</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
