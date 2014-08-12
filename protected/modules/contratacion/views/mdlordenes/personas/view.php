<?php
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'cpanel Ops'=>array('opscpanel/'),
	'Personas'=>array('admin'),
	'Hoja de vida',
);
?>
<table width="50%" border="0" align="left">
  <tr>
    <td height="21" align="center"><fieldset>
      <table width="820" border="0" align="center">
        <tr>
          <td width="60" align="left"><img src="/APP_FONDO/images/user.png" alt="" /></td>
          <td width="750" align="left"><strong>HOJA DE VIDA  DE <?php echo $model->PERS_NOMBRES; ?> <?php echo $model->PERS_APELLIDOS; ?></strong></td>
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
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_cont.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Contratos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/tutoriascontratos/admin',),$htmlOptions ); 
	?></td>
          <td width="8%" scope="col">&nbsp;</td>
          <td width="27%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_prog.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Programas');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdltutorias/tutoriasprogramas/admin',),$htmlOptions ); 
	?></td>
          <td width="8%" scope="col">&nbsp;</td>
          <td width="30%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_pers.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Personal en Base de Datos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('personas/admin',),$htmlOptions ); 
	?></td>
        </tr>
        <tr>
          <td height="5" colspan="5"><hr /></td>
        </tr>
        <tr>
          <td height="21" align="center">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_est.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Tutores Actuales');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlops/personasestudios/admin','id'=>$model->PERS_IDENTIFICACION),$htmlOptions ); 
	?></td>
          <td>&nbsp;</td>
          <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_paca.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Periodos Academicos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('periodosacademicos/admin',),$htmlOptions ); 
	?></td>
          <td align="center">&nbsp;</td>
          <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_contrt.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Contratantes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('contratantes/admin',),$htmlOptions ); 
	?></td>
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
         echo CHtml::link($image, array('mdlops/personas/admin',),$htmlOptions ); 
?></td>
        </tr>
    </table>
    </fieldset>    
    </td>
  </tr>
</table>
