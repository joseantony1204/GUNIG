<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>
<?php
$this->breadcrumbs=array(
	'Bitacoras',
);

$this->menu=array(
	array('label'=>'Create acreditacionbitacoras','url'=>array('create')),
	array('label'=>'Manage acreditacionbitacoras','url'=>array('admin')),
);
?>

<h1>Bitacoras de Acreditación</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
