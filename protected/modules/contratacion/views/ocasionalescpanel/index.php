<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('ocasionalescpanel/'),
	'Administrar',
);
?>
<table width="75%" border="0" align="center">
  <tr>
    <td height="21" align="center">
    <fieldset>
    <h4><?php echo "MODULO PARA CONTRATACIÓN DE DOCENTES OCASIONALES"; ?></h4>
    </fieldset>
    </td>
  </tr>
  <tr>
    <td height="21">
    <fieldset>
   <table width="98%" height="110" border="0" align="center">
                      <tr>
                        <th colspan="9"><hr /></th>
                      </tr>
                      <tr align="center">
                        <td width="10%" >
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_cont.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Contratos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlocasionales/ocasionalescontratos/admin',),$htmlOptions ); 
	?></td>
                        <td width="3%" scope="col">&nbsp;</td>
                        <td width="21%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_pres.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Presupuestos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlocasionales/ocasionalespresupuestos/admin',),$htmlOptions ); 
	?></td>
                        <td width="6%" scope="col">&nbsp;</td>
                        <td width="20%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_pers.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Personas en Base de Datos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlocasionales/personasnaturales/admin',),$htmlOptions ); 
	?></td>
                        <td width="6%" scope="col">&nbsp;</td>
                        <td width="21%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_contrt.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Contratantes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlocasionales/contratantes/admin',),$htmlOptions ); 
	?></td>
                        <td width="3%" scope="col">&nbsp;</td>
                        <td width="10%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_paca.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Periodos Academicos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlocasionales/periodosacademicos/admin',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="5" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_dococ.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Docentes Ocasionales Actuales
	 ');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlocasionales/persnaturalesocasionales/admin',),$htmlOptions ); 
	?></td>
                        <td>&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_facu.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Facultades
	 ');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlocasionales/facultades/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
	 <?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_informes.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Impresion de Informes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlocasionales/informes/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_puntos.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Valor de Puntos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlocasionales/valorpuntos/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_est.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Estudios');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlocasionales/estudios/admin',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="14" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al cpanel principal CONTRATACION');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/contratacion',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="6" colspan="9"><hr /></td>
                      </tr>
        </table> 
    </fieldset>
    </td>
  </tr>
</table>
