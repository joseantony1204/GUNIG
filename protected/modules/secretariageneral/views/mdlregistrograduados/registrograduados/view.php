<?php
$this->breadcrumbs=array(
	'Modulo Secretaria General'=>array('/secretariageneral/'),
	'Panel Registro Graduados'=>array('registrograduadoscpanel/'),
	'Registro Graduados'=>array('admin'),
	'ver',
);
?>

<table width="70%" border="1" align="left" class="" style="white-space-collapse:collapse">
  <tr>
    <td><table width="820" border="0" align="center">
      <tr>
        <td width="60" align="left"><?php 			 
			 $imageUrl = Yii::app()->request->baseUrl . '/images/secretariageneral/registrograduados.png';
			  echo $image = CHtml::image($imageUrl); 
			  ?>  </td>
        <td width="498" align="left"><strong style="border-bottom-style:groove">VISUALIZACIÒN DE REGISTROS [ REGISTROGRADUADOS : Detalles ] </strong></td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/registrograduados/admin',),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/refrescar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/registrograduados/view','id'=>$model->REGR_ID),$htmlOptions ); 
?>         
		 </td>
        <td width="80" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/edit.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Creaciòn de registros');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlregistrograduados/registrograduados/update','id'=>$model->REGR_ID),$htmlOptions ); 
?>         
		 </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
    <?php $rectores=new Rectores;
		  $Secretarios=new Secretariosgenerales;
		  $Decanos=new Decanos; 
		  $folios=new Folios;
		  $fechas= new Fechasgrados;
		  $tutilos= new Titulos;
		    $graduados=new Graduados;

         $rectores=new Rectores;
		  
		 
		   $graduados=new Graduados;
		   $titulostrabajos=new Titulostrabajosgrados;
		   $nivele=new Nivelesestudios;
		   $facultades=new Facultades;
		   $programas=new Programas;
		   $sedes=new Sedes;
		   $jornadas=new Jornadas;
		   $sexos=new Sexos;
		 
?>
    
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
			
		
		array(
		'name' =>$model->getAttributeLabel('LIBR_ID'),
		'value'=>$model->LIBR_ID,
		),
		array(
		'name' =>$model->getAttributeLabel('FOLI_ID'),
		'value'=>$folios->getFolio($model->FOLI_ID),
		),
		array(
		'name' =>$model->getAttributeLabel('REGR_ACTA'),
		'value'=>$model->REGR_ACTA,
		),
		array(
		'name' =>$model->getAttributeLabel('FEGR_ID'),
		'value'=>Yii::app()->dateformatter->format("dd-MM-yyyy",$fechas->FechaGrado($model->FEGR_ID)),
		),
		
		array(
		'name' =>$model->getAttributeLabel('TITU_ID'),
		'value'=>$tutilos->getNombreTitulo($model->TITU_ID),
		),
		
		array(
		'name' =>$model->getAttributeLabel('GRAD_CEDULA'),
		'value'=>$model->rel_graduados->GRAD_CEDULA,
		),
		
		array(
		'name' =>$model->getAttributeLabel('GRAD_NOMBRES'),
		'value'=>$graduados->getNombreGraduado($model->GRAD_ID),
		),
		array(
		'name' =>$model->getAttributeLabel('TITG_ID'),
		'value'=>$titulostrabajos->getTitulotrabajogrado($model->TITG_ID),
		),
		
		array(
		'name' =>$model->getAttributeLabel('NIES_ID'),
		'value'=>$nivele->getNombreNivel($model->NIES_ID),
		),		
			
		array(
		'name' =>$model->getAttributeLabel('RECT_ID'),
		'value'=>$rectores->getNombreRector($model->RECT_ID),
		),
		array(
		'name' =>$model->getAttributeLabel('DECA_ID'),
		'value'=>$Decanos->getNombreDecanos($model->DECA_ID),
		),
		array(
		'name' =>$model->getAttributeLabel('SEGE_ID'),
		'value'=>$Secretarios->getNombreSecretarios($model->SEGE_ID),
		),
		
		array(
		'name' =>$model->getAttributeLabel('FACU_ID'),
		'value'=>$facultades->getNombreFacultad($model->FACU_ID),
		),
		
		
		array(
		'name' =>$model->getAttributeLabel('PROG_ID'),
		'value'=>$programas->getNombrePrograma($model->PROG_ID),
		),
		
		array(
		'name' =>$model->getAttributeLabel('SEDE_ID'),
		'value'=>$sedes->getNombreSedes($model->SEDE_ID),
		),
		
		array(
		'name' =>$model->getAttributeLabel('JORN_ID'),
		'value'=>$jornadas->getNombreJornadas($model->JORN_ID),
		),
		array(
		'name' =>$model->getAttributeLabel('GRAD_SEXO'),
		'value'=>$graduados->getNombreSexoGraduado($model->GRAD_ID),
		),
		
		
	),
));  ?>      <br/>
<br />  
    </td>
  </tr>
</table>
