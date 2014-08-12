<?php Yii::app()->user->setFlash('info',
	'<strong>Señor usuario</strong>
	<br>No olvide que para que el proceso de tramite de su cuenta no tenga inconvenientes, 
	debe tener actualizados los documentos de su contrato: (contraloria y procuraduria.)'); 
?>
<?php 
Yii::app()->homeUrl = array('/usuario');
$this->breadcrumbs=array(
	'Modulo de usuario',
);

if(!Yii::app()->user->isGuest){  
$porcInterno = 25;
$subModulos = Yii::app()->user->subModulosUsuarios($this->module->id);
$filas = count($subModulos); 
$colspan = $filas;
$porcInterno = $porcInterno*$filas;  

$Usuario = Usuarios::model()->findByPk(Yii::app()->user->id);
$Personasnaturales = Personasnaturales::model()->findByPk($Usuario->PENA_ID);
?>

<table width="70%" border="0">
  <tr>
  <td height="28" align="left">
  <fieldset>
  
<table width="100%" border="0">
   <tr>
    <td height="21" align="center">
    <fieldset>
      <table width="100%" border="0" align="center">
        <tr>
          <td width="60" align="left">
          <?php
	      $imageUrl = Yii::app()->request->baseUrl . '/images/user.png';
	      echo $image = CHtml::image($imageUrl);
	      ?>
          </td>
          <td width="750" align="left"><h3><?php echo "GESTIÓN MODULO DE USUARIO"; ?></h3></td>
        </tr>
      </table>
    </fieldset>
    </td>
  </tr>

  <tr>
    <td><hr /></td>
  </tr>
  <tr>
   <td>

  <table width="<?php echo $porcInterno;?>%" border="0">
   <tr>
<?php 
		$i = 1;
		$lnk = $Personasnaturales->PENA_ID;
		$a = array(1 =>'userperfil/usuarioperfilusuario/admin', 2 =>'userhdv/personasnaturales/view/id/'.$lnk, 3 =>'segcuenta/contratos/admin');
		$icon = array(1 => 'icon_user', 2 => 'icon_pershdv', 3 => 'icon_cont');
		foreach($subModulos as $rows){
		 $nombreSubModulo = $rows['USSM_NOMBRE'];
         $descripcionSubModulo = $rows['USSM_URL'];
		 $max = strlen($descripcionSubModulo);
		 $url = $a[$i];
         $urlImage = $rows['USSM_URL'];	
		?>    
    <td>
        <?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/'.$icon[$i].'.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a '.$nombreSubModulo);
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array($url,),$htmlOptions ); 
         ?>
    </td>
    <td align="left">&nbsp;</td>
<?php
$i++;
}
?>    
   </tr>
  </table>

    
    </td>
  </tr>
  <tr>
    <td><hr /></td>
  </tr>
</table>

</fieldset>
   </td>
  </tr>
</table>
<?php
}else{
?>
</p>
<h3>Su sesiòn ha caducado :( </h3>
<br/>
<h4>Para iniciar sesiòn haz clic en el vinculo que esta en la parte superior derecha de tu pantalla</h4>
<?php
}
?>
