<?php
/* @var $this DefaultController */
Yii::app()->homeUrl = array('/academico/cargasacademicascpanel/index');
$this->breadcrumbs=array(
	'Modulo Académico'=>array('/academico/'),
	'Panel'=>array('cargasacademicascpanel/'),
	'Admin Académico',
);
?>
<table width="75%" border="0" align="center">
  <tr>
    <td height="21" align="center">
    <fieldset>
    <h4><?php echo "ASIGNACIÓN ACADÉMICA"; ?></h4>
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
                        <td width="20%" >
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/categruposinvestigacion.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Categorias grupos de investigación');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcargasacademicas/categruposinvestigacion/admin',),$htmlOptions ); 
	?></td>
                        <td width="2%" scope="col">&nbsp;</td>
                        <td width="20%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/grupos.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Grupos de Invetigación');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcargasacademicas/gruposinvestigacion/admin',),$htmlOptions ); 
	?></td>
    
      <td width="3%" scope="col">&nbsp;</td>
                        <td width="10%" scope="col"><?php /*?><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/contratacion/icon_anca.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Años Academicos');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcargasacademicas/aniosacademicos/admin',),$htmlOptions ); 
	<?php */?></td>
    
    
                        <td width="1%" scope="col">&nbsp;</td>
                        <td width="20%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/actividadesinvestigativas.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Actividades de Investigativas');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcargasacademicas/actividadesinvestigativas/admin',),$htmlOptions ); 
	?></td>
                        <td width="1%" scope="col">&nbsp;</td>
                        <td width="20%" scope="col"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/actividadesextension.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'actividadesextension');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcargasacademicas/actividadesextension/admin',),$htmlOptions ); 
	?></td>
                      
                      </tr>
                      <tr>
                        <td height="5" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/tipovinculaciondocente.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Tipo Vinculación Docente');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcargasacademicas/tipocontrataciondocentes/admin',),$htmlOptions ); 
	?></td>
                        <td>&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/horascatedras.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Horas cátedras');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcargasacademicas/horascatedras/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/precargasacademicas.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Agregar Asignaturas a Docente');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcargasacademicas/precargasacademicas/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/cargaacademica.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'carga academica');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcargasacademicas/cargarasignaturasdocente/admin',),$htmlOptions ); 
	?></td>
                      </tr>
                      <tr>
                        <td height="14" colspan="9"><hr /></td>
                      </tr>
                      <tr>
                        <td height="21" align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/asignaturas.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Asignaturas');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcargasacademicas/asignaturas/admin',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">
	<?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/regresar.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Volver al cpanel principal ACADÉMICO');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('/academico',),$htmlOptions ); 
	?></td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php
	 $imageUrl = Yii::app()->request->baseUrl . '/images/academico/carga.png';
	 $htmlOptions = array('class' => 'thumbnail','rel' => 'tooltip','data-title' => 'Carga Académica');
	 $image = CHtml::image($imageUrl);
	 echo CHtml::link($image, array('mdlcargasacademicas/cargasacademicas/admin',),$htmlOptions ); 
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
