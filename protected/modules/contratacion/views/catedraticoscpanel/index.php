<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/contratacion/');
$this->breadcrumbs=array(
	'Modulo Contratacion'=>array('/contratacion/'),
	'Panel'=>array('catedraticoscpanel/'),
	'Administrar',
);
?>
<table width="75%" border="0" align="center">
  <tr>
    <td height="21" align="center">
    <fieldset>
    <h4><?php echo "MODULO PARA CONTRATACIÓN DE DOCENTES CATEDRÁTICOS"; ?></h4>
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
	 echo CHtml::link($image, array('mdlcatedraticos/catedraticoscontratos/admin',),$htmlOptions ); 
	?></td>
                        <td width="3%" scope="col">&nbsp;</td>
                        <td width="21%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_cate.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Ver todas las cátedras
	 ');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/catedraticoscatedras/view',),$htmlOptions ); 
	?></td>
                        <td width="6%" scope="col">&nbsp;</td>
                        <td width="20%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_pago.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Pagos de horas cátedras
	 ');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/catedraticospagohorascated/admin',),$htmlOptions ); 
	?></td>
                        <td width="6%" scope="col">&nbsp;</td>
                        <td width="21%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_pres.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Presupuestos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/catedraticospresupuestos/admin',),$htmlOptions ); 
	?></td>
                        <td width="3%" scope="col">&nbsp;</td>
                        <td width="10%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_paca.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Periodos Academicos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/periodosacademicos/admin',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="5" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_docca.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Docentes Catedráticos Actuales
	 ');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/persnaturalescatedraticos/admin',),$htmlOptions ); 
	?></td>
                        <td>&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_facu.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Facultades
	 ');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/facultades/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
	 <?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_informes.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Impresion de Informes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/informes/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_prog.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Programas
	 ');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/programas/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_ct.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Categorias');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/categorias/admin',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="14" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_asig.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Asignaturas
	 ');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/asignaturas/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php 
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_pers.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Personas en Base de Datos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/personasnaturales/admin',),$htmlOptions ); 
	 ?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al cpanel principal CONTRATACION');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/contratacion',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php 
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_contrt.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Contratantes');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/resolucionesacuerdos/admin',),$htmlOptions ); 
	 ?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/icon_est.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Estudios');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcatedraticos/estudios/admin',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="6" colspan="9"><hr /></td>
                      </tr>
        </table> 
    </fieldset>
    </td>
  </tr>
</table>
