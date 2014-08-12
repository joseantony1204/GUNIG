<?php
Yii::app()->homeUrl = array('/general/');
$this->breadcrumbs=array(
	'Modulo Configuraciones Generales',
);
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
          <td width="750" align="left"><h2><?php echo "MODULO DE CONFIGURACIONES GENERALES"; ?></h2></td>
        </tr>
      </table>
    </fieldset></td>
  </tr>
  <tr>
    <td height="97">
    <fieldset>
      <table width="100%" border="0" align="center">
        <tr>
          <th colspan="4"><hr /></th>
        </tr>
        <tr align="center">
          <td width="25%" height="20" >
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/general/icon_pers.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar PERSONAS NATURALES');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlconfig/personasnaturales/admin',),$htmlOptions ); 
	?></td>
          <td width="25%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/general/icon_persj.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' =>'Ir a administrar PERSONAS JURIDICAS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlconfig/personasjuridicas/admin',),$htmlOptions ); 
	?></td>
          <td width="25%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/general/icon_anca.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar AÑOS ACADEMICOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlconfig/aniosacademicos/admin',),$htmlOptions ); 
	?></td>
          <td width="25%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/general/icon_paca.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar PERIODOS ACADEMICOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlconfig/periodosacademicos/admin',),$htmlOptions ); 
	?></td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td height="20" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/general/icon_contrt.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar CONTRATANTES');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlconfig/contratantes/admin',),$htmlOptions ); 
	?></td>
          <td height="20" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/general/icon_jfdep.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar JEFES DE DEPENDENCIAS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlconfig/jefesdependencias/admin',),$htmlOptions ); 
	?></td>
          <td height="20" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/general/icon_est.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ir a administrar ESTUDIOS');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlconfig/estudios/admin',),$htmlOptions ); 
	?></td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4"><hr /></td>
        </tr>
        <tr>
          <td height="21" align="center">&nbsp;</td>
          <td height="21" align="center">&nbsp;</td>
          <td height="21" align="center">&nbsp;</td>
          <td height="21" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td height="4" colspan="4"><hr /></td>
          </tr>
      </table>
    </fieldset></td>
  </tr>
</table>