<?php 
Yii::app()->homeUrl = array('/financiero');
$this->breadcrumbs=array(
	'Modulo Gestión Finanzas',
);

if(!Yii::app()->user->isGuest){  
$porcInterno = 25;
$subModulos = Yii::app()->user->subModulosUsuarios($this->module->id);
$filas = count($subModulos); 
$colspan = $filas;
$porcInterno = $porcInterno*$filas;  
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
          <td width="750" align="left"><h3><?php echo "GESTIÓN FINANCIERA UNIVERSIDAD DE GUAJIRA"; ?></h3></td>
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
		foreach($subModulos as $rows){
         $descripcionSubModulo = $rows['USSM_URL'];
		 if($descripcionSubModulo=='segcuenta'){
		  $nombreSubModulo = 'MODULO FINANCIERO - LIQUIDACIÓN DE CUENTAS';
		  $url = '/financiero/tcuentascpanel/';
		  $urlImage = 'submod_mdllcuentas';  
		 }elseif($descripcionSubModulo=='mdltcuentas'){
			    $nombreSubModulo = 'MODULO FINANCIERO - TRAMITAR CUENTAS';
				$url = 'mdltcuentas/cuentas/cuentasNoTramitadas';
		        $urlImage = 'submod_mdltcuentas';
			   }elseif($descripcionSubModulo=='tesoreria'){
				      $nombreSubModulo = 'MODULO FINANCIERO - GESTIÓN DE RESOLUCIONES';
			          $url = 'tesoreria/libroresoluciones/admin';
		              $urlImage = 'submod_mdlayc';
			   }         		
		?>    
    <td>
        <?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/'.$urlImage.'.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a '.$nombreSubModulo);
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array($url,),$htmlOptions ); 
         ?>
    </td>
    <td align="left">&nbsp;</td>
<?php
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
