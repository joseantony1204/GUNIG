<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/financiero/tcuentascpanel/index');
$this->breadcrumbs=array(
	'Modulo Financiero'=>array('/financiero/'),
	'Panel'=>array('tcuentascpanel/'),
	'Administracion Tramite de Cuentas',
);
?>
<table width="60%" border="0" align="center">
  <tr>
    <td height="21" align="left">
      <blockquote>
        <fieldset>
          <h4><?php echo "GESTION DE DESCUENTOS Y TRAMITE DE CUENTAS"; ?></h4>
        </fieldset>
      </blockquote>
    </td>
  </tr>
  <tr>
    <td height="80">
    <fieldset>
   <table width="98%" height="76" border="0" align="center">
                      <tr>
                        <th colspan="7"><hr /></th>
                      </tr>
                      <tr align="center">
                        <td height="21" ><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/icon_cuentas.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Seguimiento de Cuentas');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('segcuenta/contratos/admin'),$htmlOptions ); 
	?></td>
                        <td colspan="3" scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col"><?php
	  $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/icon_clco.png';
	  $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Asignacion de descuentos a Clases de Contratos');
	  $image = CHtml::image($imageUrl);
	  echo CHtml::link($image, array('segcuenta/clasescontratos/admin'),$htmlOptions ); 
	 ?></td>
                      </tr>
                      <tr align="center">
                        <td height="21" >&nbsp;</td>
                        <td colspan="3" scope="col">&nbsp;</td>
                        <td scope="col"><?php
		 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/icon_descuentos.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Aministracion de descuentos');
		 $image = CHtml::image($imageUrl);
		 echo CHtml::link($image, array('segcuenta/descuentos/admin'),$htmlOptions ); 
	  ?></td>
                        <td scope="col">&nbsp;</td>
                        <td scope="col">&nbsp;</td>
                      </tr>
                      <tr align="center">
                        <td width="20%" height="21" ><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/icon_resoluciones.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Seguimiento de Resoluciones');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('segcuenta/resoluciones/admin'),$htmlOptions ); 
	?></td>
                        <td colspan="3" scope="col">&nbsp;</td>
                        <td width="24%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al cpanel principal FINANCIERO');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/financiero',),$htmlOptions ); 
	?></td>
                        <td width="19%" scope="col">&nbsp;</td>
                        <td width="20%" scope="col"><?php
	  $imageUrl = Yii::app()->request->baseUrl . '/images/financiero/icon_clre.png';
	  $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Asignacion de descuentos a Clases de Resoluciones');
	  $image = CHtml::image($imageUrl);
	  echo CHtml::link($image, array('segcuenta/clasesresoluciones/admin'),$htmlOptions ); 
	 ?></td>
                      </tr>
                      <tr>
                        <td height="5" colspan="7"><hr /></td>
                      </tr>
        </table> 
    </fieldset>
    </td>
  </tr>
</table>
