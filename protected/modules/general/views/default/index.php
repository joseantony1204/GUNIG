<?php
if(!Yii::app()->user->isGuest){  
$subModulos = Yii::app()->user->subModulosUsuarios($this->module->id);
$filas = count($subModulos); 
$colspan = $filas;
$porc = 100/$filas;  
?>

<table width="70%" border="0" align="left">
  <tr>
    <td height="21" align="center">
    <fieldset>
      <table width="100%" border="0" align="center">
        <tr>
          <td width="60" align="left">
          <?php
	      $imageUrl = Yii::app()->request->baseUrl . '/images/config.png';
	      echo $image = CHtml::image($imageUrl);
	      ?>
          </td>
          <td width="750" align="left"><h3><?php echo "MODULO DE CONFIGURACIONES GENERALES"; ?></h3></td>
        </tr>
      </table>
    </fieldset></td>
  </tr>
  <tr>
    <td height="21">
    <fieldset>
      <table width="100%" border="0" align="center">
        <tr>
          <th colspan="<?php echo $colspan;?>"><hr/></th>
        </tr>        
        <tr align="center">
        <?php 
		foreach($subModulos as $rows){
		 $nombreSubModulo = $rows['USSM_NOMBRE'];
         $descripcionSubModulo = $rows['USSM_URL'];
		 $max = strlen($descripcionSubModulo);
		 $url = substr($descripcionSubModulo,3,$max);
         $urlImage = $rows['USSM_URL'];		
		?> 
         <td width="<?php echo $porc;?>%" >
         <?php
         $imageUrl = Yii::app()->request->baseUrl . '/images/submod_'.$urlImage.'.png';
		 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a '.$nombreSubModulo);
         $image = CHtml::image($imageUrl);
         echo CHtml::link($image, array($url.'cpanel/index',),$htmlOptions ); 
         ?>
         </td>        
         <?php
		 }
		 ?> 
    
        </tr>
        <tr>
          <td colspan="<?php echo $colspan;?>"><hr /></td>
        </tr>
      </table>
    </fieldset>
    </td>
  </tr>
</table>

<?php
}
?>