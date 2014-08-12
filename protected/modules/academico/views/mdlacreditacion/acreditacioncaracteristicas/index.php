<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>
<?php
$this->breadcrumbs=array(
	'Acreditacioncaracteristicases',
);

$this->menu=array(
	array('label'=>'Create acreditacioncaracteristicas','url'=>array('create')),
	array('label'=>'Manage acreditacioncaracteristicas','url'=>array('admin')),
);
?>

<h1>Acreditacioncaracteristicases</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
