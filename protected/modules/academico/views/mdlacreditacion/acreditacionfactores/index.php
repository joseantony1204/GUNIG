<?php Yii::app()->homeUrl = array('/academico/acreditacioncpanel/index');  ?>

<?php 
$this->breadcrumbs=array(
	'Factores'=>array('index'),
	'Crear',
);
?>
<div id="objetodiv">
			
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
				'id'=>'recaudos-form',
				'enableAjaxValidation'=>false,
				'type'=>'vertical',
				'htmlOptions'=>array('class'=>'well'),
				'enableClientValidation'=>true,
				'clientOptions'=>array(
				'validateOnSubmit'=>true,),
			)); ?>
		<?php echo $form->errorSummary(array($model)); ?>
			<h4 align="center" style="font-family:Arial, Helvetica, sans-serif">FACTORES</h4>
		<?php  $this->widget('zii.widgets.jui.CJuiTabs', array(  //la clve del array es considerada el label de la pestaña
				'tabs'=> $pestanas , 
				'options'=>array(
					'collapsible'=>true,
					'selected'=>0,
				),
				'htmlOptions'=>array(
					'style'=>'width:100%;'
				),
			)); 		
		?>
	<?php $this->endWidget(); ?>

	</div>
	


