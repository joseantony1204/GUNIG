<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>
<?php
$this->breadcrumbs=array(
	'Acreditacionindicadores',
);

$this->menu=array(
	array('label'=>'Create acreditacionindicadores','url'=>array('create')),
	array('label'=>'Manage acreditacionindicadores','url'=>array('admin')),
);
?>

<h1>Acreditacionindicadores</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
