<?php
Yii::app()->homeUrl = array('/usuario/');
$this->breadcrumbs=array(
	'Modulo Gestión De Usuario',
);
?>
<table width="60%" border="0" align="left">
  <tr>
    <td height="21" align="center">
    <fieldset>
      <table width="100%" border="0" align="center">
        <tr>
          <td width="60" align="left"><img src="/APP_FONDO/images/user.png" alt="" /></td>
          <td width="750" align="left"><h2><?php echo "GESTIÓN MODULO DE USUARIOS"; ?></h2></td>
        </tr>
      </table>
    </fieldset></td>
  </tr>
  <tr>
    <td height="21">
    <fieldset>
      <table width="100%" height="67" border="0" align="center">
        <tr>
          <th height="33" colspan="3"><hr /></th>
        </tr>
        <tr align="center">
          <td width="33%" height="21" ><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_user.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar mi PERFIL DE USUARIO');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('perfil/usuarioperfilusuario/admin',),$htmlOptions ); 
	?></td>
          <td width="34%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_pers.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar MIS DATOS PERSONALES');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('perfil/personasnaturales/admin',),$htmlOptions ); 
	?></td>
          <td width="33%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_cont.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir al SEGUIMIENTO DE CUENTAS MIS CONTRATOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('segcuenta/contratos/admin',),$htmlOptions ); 
	?></td>
        </tr>
        <tr>
          <td height="5" colspan="3"><hr /></td>
        </tr>
      </table>
    </fieldset></td>
  </tr>
</table>