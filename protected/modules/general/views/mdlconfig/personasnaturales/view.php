<?php
Yii::app()->homeUrl = array('/general/');
$this->breadcrumbs=array(
	'Modulo Configuraciones Generales'=>array('/general/'),
	'Personas Naturales'=>array('admin'),
	'Hoja de vida'=>array('view', 'id'=>$model->PENA_ID),
	'Detalles',
);

?>
<table width="50%" border="0" align="left">
  <tr>
    <td height="21" align="center"><fieldset>
      <table width="820" border="0" align="center">
        <tr>
          <td width="60" align="left">
          <?php $imageUrl = Yii::app()->request->baseUrl . '/images/user.png'; echo $image = CHtml::image($imageUrl); ?>
          </td>
          <td width="750" align="left"><strong>HOJA DE VIDA  DE <?php echo $model->PENA_NOMBRES; ?> 
		  <?php echo $model->PENA_APELLIDOS; ?></strong></td>
        </tr>
      </table>
    </fieldset></td>
  </tr>
  <tr>
    <td height="21"><fieldset>
      <table width="100%" height="76" border="0" align="center">
        <tr>
          <th colspan="5"><hr /></th>
        </tr>
        <tr align="center">
          <td width="27%" height="21" ><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/documental/icon_dhdv.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Digitalizacion de Hoja de Vida');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlconfig/hdvexpedientedocumentos/admin','id'=>$model->PERS_ID),$htmlOptions ); 
	?></td>
          <td width="8%" scope="col">&nbsp;</td>
          <td width="27%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/edit.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Editar Datos Personales');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlconfig/personasnaturales/update','id'=>$model->PENA_ID),$htmlOptions ); 
	?></td>
          <td width="8%" scope="col">&nbsp;</td>
          <td width="30%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_est.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Estudios');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlconfig/personasnaturalesestudios/admin','id'=>$model->PENA_ID),$htmlOptions ); 
	?></td>
        </tr>
        <tr>
          <td height="5" colspan="5"><hr /></td>
        </tr>
        <tr>
          <td height="21" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/documental/icon_persel.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Experiencia Laboral');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlconfig/personasexperiencialaboral/admin','id'=>$model->PERS_ID),$htmlOptions ); 
	?></td>
          <td>&nbsp;</td>
          <td align="center"><?php /*
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_cont.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Mi historial de Contratacion');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlconfig/personasnaturales/miscontratos','id'=>$model->PENA_ID,),$htmlOptions ); 
	*/ ?></td>
          <td align="center">&nbsp;</td>
          <td align="center">
	<?php /*
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_pers.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Personas en Base de Datos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/personasnaturales/view','id'=>$model->PENA_ID),$htmlOptions ); 
	*/?></td>
        </tr>
        <tr>
          <td height="6" colspan="5"><hr /></td>
        </tr>
      </table>
    </fieldset></td>
  </tr>
  <tr>
    <td height="21">
  <fieldset>
    <table width="100%" border="0" align="center">
      <tr>      
        <td width="573" align="left">&nbsp;</td>
        <td width="237" align="center"><?php

         
		 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
         $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Regresar');
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array('mdlconfig/personasnaturales/admin',),$htmlOptions ); 
?></td>
        </tr>
    </table>
    </fieldset>    
    </td>
  </tr>
</table>