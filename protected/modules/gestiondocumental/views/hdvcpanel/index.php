<?php
Yii::app()->homeUrl = array('/gestiondocumental/');
$this->breadcrumbs=array(
	'Modulo Gestión Documental'=>array('/gestiondocumental/'),
	'Panel'=>array('hdvcpanel/'),
	'Admininistrar',
);
?>
<table width="60%" border="0" align="left">
  <tr>
    <td height="21" align="center">
    <fieldset>
    <h4><?php echo "GESTIÓN DOCUMENTAL - EXPEDIENTE DIGITAL DE HOJAS DE VIDA"; ?></h4>
    </fieldset>
    </td>
  </tr>
  <tr>
    <td height="21">
    <fieldset>
   <table width="98%" height="115" border="0" align="center">
                      <tr>
                        <th colspan="5"><hr /></th>
                      </tr>
                      <tr align="center">
                        <td width="22%" height="21" >
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/documental/icon_pers.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Personas');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlhdv/personasnaturales/admin',),$htmlOptions ); 
	?></td>
                        <td width="12%" scope="col">&nbsp;</td>
                        <td width="33%" scope="col">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/documental/icon_est.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Estudios');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlhdv/estudios/admin',),$htmlOptions ); 
	?></td>
                        <td width="11%" scope="col">&nbsp;</td>
                        <td width="22%" scope="col">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/documental/icon_tpdoc.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Tipos De Documentosde Hoja de Vida');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlhdv/hdvtiposdocumentos/admin',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="19" colspan="5"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" colspan="2" align="center">&nbsp;</td>
                        <td align="center">
                        <?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al cpanel principal GESTIÓN DOCUMENTAL');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/gestiondocumental',),$htmlOptions ); 
	?></td>
                        <td colspan="2" align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="14" colspan="5"><hr /></td>
                      </tr>
        </table> 
    </fieldset>
    </td>
  </tr>
</table>
