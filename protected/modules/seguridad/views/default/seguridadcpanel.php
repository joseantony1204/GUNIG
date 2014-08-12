<?php
Yii::app()->homeUrl = array('/seguridad/');
$this->breadcrumbs=array(
	'Modulo Seguridad',
);
?>
<table width="70%" border="0" align="left">
  <tr>
    <td height="21" align="center">
    <fieldset>
      <table width="100%" border="0" align="center">
        <tr>
          <td width="60" align="left"><img src="/APP_FONDO/images/user.png" alt="" /></td>
          <td width="750" align="left"><h2><?php echo "GESTIÓN MODULO DE SEGURIDAD"; ?></h2></td>
        </tr>
      </table>
    </fieldset></td>
  </tr>
  <tr>
    <td height="21">
    <fieldset>
      <table width="100%" height="64" border="0" align="center">
        <tr>
          <th height="4" colspan="4"><hr /></th>
        </tr>
        <tr align="center">
          <td width="25%" height="20" >
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/seguridad/icon_user.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar USUARIOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('roles/usersperfilesusuarios/admin',),$htmlOptions ); 
	?></td>
          <td width="25%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/seguridad/icon_userd.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' =>'Ir a administrar USUARIOS DEL SEGUIMIENTO DE CUENTAS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('roles/seguimientouserdependencias/admin',),$htmlOptions ); 
	?></td>
          <td width="25%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/seguridad/icon_roles.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar TABLA DE ROLES');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('roles/usuariosroles/admin',),$htmlOptions ); 
	?></td>
          <td width="25%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/seguridad/icon_views.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar VISTAS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('roles/usuariosvistas/admin',),$htmlOptions ); 
	?></td>
        </tr>
        <tr>
          <td height="4" colspan="4"><hr /></td>
        </tr>
        <tr>
          <td height="20" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/seguridad/icon_controllers.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar CONTROLADORES');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('roles/usuarioscontroladores/admin',),$htmlOptions ); 
	?></td>
          <td height="20" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/seguridad/icon_smodules.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar SUB MODULOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('roles/usuariossubmodulos/admin',),$htmlOptions ); 
	?></td>
          <td height="20" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/seguridad/icon_modules.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar MODULOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('roles/usuariosmodulos/admin',),$htmlOptions ); 
	?></td>
          <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/seguridad/icon_perfil.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar PERFILES DE USUARIOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('roles/usuariosperfiles/admin',),$htmlOptions ); 
	?></td>
        </tr>
        <tr>
          <td height="4" colspan="4"><hr /></td>
        </tr>
      </table>
    </fieldset></td>
  </tr>
</table>